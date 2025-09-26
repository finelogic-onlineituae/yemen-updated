<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Country;
use App\Models\PassportCenter;
use App\Models\LossPassport;
use Storage;

class LossPassportController extends Controller
{
    public function createLossPassport(Request $request)
    {
        session([ 'category' => '3', 'app' => 'applications/loss-passport']);

        return view('loss-passport.create', ['countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

    public function storeLossPassport(Request $request)
    {
        $request->validate([
            'name_english' => 'required',
            'phone_number' => 'required|string|max:15',
            'emirates_id' => 'nullable|min:17',
            'name_arabic' => 'required',
            'country_of_birth' => 'required|exists:countries,id',
            'city_of_birth' => 'required|max:250',
            'date_of_birth' => 'required|date',
            'mother_name' => 'required',
            'mother_nationality' => 'required|exists:countries,id',
            'relative_name' => 'required',
            'relative_relation' => 'required|string|max:50',
            'relative_address' => 'required',
            'relative_phone' => 'required|string|max:50',
            'address_land_mark' => 'required',
            'address_street' => 'required',
            'address_area' => 'required',
            'address_emirate' => 'required',
            'emirate_id_attachment' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'passport_number' => 'required|string|min:8',
            'expire_on' => 'required',
            'passport_center' => 'required|exists:passport_centers,id',
            'issued_on' => 'required|before:tomorrow',
            'passport_attachment' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'cropped_image' =>  $request->has('application') ? 'nullable' : 'required',
            'police_reporting_letter' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'notice_in_newpaper' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048'
        ]);
        $user = auth()->user();
      
          $photo_file_path = null;
        if ($request->cropped_image) {
                $base64Image = $request->input('cropped_image');

                if (!$base64Image) {
                    return back()->with('error', 'No image provided.');
                }

                // Strip base64 header if present
                $base64Image = preg_replace('#^data:image/\w+;base64,#i', '', $base64Image);

                // Decode the image
                $imageData = base64_decode($base64Image);

                // Generate filename and path
                $filename = 'crop_' . time() . '.jpg';
                $photo_file_path = '/uploads/user_' . auth()->id() .'/'. $filename;

                // Store in /storage/app/public/images
                Storage::disk('public')->put($photo_file_path, $imageData);

                // (Optional) Get full URL to return or save in DB
                 //$photo_file_path = $path; // e.g., /storage/images/crop_123456.jpg
                        
         }
        if($request->hasFile('passport_attachment')) {
            $passport_file_path = $request->file('passport_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('emirate_id_attachment')) {
            $emirate_id_file_path = $request->file('emirate_id_attachment')->store('uploads/user_' . auth()->id());
        } 
        
        if($request->hasFile('police_reporting_letter')) {
            $police_reporting_letter_file_path = $request->file('police_reporting_letter')->store('uploads/user_' . auth()->id());
        }
    
       
        if($request->hasFile('notice_in_newpaper')) {
            $notice_in_newpaper_file_path = $request->file('notice_in_newpaper')->store('uploads/user_' . auth()->id());
        }
      
     
        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->phone_number = $request->phone_number;
            $application->formable->emirates_id = $request->emirates_id;
            $application->formable->name = $request->name_english;
            $application->formable->name_arabic = $request->name_arabic;
            $application->formable->country_of_birth = $request->country_of_birth;
            $application->formable->city_of_birth = $request->city_of_birth;
            $application->formable->date_of_birth = $request->date_of_birth;
            $application->formable->relative_relationship = $request->relative_relation;
            $application->formable->relative_address = $request->relative_address;
            $application->formable->relative_phone = $request->relative_phone;
            $application->formable->relative_name = $request->relative_name;
            $application->formable->relative_country = $request->relative_country;
            $application->formable->mother_name = $request->mother_name;
            $application->formable->mother_nationality = $request->mother_nationality;
            $application->formable->alt_phone_number = $request->alt_phone_number;
            $application->formable->gender = $request->gender;
            $application->formable->land_mark = $request->address_land_mark;
            $application->formable->street = $request->address_street;
            $application->formable->area = $request->address_area;
            $application->formable->emirate = $request->address_emirate;

            //$application->formable->present_passholder = $request->present_passholder;
            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->issued_by = $request->issued_by;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expire_on;
            
            if($request->hasFile('passport_attachment')){
                $application->formable->passport->attachment = $passport_file_path;
            }
            if($request->hasFile('emirate_id_attachment')){
                $application->formable->emirates_id_attachment = $emirate_id_file_path;
            }
           
            if($request->hasFile('police_reporting_letter')) {
                $application->formable->police_reporting_letter = $police_reporting_letter_file_path;
            }
           
            if($request->hasFile('notice_in_newpaper')) {
                $application->formable->notice_in_newpaper = $notice_in_newpaper_file_path;
            }
            
            if($request->photo) {
                $application->formable->photo = $photo_file_path;
            }

            $application->formable->passport->save(); 
            $application->formable->save();          
        }
        else{
            $passport = $user->passports()->create([
                'passport_number' => $request->passport_number,
                'issued_by' => $request->issued_by,
                'passport_center_id' => $request->passport_center,
                'issued_on' => $request->issued_on,
                'expires_on' => $request->expire_on,
                'attachment' => $passport_file_path
            ]);
    
            $LossPassport = LossPassport::create([
                'phone_number' => $request->phone_number,
                'name' => $request->name_english,
                'name_arabic' => $request->name_arabic,
               
                'country_of_birth' => $request->country_of_birth,
                'city_of_birth' => $request->city_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'relative_name' => $request->relative_name,
                'relative_relationship' => $request->relative_relation,
                'relative_address' => $request->relative_address,
                'relative_phone' => $request->relative_phone,
                 // 'address' => $request->address,
                'land_mark' => $request->address_land_mark,
                'street' => $request->address_street,
                'area' => $request->address_area,
                'emirate' => $request->address_emirate,
                //'present_passholder' => $request->present_passholder,
                'passport_id' => $passport->id,
                'emirates_id_attachment' => $emirate_id_file_path,
                //'id_card' => $id_card_file_path,
               
                'notice_in_newpaper' => $notice_in_newpaper_file_path,
                //'emirates_id_copy' => $emirates_id_copy_file_path,
                'police_reporting_letter' => $police_reporting_letter_file_path,
                //'supporting_document' => $supporting_document_file_path,
                'photo' => $photo_file_path,
                'mother_name' => $request->mother_name,
                'mother_nationality' => $request->mother_nationality,
                'alt_phone_number' => $request->alt_phone_number,
                'gender' => $request->gender,
                
                'relative_country' => $request->relative_country,
                'country_of_birth' => $request->country_of_birth,
                'city_of_birth' => $request->city_of_birth,
            ]);
            $application = auth()->user()->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $LossPassport->id,
                'formable_type' => \App\Models\LossPassport::class,
                'form_type_id' => '13'
            ]); 
        }
        
       
        return redirect()->route('loss-passport.verify', ['application_id' => $application->id]);
    }
    public function verifyLossPassport(Request $request)
    {
        $application_id = $request->application_id;
        $application = Form::findOrFail($application_id);

        return view('loss-passport.verify-loss-passport', ['application' => $application, 'countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

    public function editLossPassport(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'loss-passport']);
        
        return view('loss-passport.create');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Country;
use App\Models\PassportCenter;
use App\Models\RenewPassportBelow;
use Storage;

class RenewPassportBelowController extends Controller
{
    public function createRenewPassportBelow(Request $request)
    {
        session(['category' => '3', 'app' => 'applications/renew-passport-below']);

        return view('renew-passport-below.create', ['countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

    public function storeRenewPassportBelow(Request $request)
    {
         $request->validate([
            'name_english' => 'required',
            'phone_number' => 'required|string|max:15',
            'emirates_id' => 'nullable|min:17',
            'name_arabic' => 'required',
            'profession' => 'required',
            'country_of_birth' => 'required|exists:countries,id',
            'city_of_birth' => 'required',
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
        ]);

        $user = auth()->user();

       $photo_file_path = null;
       $father_id_card_file_path = null;
       $mother_id_card_file_path = null;
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
        // if($request->hasFile('id_card_passport_holder')) {
        //     $id_card_passport_holder_file_path = $request->file('id_card_passport_holder')->store('uploads/user_' . auth()->id());
        // }
        
        // if($request->hasFile('photo')) {
        //     $photo_file_path = $request->file('photo')->store('uploads/user_' . auth()->id());
        // }
        if($request->hasFile('father_id_card')) {
            $father_id_card_file_path = $request->file('father_id_card')->store('uploads/user_' . auth()->id());
        }
  
        if($request->hasFile('mother_id_card')) {
            $mother_id_card_file_path = $request->file('mother_id_card')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('father_passport')) {
            $father_passport_file_path = $request->file('father_passport')->store('uploads/user_' . auth()->id());
        }
  
        if($request->hasFile('mother_passport')) {
            $mother_passport_file_path = $request->file('mother_passport')->store('uploads/user_' . auth()->id());
        }
        // if($request->hasFile('applicante_id_card')) {
        //     $applicante_id_card_file_path = $request->file('applicante_id_card')->store('uploads/user_' . auth()->id());
        // }
        // if($request->hasFile('emirates_id_copy')) {
        //     $emirates_id_copy_file_path = $request->file('emirates_id_copy')->store('uploads/user_' . auth()->id());
        // }
     
       
        if($request->has('application')){
               $application = Form::findOrFail($request->application);
         //   dd($application->formable->passport);
            $application->formable->name = $request->name_english;
            $application->formable->phone_number = $request->phone_number;
            
            $application->formable->name_arabic = $request->name_arabic;
            $application->formable->profession = $request->profession;
            $application->formable->country_of_birth = $request->country_of_birth;
            $application->formable->city_of_birth = $request->city_of_birth;
            $application->formable->relative_name = $request->relative_name;
            $application->formable->relative_relationship = $request->relative_relation;
            $application->formable->relative_address = $request->relative_address;
            $application->formable->relative_phone = $request->relative_phone;
            $application->formable->relative_country = $request->relative_country;
            $application->formable->mother_name = $request->mother_name;
            $application->formable->father_name = $request->father_name;
            $application->formable->mother_nationality = $request->mother_nationality;
            $application->formable->alt_phone_number = $request->alt_phone_number;
            $application->formable->gender = $request->gender;
            

            $application->formable->land_mark = $request->address_land_mark;
            $application->formable->street = $request->address_street;
            $application->formable->area = $request->address_area;
            $application->formable->emirate = $request->address_emirate;
            //$application->formable->present_passholder = $request->present_passholder;
            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->passport_center_id = $request->passport_center;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expire_on;
            
            // if($request->hasFile('id_card_passport_holder')){
            //     $application->formable->passport->id_card_passport_holder = $id_card_passport_holder_file_path;
            // }
           
            if($request->hasFile('father_id_card')) {
                $application->formable->father_id_card = $father_id_card_file_path;
            }
            
              
            if($request->hasFile('mother_id_card')) {
                $application->formable->mother_id_card = $mother_id_card_file_path;
            }
            if($request->hasFile('father_passport')) {
                $application->formable->father_passport = $father_passport_file_path;
            }
    
            if($request->hasFile('mother_passport')) {
                $application->formable->mother_passport = $mother_passport_file_path;
            }

            if($request->hasFile('passport_attachment')){
                $application->formable->passport->attachment = $passport_file_path;
            }
            if($request->hasFile('emirate_id_attachment')){
                $application->formable->emirates_id_attachment = $emirate_id_file_path;
            }
            if($photo_file_path) {
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
    
            $RenewPassportBelow = RenewPassportBelow::create([
                'name' => $request->name_english,
                'phone_number' => $request->phone_number,
                'name_arabic' => $request->name_arabic,
                'profession' => $request->profession,
                'country_of_birth' => $request->country_of_birth,
                'city_of_birth' => $request->city_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'relative_name' => $request->relative_name,
                'relative_relationship' => $request->relative_relation,
                'relative_address' => $request->relative_address,
                'relative_phone' => $request->relative_phone,
                //'address' => $request->address_land_mark.','.$request->address_street.','.$request->address_area.','.$request->address_emirate.',',
                'land_mark' => $request->address_land_mark,
                'street' => $request->address_street,
                'area' => $request->address_area,
                'emirate' => $request->address_emirate,
                //'present_passholder' => $request->present_passholder,
                'passport_id' => $passport->id,
                'mother_name' => $request->mother_name,
                'mother_nationality' => $request->mother_nationality,
                'father_name' => $request->father_name,
                'emirates_id_attachment' => $emirate_id_file_path,
                'photo' => $photo_file_path,
                'relative_country' => $request->relative_country,
                'alt_phone_number' => $request->alt_phone_number,
                'gender' => $request->gender,
                'father_id_card' => $father_id_card_file_path,
                'mother_id_card' => $mother_id_card_file_path,
                'father_passport' => $father_passport_file_path,
                'mother_passport' => $mother_passport_file_path,
            ]);
            $application = auth()->user()->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $RenewPassportBelow->id,
                'formable_type' => \App\Models\RenewPassportBelow::class,
                'form_type_id' => '10'
            ]); 
        }
        
       
        return redirect()->route('renew-passport-below.verify', ['application_id' => $application->id]);
    }
    public function verifyRenewPassportBelow(Request $request)
    {
        $application_id = $request->application_id;
        $application = Form::findOrFail($application_id);

        session(['application_id' => $application_id]);
        return view('renew-passport-below.verify-renew-passport-below', ['application' => $application, 'countries' => Country::all(), 'passport_centers' => PassportCenter::all() ]);
    }

    public function editRenewPassportBelow(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'renew-passport-below']);
        
        return view('renew-passport-below.create');
    }
}

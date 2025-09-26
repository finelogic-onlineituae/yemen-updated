<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Country;
use App\Models\PassportCenter;
use App\Models\NewPassport;
use Storage;

class NewPassportController extends Controller
{
    public function createNewPassport(Request $request)
    {
        session(['category' => '3', 'app' => 'applications/new-passport']);

        return view('new-passport.create', ['countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

    public function storeNewPassport(Request $request)
    {

        $request->validate([
                'name_english' => 'required',
                'phone_number' => 'required',
                'date_of_birth' => 'required|date|before:tomorrow',
                'mother_name' => 'required',
                'mother_nationality' => 'required|exists:countries,id',
                'country_of_birth' => 'required|exists:countries,id',
                'city_of_birth' => 'required',
                'father_passport' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'father_id_card' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'birth_certificate' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'mother_passport' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'mother_id_card' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'marriage_certificate' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'cropped_image' => $request->has('application') ? 'nullable' : 'required',
                'address_landmark' => 'required',
                'address_street' => 'required',
                'address_area' => 'required',
                'address_emirate' => 'required',
                'alt_phone_number' => 'required',
        ]);
        
        $user = auth()->user();

        $photo_file_path = null;
        $father_passport_file_path = null;
        $father_id_card_file_path = null;
        $mother_passport_file_path = null;
        $mother_id_card_file_path = null;
        $birth_certificate_file_path = null;
        $marriage_certificate_parents_file_path = null;
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
        if($request->hasFile('birth_certificate')) {
            $birth_certificate_file_path = $request->file('birth_certificate')->store('uploads/user_' . auth()->id());
        }
        // if($request->hasFile('photo')) {
        //     $photo_file_path = $request->file('photo')->store('uploads/user_' . auth()->id());
        // }
        if($request->hasFile('father_passport')) {
            $father_passport_file_path = $request->file('father_passport')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('father_id_card')) {
            $father_id_card_file_path = $request->file('father_id_card')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('mother_passport')) {
            $mother_passport_file_path = $request->file('mother_passport')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('mother_id_card')) {
            $mother_id_card_file_path = $request->file('mother_id_card')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('marriage_certificate')) {
            $marriage_certificate_parents_file_path = $request->file('marriage_certificate')->store('uploads/user_' . auth()->id());
        }
     

        if($request->has('application')){
            $application = Form::findOrFail($request->application);
            $application->formable->name = $request->name_english;
            $application->formable->name_arabic = $request->name_arabic;
            $application->formable->date_of_birth = $request->date_of_birth;
            $application->formable->country_of_birth = $request->country_of_birth;
            $application->formable->city_of_birth = $request->city_of_birth;
            $application->formable->phone_number = $request->phone_number;
            $application->formable->alt_phone_number = $request->alt_phone_number;
            $application->formable->mother_name = $request->mother_name;
            $application->formable->mother_nationality = $request->mother_nationality;
            
            $application->formable->address_landmark = $request->address_landmark;
            $application->formable->address_street = $request->address_street;
            $application->formable->address_area = $request->address_area;
            $application->formable->address_emirate = $request->address_emirate;
          
            
            if($request->hasFile('birth_certificate')){
                $application->formable->passport->birth_certificate = $birth_certificate_file_path;
            }
            if($request->hasFile('father_passport')) {
                $application->formable->father_passport = $father_passport_file_path;
            }
            if($request->hasFile('father_id_card')) {
                $application->formable->father_id_card = $father_id_card_file_path;
            }
            if($request->hasFile('mother_passport')) {
                $application->formable->mother_passport = $mother_passport_file_path;
            }
            if($request->hasFile('mother_id_card')) {
                $application->formable->mother_id_card = $mother_id_card_file_path;
            }
            if($request->hasFile('marriage_certificate_parents')) {
                $application->formable->marriage_certificate_parents = $marriage_certificate_parents_file_path;
            }
            if($request->photo) {
                $application->formable->photo = $photo_file_path;
            }

            $application->formable->save();          
        }
        else{
           
    
            $NewPassport = NewPassport::create([
                'name' => $request->name_english,
                'name_arabic' => $request->name_arabic,
                'phone_number' => $request->phone_number,
                'country_of_birth' => $request->country_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'city_of_birth' => $request->city_of_birth,
                'father_passport' => $father_passport_file_path,
                'father_id_card' => $father_id_card_file_path,
                'birth_certificate' => $birth_certificate_file_path,
                'mother_passport' => $mother_passport_file_path,
                'mother_id_card' => $mother_id_card_file_path,
                'marriage_certificate_parents' => $marriage_certificate_parents_file_path,
                'photo' => $photo_file_path,
                'address_landmark' => $request->address_landmark,
                'address_street' => $request->address_street,
                'address_area' => $request->address_area,
                'address_emirate' => $request->address_emirate,
                'alt_phone_number' => $request->alt_phone_number,
                'mother_name' => $request->mother_name,
                'mother_nationality' => $request->mother_nationality,
            ]);
            $application = auth()->user()->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $NewPassport->id,
                'formable_type' => \App\Models\NewPassport::class,
                'form_type_id' => '11'
            ]); 
        }
        
       
        return redirect()->route('new-passport.verify', ['application_id' => $application->id]);
    }
    public function verifyNewPassport(Request $request)
    {
        $application_id = $request->application_id;
        $application = Form::where('id', $application_id)->where('user_id', auth()->user()->id)->first();
        if(!$application){
            abort(403);
        }

        return view('new-passport.verify-new-passport', ['application' => $application, 'countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

    public function editNewPassport(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'new-passport']);
        
        return view('new-passport.create');
    }
}

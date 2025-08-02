<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\DamagedPassport;
use Storage;

class DamagedPassportController extends Controller
{
    public function createDamagedPassport(Request $request)
    {
        session(['category' => '3', 'app' => 'applications/damaged-passport']);

        return view('damaged-passport.create');
    }

    public function storeDamagedPassport(Request $request)
    {
        $user = auth()->user();

        if ($request->photo) {
                // Extract the image data from base64 string
                // Expected format: "data:image/png;base64,XXXXX..."
                @list($type, $fileData) = explode(';', $request->photo);
                @list(, $fileData) = explode(',', $fileData);

                if ($fileData) {
                    // Decode base64 to binary data
                    $decoded = base64_decode($fileData);

                    // Generate a filename
                    $fileName = 'cropped_image_' . auth()->id() . '_' . time() . '.png';

                    // Define path inside storage/app/uploads/user_{id}
                    $photo_file_path = 'uploads/user_' . auth()->id() . '/' . $fileName;

                    // Save the decoded image data to the disk (storage/app/...)
                    Storage::put($photo_file_path, $decoded);

                   
                }
        }else{
             $photo_file_path='';
        }

        if($request->hasFile('attachment')) {
            $file_path = $request->file('attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('left_thumb')) {
            $left_thumb_file_path = $request->file('left_thumb')->store('uploads/user_' . auth()->id());
        }
        // if($request->hasFile('emirates_id_copy')) {
        //     $emirates_id_copy_file_path = $request->file('emirates_id_copy')->store('uploads/user_' . auth()->id());
        // }
        // if($request->hasFile('id_card')) {
        //     $id_card_file_path = $request->file('id_card')->store('uploads/user_' . auth()->id());
        // }
        // if($request->hasFile('photo')) {
        //     $photo_file_path = $request->file('photo')->store('uploads/user_' . auth()->id());
        // }
     

        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->phone_number = $request->phone_number;
            $application->formable->name = $request->name;
            $application->formable->emirates_id = $request->emirates_id;
            $application->formable->name_arabic = $request->name_arabic;
            $application->formable->profession = $request->profession;
            $application->formable->place_of_birth = $request->place_of_birth;
            $application->formable->date_of_birth = $request->date_of_birth;
            $application->formable->relative_in_uae = $request->relative_in_uae;
            $application->formable->relative_in_uae_number = $request->relative_in_uae_number;
            $application->formable->relative_in_yemen = $request->relative_in_yemen;
            $application->formable->relative_in_yemen_number = $request->relative_in_yemen_number;
            //$application->formable->address = $request->address;
            $application->formable->land_mark = $request->address_land_mark;
            $application->formable->street = $request->address_street;
            $application->formable->area = $request->address_area;
            $application->formable->emirate = $request->address_emirate;

            $application->formable->damage_reason = $request->damage_reason;


            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->issued_by = $request->issued_by;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expires_on;
            
            if($request->hasFile('attachment')){
                $application->formable->passport->attachment = $file_path;
            }
            if($request->hasFile('left_thumb')) {
                $application->formable->left_thumb = $left_thumb_file_path;
            }
            // if($request->hasFile('emirates_id_copy')) {
            //     $application->formable->emirates_id_copy = $emirates_id_copy_file_path;
            // }
            // if($request->hasFile('id_card')) {
            //     $application->formable->id_card = $id_card_file_path;
            // }
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
                'passport_center_id' => null,
                'issued_on' => $request->issued_on,
                'expires_on' => $request->expires_on,
                'attachment' => $file_path
            ]);
    
            $DamagedPassport = DamagedPassport::create([
                'phone_number' => $request->phone_number,
                'name' => $request->name,
                'emirates_id' => $request->emirates_id,
                'name_arabic' => $request->name_arabic,
                'profession' => $request->profession,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'relative_in_uae' => $request->relative_in_uae,
                'relative_in_uae_number' => $request->relative_in_uae_number,
                'relative_in_yemen' => $request->relative_in_yemen,
                'relative_in_yemen_number' => $request->relative_in_yemen_number,
                 // 'address' => $request->address,
                'land_mark' => $request->address_land_mark,
                'street' => $request->address_street,
                'area' => $request->address_area,
                'emirate' => $request->address_emirate,
                
                'damage_reason' => $request->damage_reason,
                //'id_card' => $id_card_file_path,
                'passport_id' => $passport->id,
                'left_thumb' => $left_thumb_file_path,
                //'emirates_id_copy' => $emirates_id_copy_file_path,
                'photo' => $photo_file_path,
            ]);
            $application = auth()->user()->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $DamagedPassport->id,
                'formable_type' => \App\Models\DamagedPassport::class,
                'form_type_id' => '12'
            ]); 
        }
        
       
        return redirect()->route('damaged-passport.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verifyDamagedPassport(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

        session(['application_id' => $application_id]);
        return view('damaged-passport.verify-damaged-passport', ['application' => $application]);
    }

    public function editDamagedPassport(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'damaged-passport']);
        
        return view('damaged-passport.create');
    }
}

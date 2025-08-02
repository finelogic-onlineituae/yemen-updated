<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\PassportNameChange;

class PassportNameChangeController extends Controller
{
    public function createPassportNameChange(Request $request)
    {
        session([ 'category' => '3', 'app' => 'applications/passport-name-change']);

        return view('passport-name-change.create');
    }

    public function storePassportNameChange(Request $request)
    {
        $user = auth()->user();
      

        if($request->hasFile('attachment')) {
            $file_path = $request->file('attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('left_thumb')) {
            $left_thumb_file_path = $request->file('left_thumb')->store('uploads/user_' . auth()->id());
        }
       
        if($request->hasFile('photo')) {
            $photo_file_path = $request->file('photo')->store('uploads/user_' . auth()->id());
        }
       
        if($request->hasFile('supporting_document')) {
            $supporting_document_file_path = $request->file('supporting_document')->store('uploads/user_' . auth()->id());
        }
     
        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->phone_number = $request->phone_number;
            $application->formable->emirates_id = $request->emirates_id;
            $application->formable->name = $request->name;
            $application->formable->old_name = $request->old_name;
            $application->formable->present_passholder = $request->present_passholder;
            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->passport_center_id = $request->passport_center;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expires_on;
            
            if($request->hasFile('attachment')){
                $application->formable->passport->attachment = $file_path;
            }
            if($request->hasFile('left_thumb')) {
                $application->formable->left_thumb = $left_thumb_file_path;
            }
            if($request->hasFile('supporting_document')) {
                $application->formable->supporting_document = $supporting_document_file_path;
            }
            if($request->hasFile('photo')) {
                $application->formable->photo = $photo_file_path;
            }

            $application->formable->passport->save(); 
            $application->formable->save();          
        }
        else{
            $passport = $user->passports()->create([
                'passport_number' => $request->passport_number,
                'issued_by' => 'YE',
                'passport_center_id' => $request->passport_center,
                'issued_on' => $request->issued_on,
                'expires_on' => $request->expires_on,
                'attachment' => $file_path
            ]);
    
            $PassportNameChange = PassportNameChange::create([
                'phone_number' => $request->phone_number,
                'emirates_id' => $request->emirates_id,
                'name' => $request->name,
                'old_name' => $request->old_name,
                'present_passholder' => $request->present_passholder,
                'passport_id' => $passport->id,
                'left_thumb' => $left_thumb_file_path,
                'supporting_document' => $supporting_document_file_path,
                'photo' => $photo_file_path,
            ]);
            $application = auth()->user()->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $PassportNameChange->id,
                'formable_type' => \App\Models\PassportNameChange::class,
                'form_type_id' => '14'
            ]); 
        }
        
       
        return redirect()->route('passport-name-change.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verifyPassportNameChange(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

        session(['application_id' => $application_id]);
        return view('passport-name-change.verify-passport-name-change', ['application' => $application]);
    }

    public function editPassportNameChange(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'passport-name-change']);
        
        return view('passport-name-change.create');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passport;
use App\Models\Form;
use App\Models\Country;
use App\Models\BirthCertificate;

class BirthCertificateController extends Controller
{
    public function createBirthCertificate()
    {
        session(['category' => '1', 'app' => 'applications/birth-certificate']);
        if(session()->has('edit_application'))
        {
            session()->forget(['edit_application', 'application_id']);
        }
        return view('birth-certificate.birth-certificate');
    }
    public function storeBirthCertificate(Request $request)
    {
        $user = auth()->user();
        if($request->hasFile('attachment')) {
            $file_path = $request->file('attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('residance_permit')) {
            $residance_permit_file_path = $request->file('residance_permit')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('fathers_passport')) {
            $fathers_passport_file_path = $request->file('fathers_passport')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('mothers_passport')) {
            $mothers_passport_file_path = $request->file('mothers_passport')->store('uploads/user_' . auth()->id());
        }
        if($request->has('application')){
            $application = Form::findOrFail($request->application);
         //   dd($application->formable->passport);
            $application->formable->name = $request->name;
            $application->formable->phone_number = $request->phone_number;
            $application->formable->place_of_birth = $request->place_of_birth;
            $application->formable->emirates_id = $request->emirates_id;
            $application->formable->date_of_birth = $request->date_of_birth;
            $application->formable->marital_status = $request->marital_status;
            $application->formable->fathers_issued_on = $request->fathers_issued_on;
            $application->formable->fathers_passport_number = $request->fathers_passport_number;
            $application->formable->fathers_nationality = $request->fathers_nationality;
            $application->formable->mothers_name = $request->mothers_name;
            $application->formable->mothers_issued_on = $request->mothers_issued_on;
            $application->formable->mothers_passport_number = $request->mothers_passport_number;
            $application->formable->mothers_nationality = $request->mothers_nationality;
            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->passport_center_id = $request->passport_center;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expires_on;

            if($request->hasFile('attachment')){
                $application->formable->passport->attachment = $file_path;
            }
            if($request->hasFile('residance_permit')) {
                $application->formable->residance_permit = $residance_permit_file_path;
            }
            if($request->hasFile('fathers_passport')) {
                $application->formable->fathers_passport = $fathers_passport_file_path;
            }
            if($request->hasFile('mothers_passport')) {
                $application->formable->mothers_passport = $mothers_passport_file_path;
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
    
            $birthCertificate = BirthCertificate::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'place_of_birth' => $request->place_of_birth,
                'emirates_id' => $request->emirates_id,
                'date_of_birth' => $request->date_of_birth,
                'marital_status' => $request->marital_status,
                'fathers_name' => $request->fathers_name,
                'fathers_issued_on' => $request->fathers_issued_on,
                'fathers_passport_number' => $request->fathers_passport_number,
                'fathers_nationality' => $request->fathers_nationality,
                'mothers_name' => $request->mothers_name,
                'mothers_issued_on' => $request->mothers_issued_on,
                'mothers_passport_number' => $request->mothers_passport_number,
                'mothers_nationality' => $request->mothers_nationality,
                'passport_id' => $passport->id,
                'residance_permit' => $residance_permit_file_path,
                'fathers_passport' => $fathers_passport_file_path,
                'mothers_passport' => $mothers_passport_file_path,
            ]);
            $application = auth()->user()->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $birthCertificate->id,
                'formable_type' => \App\Models\BirthCertificate::class,
                'form_type_id' => '1'
            ]); 
        }
        
       
        return redirect()->route('birth-certificate.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verifyBirthCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        return view('birth-certificate.verify-birth-certificate', ['application' => $application]);
    }

    public function editBirthCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'birth-certificate']);
        
        return view('birth-certificate.birth-certificate');
    }

 /*   public function confirmBirthCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

        $application->status = 'Applied';
        $application->save();
        
        session()->forget(['edit_birth_certificate', 'application_id']);
        return redirect()->route('birth-certificate.success', ['application_id' => encrypt($application->id)]);

    }

    public function postBirthCertificate(Request $request)
    {
     
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        return view('birth-certificate.confirm-birth-certificate', ['application_id' => $application->id]);
    }*/
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoObjectionCertificate;
use App\Models\Form;


class NoObjectionCertificateController extends Controller
{
    public function createNoObjectionCertificatee(Request $request)
    {
        session(['category' => '3', 'app' => 'applications/no-objection-certification']);

        return view('no-objection-certificate.create');
    }

    public function storeNoObjectionCertificate(Request $request)
    {
        $user = auth()->user();
       

        if($request->hasFile('attachment')) {
            $file_path = $request->file('attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('residance_permit')) {
            $residance_permit_file_path = $request->file('residance_permit')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('amendment_or_correction')) {
            $amendment_or_correction_file_path = $request->file('amendment_or_correction')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('birth_certifcate')) {
            $birth_certifcate_file_path = $request->file('birth_certifcate')->store('uploads/user_' . auth()->id());
        }

        if($request->has('application')){
            $application = Form::findOrFail($request->application);
         //   dd($application->formable->passport);
            $application->formable->name = $request->name;
            $application->formable->phone_number = $request->phone_number;
            $application->formable->birth_certifcate_no = $request->birth_certifcate_no;
            $application->formable->emirates_id = $request->emirates_id;
            $application->formable->birth_certifcate_issuing_authority = $request->birth_certifcate_issuing_authority;
            $application->formable->modified_name = $request->modified_name;
            $application->formable->modified_issued_by = $request->modified_issued_by;
            $application->formable->modified_issued_on = $request->modified_issued_on;
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
            if($request->hasFile('amendment_or_correction')) {
                $application->formable->amendment_or_correction = $amendment_or_correction_file_path;
            }
            if($request->hasFile('birth_certifcate')) {
                $application->formable->birth_certifcate = $birth_certifcate_file_path;
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
    
            $birthCertificate = NoObjectionCertificate::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'emirates_id' => $request->emirates_id,
                'birth_certifcate_no' => $request->birth_certifcate_no,
                'birth_certifcate_issuing_authority' => $request->birth_certifcate_issuing_authority,
                'modified_name' => $request->modified_name,
                'modified_issued_by' => $request->modified_issued_by,
                'modified_issued_on' => $request->modified_issued_on,
                'passport_id' => $passport->id,
                'residance_permit' => $residance_permit_file_path,
                'amendment_or_correction' => $amendment_or_correction_file_path,
                'birth_certifcate' => $birth_certifcate_file_path,
            ]);
            $application = auth()->user()->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $birthCertificate->id,
                'formable_type' => \App\Models\NoObjectionCertificate::class,
                'form_type_id' => '5'
            ]); 
        }
        
       
        return redirect()->route('no-objection-certification.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verifyNoObjectionCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

        session(['application_id' => $application_id]);
        return view('no-objection-certificate.verify-no-objection-certificate', ['application' => $application]);
    }

    public function editNoObjectionCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'no-objection-certificate']);
        
        return view('no-objection-certificate.create');
    }
}

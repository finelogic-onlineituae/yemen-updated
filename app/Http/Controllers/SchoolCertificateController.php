<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\SchoolCertificate;

class SchoolCertificateController extends Controller
{
     public function create(Request $request)
    {
        session([ 'category' => '5','app' => 'applications/school-certificate']);
       
        return view('school-certificate.create');
    }

    public function store(Request $request)
    {
      if($request->hasFile('attachment')) {
            $file_path = $request->file('attachment')->store('uploads/user_' . auth()->id());
        }

        if($request->hasFile('guardian_passport_attachment')) {
            $guardian_passport_attachment_file_path = $request->file('guardian_passport_attachment')->store('uploads/user_' . auth()->id());
        }

        if($request->hasFile('guardian_id_card')) {
            $guardian_id_card_file_path = $request->file('guardian_id_card')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('supporting_document')) {
            $supporting_document_file_path = $request->file('supporting_document')->store('uploads/user_' . auth()->id());
        }

        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->name = ucfirst($request->name);
            $application->formable->guardian_name = ucfirst($request->guardian_name);
            $application->formable->phone_number = $request->phone_number;
            $application->formable->emirates_id = $request->emirates_id;
            $application->formable->guardian_emirates_id = $request->guardian_emirates_id;
            $application->formable->supporting_reason = $request->supporting_reason;
            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->passport_center_id = $request->passport_center;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expires_on;

             //update client passport
            $application->formable->guardian->passport_number = $request->guardian_passport_number;
            $application->formable->guardian->passport_center_id = $request->guardian_passport_center;
            $application->formable->guardian->issued_on = $request->guardian_issued_on;

            if($request->hasFile('guardian_passport_attachment')){
                $application->formable->guardian->attachment = $guardian_passport_attachment_file_path;
            }

            if($request->hasFile('attachment')){
                $application->formable->passport->attachment = $file_path;
            }

            if($request->hasFile('guardian_id_card')) {
                $application->formable->guardian_id_card = $guardian_id_card_file_path;
            }    
            if($request->hasFile('supporting_document')) {
            $application->formable->supporting_document = $supporting_document_file_path;
            }

            $application->formable->passport->save(); 
            $application->formable->save();    

           

            $application->formable->guardian->save(); 
           
        }
        else{
            $user = auth()->user();
             $passport = $user->passports()->create([
                'passport_number' => $request->passport_number,
                'issued_by' => 'YE',
                'passport_center_id' => $request->passport_center,
                'issued_on' => $request->issued_on,
                'expires_on' => $request->expires_on,
                'attachment' => $file_path
            ]);

            $guardian_passport = $user->passports()->create([
                'passport_number' => $request->guardian_passport_number,
                'issued_by' => 'YE',
                'passport_center_id' => $request->guardian_passport_center,
                'issued_on' => $request->guardian_issued_on,
                //'expires_on' => $request->agent_expire_on,
                'attachment' => $guardian_passport_attachment_file_path
            ]);
    
            $SchoolCertificate = SchoolCertificate::create([
                'name' => ucwords($request->name),
                'guardian_name' => ucwords($request->guardian_name),
                'phone_number' => $request->phone_number,
                'guardian_passport_id' => $guardian_passport->id,
                'passport_id' => $passport->id,
                'guardian_emirates_id' => $request->guardian_emirates_id,
                'emirates_id' => $request->emirates_id,
                'guardian_id_card' => $guardian_id_card_file_path,
                'supporting_document' => $supporting_document_file_path,
                'supporting_reason' => $request->supporting_reason,

            ]);

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $SchoolCertificate->id,
                'formable_type' => \App\Models\SchoolCertificate::class,
                'form_type_id' => '17'
            ]); 
        }
       
        return redirect()->route('school-certificate.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verifySchoolCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

       // dd($application_id);
        return view('school-certificate.verify-school-certificate', ['application' => $application]);
    }

    public function editSchoolCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'school-certificate']);
        
        return view('school-certificate.create');
    }
}

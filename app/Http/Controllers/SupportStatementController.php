<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportStatement;
use App\Models\Form;


class SupportStatementController extends Controller
{
    public function createSupportStatement(Request $request)
    {
        session(['category' => '1', 'app' => 'applications/support-statement']);

        return view('support-statement.create');
    }

    public function storeSupportStatement(Request $request)
    {
        $user = auth()->user();
      

        if($request->hasFile('attachment')) {
            $file_path = $request->file('attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('beneficiary_passport')) {
            $beneficiary_passport_file_path = $request->file('beneficiary_passport')->store('uploads/user_' . auth()->id());
        }
        // if($request->hasFile('breadwinner_passport')) {
        //     $breadwinner_passport_file_path = $request->file('breadwinner_passport')->store('uploads/user_' . auth()->id());
        // }
        if($request->hasFile('birth_certificate')) {
            $birth_certificate_file_path = $request->file('birth_certificate')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('registration_summary')) {
            $registration_summary_file_path = $request->file('registration_summary')->store('uploads/user_' . auth()->id());
        }

        if($request->has('application')){
            $application = Form::findOrFail($request->application);
         //   dd($application->formable->passport);
            $application->formable->name = $request->name;
            $application->formable->phone_number = $request->phone_number;
            $application->formable->emirates_id = $request->emirates_id;
            $application->formable->relation_to_beneficiary = $request->relation_to_beneficiary;
            $application->formable->information_provided = $request->information_provided;
            $application->formable->beneficiary_name = $request->beneficiary_name;
            $application->formable->beneficiary_passport_number = $request->beneficiary_passport_number;
            $application->formable->beneficiary_issued_on = $request->beneficiary_issued_on;
            $application->formable->beneficiary_issued_by = $request->beneficiary_issued_by;
            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->passport_center_id = $request->passport_center;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expires_on;
            
            if($request->hasFile('attachment')){
                $application->formable->passport->attachment = $file_path;
            }
            if($request->hasFile('beneficiary_passport')) {
                $application->formable->beneficiary_passport = $beneficiary_passport_file_path;
            }
            // if($request->hasFile('breadwinner_passport')) {
            //     $application->formable->breadwinner_passport = $breadwinner_passport_file_path;
            // }
            if($request->hasFile('birth_certificate')) {
                $application->formable->birth_certificate = $birth_certificate_file_path;
            }
            if($request->hasFile('registration_summary')) {
                $application->formable->registration_summary = $registration_summary_file_path;
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
    
            $SupportStatement = SupportStatement::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'emirates_id' => $request->emirates_id,
                'relation_to_beneficiary' => $request->relation_to_beneficiary,
                'information_provided' => $request->information_provided,
                'beneficiary_name' => $request->beneficiary_name,
                'beneficiary_passport_number' => $request->beneficiary_passport_number,
                'beneficiary_issued_on' => $request->beneficiary_issued_on,
                'beneficiary_issued_by' => $request->beneficiary_issued_by,
                'passport_id' => $passport->id,
                //'breadwinner_passport' => $breadwinner_passport_file_path,
                'birth_certificate' => $birth_certificate_file_path,
                'beneficiary_passport' => $beneficiary_passport_file_path,
                'registration_summary' => $registration_summary_file_path,
            ]);
            $application = auth()->user()->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $SupportStatement->id,
                'formable_type' => \App\Models\SupportStatement::class,
                'form_type_id' => '7'
            ]); 
        }
        
       
        return redirect()->route('support-statement.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verifySupportStatement(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

        session(['application_id' => $application_id]);
        return view('support-statement.verify-support-statement', ['application' => $application]);
    }

    public function editSupportStatement(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'support-statement']);
        
        return view('support-statement.create');
    }
}

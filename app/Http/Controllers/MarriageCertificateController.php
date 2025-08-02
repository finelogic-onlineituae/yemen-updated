<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\MarriageCertificate;

class MarriageCertificateController extends Controller
{
    public function createMarriageCertificate(Request $request)
    {
        session([ 'category' => '1','app' => 'applications/marriage-certificate']);
       

        return view('marriage-certificate.create');
    }

    public function storeMarriageCertificate(Request $request)
    {
        if($request->hasFile('husband_passport_attachment')) {
            $husband_passport_file_path = $request->file('husband_passport_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('wife_passport_attachment')) {
            $wife_passport_file_path = $request->file('wife_passport_attachment')->store('uploads/user_' . auth()->id());
        }

        if($request->hasFile('husband_residance_permit')) {
            $husband_residance_permit_file_path = $request->file('husband_residance_permit')->store('uploads/user_' . auth()->id());
        }
        
        if($request->hasFile('wife_residance_permit')) {
            $wife_residance_permit_file_path = $request->file('wife_residance_permit')->store('uploads/user_' . auth()->id());
        }

        if($request->hasFile('marriage_document')) {
            $marriage_document_file_path = $request->file('marriage_document')->store('uploads/user_' . auth()->id());
        }

        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->husband_name = ucfirst($request->husband_name);
            $application->formable->wife_name = ucfirst($request->wife_name);
            $application->formable->date_of_marriage = $request->date_of_marriage;
            $application->formable->phone_number = $request->phone_number;
            $application->formable->husband_emirates_id = $request->husband_emirates_id;
            $application->formable->wife_emirates_id = $request->wife_emirates_id;
            $application->formable->contract_issued_by = $request->contract_issued_by;
            $application->formable->contract_issued_on = $request->contract_issued_on;
            $application->formable->registration_number = $request->registration_number;

            if($request->hasFile('wife_residance_permit')) {
            $application->formable->wife_residance_permit = $wife_residance_permit_file_path;
            }
            if($request->hasFile('marriage_document')) {
                $application->formable->marriage_document = $marriage_document_file_path;
            }    
            if($request->hasFile('husband_residance_permit')) {
            $application->formable->husband_residance_permit = $husband_residance_permit_file_path;
            }
            $application->formable->save();    

            //update client passport
            $application->formable->husbandPassport->passport_number = $request->husband_passport_number;
            $application->formable->husbandPassport->passport_center_id = $request->husband_passport_center;
            $application->formable->husbandPassport->issued_on = $request->husband_issued_on;

            if($request->hasFile('husband_passport_attachment')){
                $application->formable->husbandPassport->attachment = $husband_passport_file_path;
            }

            $application->formable->husbandPassport->save(); 
            //update agent passport
            $application->formable->wifePassport->passport_number = $request->wife_passport_number;
            $application->formable->wifePassport->passport_center_id = $request->wife_passport_center;
            $application->formable->wifePassport->issued_on = $request->wife_issued_on;
          //  $application->formable->agentPassport->expires_on = $request->agent_expire_on;

            if($request->hasFile('wife_passport_attachment')){
                $application->formable->wifePassport->attachment = $wife_passport_file_path;
            }

            $application->formable->wifePassport->save();       
        }
        else{
            $user = auth()->user();
            $husband_passport = $user->passports()->create([
                'passport_number' => $request->husband_passport_number,                                             
                'issued_by' => 'YE',
                'passport_center_id' => $request->husband_passport_center,
                'issued_on' => $request->husband_issued_on,
                //'expires_on' => $request->client_expire_on,
                'attachment' => $husband_passport_file_path
            ]);

            $wife_passport = $user->passports()->create([
                'passport_number' => $request->wife_passport_number,
                'issued_by' => 'YE',
                'passport_center_id' => $request->wife_passport_center,
                'issued_on' => $request->wife_issued_on,
                //'expires_on' => $request->agent_expire_on,
                'attachment' => $wife_passport_file_path
            ]);
    
            $marriage = MarriageCertificate::create([
                'husband_name' => ucwords($request->husband_name),
                'wife_name' => ucwords($request->wife_name),
                'phone_number' => $request->phone_number,
                'date_of_marriage' => $request->date_of_marriage,
                'husband_passport_id' => $husband_passport->id,
                'wife_passport_id' => $wife_passport->id,
                'husband_emirates_id' => $request->husband_emirates_id,
                'wife_emirates_id' => $request->wife_emirates_id,
                'contract_issued_by' => $request->contract_issued_by,
                'contract_issued_on' => $request->contract_issued_on,
                'registration_number' => $request->registration_number,
                'husband_residance_permit' => $husband_residance_permit_file_path,
                'wife_residance_permit' => $wife_residance_permit_file_path,
                'marriage_document' => $marriage_document_file_path
            ]);

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $marriage->id,
                'formable_type' => \App\Models\MarriageCertificate::class,
                'form_type_id' => '6'
            ]); 
        }
       
        return redirect()->route('marriage-certificate.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verifyMarriageCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

       // dd($application_id);
        return view('marriage-certificate.verify-marriage-certificate', ['application' => $application]);
    }

    public function editMarriageCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'marriage-certificate']);
        
        return view('marriage-certificate.create');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\OtherCertificate;

class OtherCertificateController extends Controller
{
     public function create()
    {
        session(['category' => '5', 'app' => 'applications/other-certificate']);
        if(session()->has('edit_application'))
        {
            session()->forget(['edit_application', 'application_id']);
        }
        return view('other-certificate.create');
    }
    public function store(Request $request)
    {
        $user = auth()->user();
        if($request->hasFile('attachment')) {
            $file_path = $request->file('attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('id_card')) {
            $id_card_file_path = $request->file('id_card')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('supporting_document')) {
            $supporting_document_file_path = $request->file('supporting_document')->store('uploads/user_' . auth()->id());
        }
      
        if($request->has('application')){
            $application = Form::findOrFail($request->application);
         //   dd($application->formable->passport);
            $application->formable->name = $request->name;
            $application->formable->phone_number = $request->phone_number;
            $application->formable->emirates_id = $request->emirates_id;
            $application->formable->supporting_reason = $request->supporting_reason;

            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->passport_center_id = $request->passport_center;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expires_on;

            if($request->hasFile('attachment')){
                $application->formable->passport->attachment = $file_path;
            }
            if($request->hasFile('id_card')) {
                $application->formable->id_card = $id_card_file_path;
            }
            if($request->hasFile('supporting_document')) {
            $application->formable->supporting_document = $supporting_document_file_path;
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
    
            $UnivercityCertificate = OtherCertificate::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'emirates_id' => $request->emirates_id,
                'passport_id' => $passport->id,
                'id_card' => $id_card_file_path,
                'supporting_document' => $supporting_document_file_path,
                'supporting_reason' => $request->supporting_reason,

            ]);
            $application = auth()->user()->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $UnivercityCertificate->id,
                'formable_type' => \App\Models\OtherCertificate::class,
                'form_type_id' => '19'
            ]); 
        }
        
       
        return redirect()->route('other-certificate.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verifyOtherCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        return view('other-certificate.verify-other-certificate', ['application' => $application]);
    }

    public function editOtherCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'other-certificate']);
        
        return view('other-certificate.create');
    }
}

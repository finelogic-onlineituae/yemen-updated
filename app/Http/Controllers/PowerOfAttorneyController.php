<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\PowerOfAttorney;

class PowerOfAttorneyController extends Controller
{
    public function create(Request $request)
    {
        session(['category' => '2', 'app' => 'applications/power-of-attorney']);
        if(session()->has('edit_application'))
        {
            session()->forget(['edit_application', 'application_id']);
        }

        return view('power-of-attorney.create');
    }

    public function store(Request $request)
    {
        if($request->hasFile('client_passport_attachment')) {
            $client_passport_file_path = $request->file('client_passport_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('agent_passport_attachment')) {
            $agent_passport_file_path = $request->file('agent_passport_attachment')->store('uploads/user_' . auth()->id());
        }

        if($request->hasFile('poa_document')) {
            $poa_document_file_path = $request->file('poa_document')->store('uploads/user_' . auth()->id());
        }
        
        if($request->hasFile('residance_permit')) {
            $residance_permit_file_path = $request->file('residance_permit')->store('uploads/user_' . auth()->id());
        }

        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->client_name = ucfirst($request->client_name);
            $application->formable->agent_name = ucfirst($request->agent_name);
            $application->formable->phone_number = $request->phone_number;
            $application->formable->emirate_id = $request->emirate_id;
            $application->formable->purpose = $request->purpose;

            if($request->hasFile('residance_permit')) {
            $application->formable->residance_permit = $residance_permit_file_path;
            }
                
            if($request->hasFile('poa_document')) {
            $application->formable->poa_document = $poa_document_file_path;
            }
            $application->formable->save();    

            //update client passport
            $application->formable->clientPassport->passport_number = $request->client_passport_number;
            $application->formable->clientPassport->passport_center_id = $request->client_passport_center;
            $application->formable->clientPassport->issued_on = $request->client_issued_on;

            if($request->hasFile('client_passport_attachment')){
                $application->formable->clientPassport->attachment = $client_passport_file_path;
            }

            $application->formable->clientPassport->save(); 
            //update agent passport
            $application->formable->agentPassport->passport_number = $request->agent_passport_number;
            $application->formable->agentPassport->passport_center_id = $request->agent_passport_center;
            $application->formable->agentPassport->issued_on = $request->agent_issued_on;
            $application->formable->agentPassport->expires_on = $request->agent_expire_on;

            if($request->hasFile('agent_passport_attachment')){
                $application->formable->agentPassport->attachment = $agent_passport_file_path;
            }

            $application->formable->agentPassport->save();       
        }
        else{
            $user = auth()->user();
            $client_passport = $user->passports()->create([
                'passport_number' => $request->client_passport_number,                                             
                'issued_by' => 'YE',
                'passport_center_id' => $request->client_passport_center,
                'issued_on' => $request->client_issued_on,
                'expires_on' => $request->client_expire_on,
                'attachment' => $client_passport_file_path
            ]);

            $agent_passport = $user->passports()->create([
                'passport_number' => $request->agent_passport_number,
                'issued_by' => 'YE',
                'passport_center_id' => $request->agent_passport_center,
                'issued_on' => $request->agent_issued_on,
                'expires_on' => $request->agent_expire_on,
                'attachment' => $agent_passport_file_path
            ]);
    
            $powerOfAttorney = PowerOfAttorney::create([
                'client_name' => ucwords($request->client_name),
                'agent_name' => ucwords($request->agent_name),
                'phone_number' => $request->phone_number,
                'client_passport_id' => $client_passport->id,
                'agent_passport_id' => $agent_passport->id,
                'emirate_id' => $request->emirate_id,
                'purpose' => $request->purpose,
                'residance_permit' => $residance_permit_file_path,
                'poa_document' => $poa_document_file_path
            ]);

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $powerOfAttorney->id,
                'formable_type' => \App\Models\PowerOfAttorney::class,
                'form_type_id' => '4'
            ]); 
        }
       
        return redirect()->route('power-of-attorney.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verify(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

       // dd($application);
        return view('power-of-attorney.verify-power-of-attorney', ['application' => $application]);
    }

    public function edit(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'power-of-attorney']);
        
        return view('power-of-attorney.create');
    }
}

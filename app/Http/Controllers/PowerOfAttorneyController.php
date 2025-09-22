<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\PowerOfAttorney;
use App\Models\Country;
use App\Models\PassportCenter;

class PowerOfAttorneyController extends Controller
{
    public function create(Request $request)
    {
        session(['category' => '2', 'app' => 'applications/power-of-attorney']);
        if(session()->has('edit_application'))
        {
            session()->forget(['edit_application', 'application_id']);
        }
        
        return view('power-of-attorney.create', ['countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

    public function store(Request $request)
    {

        $request->validate([
                'client_name' => 'required|max:255',
                'nationality' => 'required|exists:countries,id',
                'agent_name' => 'required|max:255',
                'agent_id_number' => 'required|max:255',
                'passport_number' => 'required',
                'passport_center' => 'required|exists:passport_centers,id',
                'issued_on' => 'required|date',
                'expire_on' => 'required|date',
                'passport_attachment' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'emirate_id_attachment' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'purpose' => 'required',
                'agent_id_attachment' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'poa_document' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
        ]);
        if($request->hasFile('passport_attachment')) {
            $client_passport_file_path = $request->file('passport_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('emirate_id_attachment')) {
            $client_emirate_id_file_path = $request->file('emirate_id_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('agent_id_attachment')) {
            $agent_id_file_path = $request->file('agent_id_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('poa_document')) {
            $poa_document_file_path = $request->file('poa_document')->store('uploads/user_' . auth()->id());
        }
        
        

        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->client_name = ucfirst($request->client_name);
            $application->formable->nationality = $request->nationality;
            $application->formable->agent_name = ucfirst($request->agent_name);
            $application->formable->agent_id_number = $request->agent_id_number;
            $application->formable->purpose = $request->purpose;
                
            if($request->hasFile('agent_id_attachment')) {
            $application->formable->agent_id_attachment = $agent_id_file_path;
            }
            if($request->hasFile('emirate_id_attachment')) {
            $application->formable->emirate_id_attachment = $client_emirate_id_file_path;
            }
            if($request->hasFile('poa_document')) {
            $application->formable->poa_document = $poa_document_file_path;
            }
            if($request->hasFile('passport_attachment')) {
            $application->formable->clientPassport->passport_attachment = $client_passport_file_path;
            }
            $application->formable->save();    

            //update client passport
            $application->formable->clientPassport->passport_number = $request->passport_number;
            $application->formable->clientPassport->passport_center_id = $request->passport_center;
            $application->formable->clientPassport->issued_on = $request->issued_on;
            $application->formable->clientPassport->expires_on = $request->expire_on;

            if($request->hasFile('passport_attachment')){
                $application->formable->clientPassport->attachment = $client_passport_file_path;
            }

            $application->formable->clientPassport->save(); 
             
        }
        else{
            $user = auth()->user();
            $client_passport = $user->passports()->create([
                'passport_number' => $request->passport_number,                                             
                'issued_by' => 'YE',
                'passport_center_id' => $request->passport_center,
                'issued_on' => $request->issued_on,
                'expires_on' => $request->expire_on,
                'attachment' => $client_passport_file_path
            ]);

          
    
            $powerOfAttorney = PowerOfAttorney::create([
                'client_name' => ucwords($request->client_name),
                'nationality' => $request->nationality,
                'agent_name' => ucwords($request->agent_name),
                'agent_id_number' => $request->agent_id_number,
                'client_passport_id' => $client_passport->id,
                'emirate_id_attachment' => $client_emirate_id_file_path,
                'purpose' => $request->purpose,
                'agent_id_attachment' => $agent_id_file_path,
                'poa_document' => $poa_document_file_path
            ]);

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $powerOfAttorney->id,
                'formable_type' => \App\Models\PowerOfAttorney::class,
                'form_type_id' => '4'
            ]); 
        }
       
        return redirect()->route('power-of-attorney.verify', ['application_id' => $application->id]);
    }
    public function verify(Request $request)
    {
        $application = Form::findOrFail($request->application_id);
        
        return view('power-of-attorney.verify-power-of-attorney', ['application' => $application, 'countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
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

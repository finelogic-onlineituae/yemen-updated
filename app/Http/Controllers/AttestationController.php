<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Country;
use App\Models\PassportCenter;
use App\Models\Attestation;

class AttestationController extends Controller
{
     public function create(Request $request)
    {
        session([ 'category' => '5','app' => 'applications/attestation']);
        $countries = Country::all();
        $passport_centers = PassportCenter::all();
        return view('attestation.create', ['countries' => $countries, 'passport_centers' => $passport_centers]);
    }
    public function chooseType()
    {
        session([ 'category' => '5','app' => 'applications/attestation']);
        return view('attestation.choose-type');
    }
    public function promptRequirement()
    {
        session([ 'category' => '5','app' => 'applications/attestation']);
        return view('attestation.authentication');
    }
    public function requirementFailure()
    {
        session([ 'category' => '5','app' => 'applications/attestation']);
        return view('attestation.failure');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|max:255',
            'nationality' => 'required|exists:countries,id',
            'phone_number' => 'required',
            'issuing_country' => 'required|exists:countries,id',
            'passport_number' => 'required|string|min:8',
            'passport_center' => 'required|exists:passport_centers,id',
            'issued_on' => 'required|before:tomorrow',
            'passport_attachment' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'emirate_id_attachment' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'document_attachment' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
        ]);

        if($request->hasFile('passport_attachment')) {
            $passport_file_path = $request->file('passport_attachment')->store('uploads/user_' . auth()->id());
        }

        if($request->hasFile('emirate_id_attachment')) {
            $emirate_id_file_path = $request->file('emirate_id_attachment')->store('uploads/user_' . auth()->id());
        }

        if($request->hasFile('document_attachment')) {
            $document_file_path = $request->file('document_attachment')->store('uploads/user_' . auth()->id());
        }
      

        if($request->has('application')){
          //  dd($request->document_type);
           $application = Form::findOrFail($request->application);
           $application->formable->passport->passport_number = $request->passport_number;
           $application->formable->passport->passport_center_id = $request->passport_center;
           $application->formable->passport->issued_on = $request->issued_on;
           if($request->hasFile('passport_attachment')) {
            $application->formable->passport->attachment = $passport_file_path;
           }
           $application->formable->name = $request->name;
           $application->formable->nationality = $request->nationality;
           $application->formable->phone_number = $request->phone_number;
           $application->formable->document_type = $request->document_type;
           $application->formable->issuing_country = $request->issuing_country;
           $application->formable->issuing_authority = $request->document_issuing_authority;
           if($request->hasFile('emirate_id_attachment')) {
            $application->formable->emirate_id_attachment = $emirate_id_file_path;
           }
           if($request->hasFile('document_attachment')) {
            $application->formable->document_to_attest = $document_file_path;
           }

           $application->formable->passport->save();
           $application->formable->save();
        }
        else{
            $user = auth()->user();
             $passport = $user->passports()->create([
                'passport_number' => $request->passport_number,
                'issued_by' => 'YE',
                'passport_center_id' => $request->passport_center,
                'issued_on' => $request->issued_on,
                
                'attachment' => $passport_file_path
            ]);

           
    
            $attestation = Attestation::create([
                'name' => $request->name,
                'nationality' => $request->nationality,
                'phone_number' => $request->phone_number,
                'passport_id' => $passport->id,
                'document_type' => $request->document_type,
              
                'issuing_country' => $request->issuing_country,
                'issuing_authority' => $request->document_issuing_authority,
                'emirate_id_attachment' => $emirate_id_file_path,
                'document_to_attest' => $document_file_path,

            ]);

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $attestation->id,
                'formable_type' => \App\Models\Attestation::class,
                'form_type_id' => '17'
            ]); 
        }
       
        return redirect()->route('attestation.verify', ['application_id' => $application->id]);
    }
    public function verifyAttestation(Request $request)
    {
        $application = Form::findOrFail($request->application_id);
        return view('attestation.verify', ['application' => $application, 'countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
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

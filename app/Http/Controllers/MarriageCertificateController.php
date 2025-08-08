<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Country;
use App\Models\PassportCenter;
use App\Models\MarriageCertificate;

class MarriageCertificateController extends Controller
{
    public function createMarriageCertificate(Request $request)
    {
        session([ 'category' => '1','app' => 'applications/marriage-certificate']);
       

        return view('marriage-certificate.create', ['countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

    public function storeMarriageCertificate(Request $request)
    {

        $request->validate([
            'name_english' => 'required',
            
            'name_arabic' => 'required',
            'profession' => 'required',
            'country_of_birth' => 'required|exists:countries,id',
            'city_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'contract_issued_by' => 'required',
            'registration_number' => 'required',
            'contract_issued_on' => 'required|date',
            'date_of_marriage' => 'required|date',
            'emirates_id_attachment' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'passport_number' => 'required|string|min:8',
            'expire_on' => 'required',
            'passport_center' => 'required|exists:passport_centers,id',
            'issued_on' => 'required|before:tomorrow',
            'passport_attachment' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'marriage_document' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
        ]);

        if($request->hasFile('passport_attachment')) {
            $passport_file_path = $request->file('passport_attachment')->store('uploads/user_' . auth()->id());
        }
        
        if($request->hasFile('emirates_id_attachment')) {
            $emirates_id_attachment = $request->file('emirates_id_attachment')->store('uploads/user_' . auth()->id());
        }

        if($request->hasFile('marriage_document')) {
            $marriage_document_file_path = $request->file('marriage_document')->store('uploads/user_' . auth()->id());
        }

        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->name_english = ucfirst($request->name_english);
            $application->formable->name_arabic = $request->name_arabic;
            $application->formable->date_of_marriage = $request->date_of_marriage;
            $application->formable->country_of_birth = $request->country_of_birth;
            $application->formable->city_of_birth = $request->city_of_birth;
            $application->formable->date_of_birth = $request->date_of_birth;
            $application->formable->gender = $request->gender;
            $application->formable->profession = $request->profession;
            $application->formable->contract_issued_by = $request->contract_issued_by;
            $application->formable->contract_issued_on = $request->contract_issued_on;
            $application->formable->registration_number = $request->registration_number;

            
            if($request->hasFile('emirates_id_attachment')) {
                $application->formable->emirates_id_attachment = $emirates_id_file_path;
            }    
            if($request->hasFile('marriage_document')) {
            $application->formable->marriage_document = $marriage_document_file_path;
            }
            $application->formable->save();    

            //update client passport
            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->passport_center_id = $request->passport_center;
            $application->formable->passport->issued_on = $request->issued_on;

            if($request->hasFile('passport_attachment')){
                $application->formable->passport->attachment = $passport_file_path;
            }

            $application->formable->passport->save(); 
            
            //update agent passport
          /*  $application->formable->wifePassport->passport_number = $request->wife_passport_number;
            $application->formable->wifePassport->passport_center_id = $request->wife_passport_center;
            $application->formable->wifePassport->issued_on = $request->wife_issued_on;
          //  $application->formable->agentPassport->expires_on = $request->agent_expire_on;

            $application->formable->wifePassport->save();       */
        }
        else{
            $user = auth()->user();
            $passport = $user->passports()->create([
                'passport_number' => $request->passport_number,                                             
                'issued_by' => 'YE',
                'passport_center_id' => $request->passport_center,
                'issued_on' => $request->issued_on,
                'expires_on' => $request->expire_on,
                'attachment' => $passport_file_path
            ]);

           
    
            $marriage = MarriageCertificate::create([
                'name_english' => ucwords($request->name_english),
                'name_arabic' => $request->name_arabic,
                'country_of_birth' => $request->country_of_birth,
                'city_of_birth' => $request->city_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'profession' => $request->profession,
                'date_of_marriage' => $request->date_of_marriage,
                'passport_id' => $passport->id,
                'contract_issued_by' => $request->contract_issued_by,
                'contract_issued_on' => $request->contract_issued_on,
                'registration_number' => $request->registration_number,
                'emirates_id_attachment' => $emirates_id_attachment,
                'marriage_document' => $marriage_document_file_path
            ]);

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $marriage->id,
                'formable_type' => \App\Models\MarriageCertificate::class,
                'form_type_id' => '6'
            ]); 
        }
       
        return redirect()->route('marriage-certificate.verify', ['application_id' => $application->id]);
    }
    public function verifyMarriageCertificate(Request $request)
    {
        $application_id = $request->application_id;
        $application = Form::findOrFail($application_id);

       // dd($application_id);
        return view('marriage-certificate.verify-marriage-certificate', ['application' => $application, 'countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
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

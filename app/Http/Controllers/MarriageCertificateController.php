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
//dd($request->all());
        $request->validate([
            'husband_name_arabic' => 'required',
            'husband_passport_number' => 'required',
            'husband_passport_issued_on' => 'required|date|before:tomorrow',
            'wife_name_arabic' => 'required',
            'wife_passport_number' => 'required',
            'wife_passport_issued_on' => 'required|date|before:tomorrow',
            'contract_issued_by' => 'required',
            'registration_number' => 'required',
            'date_of_marriage' => 'required|date',
            'husband_passport_number' => 'required|string|min:8',
            'husband_passport_attachment' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'husband_emirate_id_attachment' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'wife_passport_attachment' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'wife_emirate_id_attachment' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'marriage_document' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
        ]);

        if($request->hasFile('husband_passport_attachment')) {
            $husband_passport_file_path = $request->file('husband_passport_attachment')->store('uploads/user_' . auth()->id());
        }
        
        if($request->hasFile('husband_emirate_id_attachment')) {
            $husband_emirates_id_file_path = $request->file('husband_emirate_id_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('wife_passport_attachment')) {
            $wife_passport_file_path = $request->file('wife_passport_attachment')->store('uploads/user_' . auth()->id());
        }
        
        if($request->hasFile('wife_emirate_id_attachment')) {
            $wife_emirates_id_file_path = $request->file('wife_emirate_id_attachment')->store('uploads/user_' . auth()->id());
        }

        if($request->hasFile('marriage_document')) {
            $marriage_document_file_path = $request->file('marriage_document')->store('uploads/user_' . auth()->id());
        }

        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->husband_name_arabic = $request->husband_name_arabic;
            $application->formable->husband_passport_number = $request->husband_passport_number;
            $application->formable->husband_passport_issued_on = $request->husband_passport_issued_on;

            $application->formable->wife_name_arabic = $request->wife_name_arabic;
            $application->formable->wife_passport_number = $request->wife_passport_number;
            $application->formable->wife_passport_issued_on = $request->wife_passport_issued_on;

            
            $application->formable->date_of_marriage = $request->date_of_marriage;
            $application->formable->contract_issued_by = $request->contract_issued_by;
            $application->formable->registration_number = $request->registration_number;

            if($request->hasFile('husband_passport_attachment')) {
                $application->formable->husband_passport_attachment = $husband_passport_file_path;
            }   
            if($request->hasFile('husband_emirates_id_attachment')) {
                $application->formable->husband_emirate_id_attachment = $husband_emirates_id_file_path;
            } 
            if($request->hasFile('wife_passport_attachment')) {
                $application->formable->wife_passport_attachment = $wife_passport_file_path;
            }   
            if($request->hasFile('wife_emirates_id_attachment')) {
                $application->formable->wife_emirate_id_attachment = $wife_emirates_id_file_path;
            }    
            if($request->hasFile('marriage_document')) {
            $application->formable->marriage_document = $marriage_document_file_path;
            }
            $application->formable->save();    
            
        }
        else{
            $user = auth()->user();

            $marriage = MarriageCertificate::create([
                'husband_name_arabic' => $request->husband_name_arabic,
                'husband_passport_number' => $request->husband_passport_number,
                'husband_passport_issued_on' => $request->husband_passport_issued_on,
                'husband_passport_attachment' => $husband_passport_file_path,
                'husband_emirate_id_attachment' => $husband_emirates_id_file_path,

                'wife_name_arabic' => $request->wife_name_arabic,
                'wife_passport_number' => $request->wife_passport_number,
                'wife_passport_issued_on' => $request->wife_passport_issued_on,
                'wife_passport_attachment' => $wife_passport_file_path,
                'wife_emirate_id_attachment' => $wife_emirates_id_file_path,

                'date_of_marriage' => $request->date_of_marriage,
                'contract_issued_by' => $request->contract_issued_by,
                'registration_number' => $request->registration_number,
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

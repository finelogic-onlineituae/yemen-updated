<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passport;
use App\Models\Form;
use App\Models\Country;
use App\Models\PassportCenter;
use App\Models\BirthCertificate;

class BirthCertificateController extends Controller
{
    public function createBirthCertificate()
    {
        session(['category' => '1', 'app' => 'applications/birth-certificate']);
        if(session()->has('edit_application'))
        {
            session()->forget(['edit_application', 'application_id']);
        }
        return view('birth-certificate.birth-certificate', ['countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }
    public function storeBirthCertificate(Request $request)
    {
         $request->validate([
            
            'name_arabic' => 'required',
            'profession' => 'required',
            'country_of_birth' => 'required|exists:countries,id',
            'city_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'mother_name' => 'required',
            'mother_nationality' => 'required|exists:countries,id',
            'father_name' => 'required',
            'father_nationality' => 'required|exists:countries,id',
            'emirate_id_attachment' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'passport_number' => 'required|string|min:8',
            'expire_on' => 'required',
            'passport_center' => 'required|exists:passport_centers,id',
            'issued_on' => 'required|before:tomorrow',
            'passport_attachment' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'father_passport_attachment' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'mother_passport_attachment' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
        ]);
        $user = auth()->user();

        if($request->hasFile('passport_attachment')) {
            $passport_file_path = $request->file('passport_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('emirate_id_attachment')) {
            $emirate_id_file_path = $request->file('emirate_id_attachment')->store('uploads/user_' . auth()->id());
            //dd($emirate_id_file_path);
        }
        if($request->hasFile('father_passport_attachment')) {
            $father_passport_file_path = $request->file('father_passport_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('mother_passport_attachment')) {
            $mother_passport_file_path = $request->file('mother_passport_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->has('application')){
            $application = Form::findOrFail($request->application);
         //   dd($application->formable->passport);
            $application->formable->country_of_birth = $request->country_of_birth;
            $application->formable->city_of_birth = $request->city_of_birth;
            $application->formable->date_of_birth = $request->date_of_birth;
            $application->formable->profession = $request->profession;
            $application->formable->mother_name = $request->mother_name;
            $application->formable->mother_nationality = $request->mother_nationality;
            $application->formable->father_name = $request->father_name;
            $application->formable->father_nationality = $request->father_nationality;
            $application->formable->gender = $request->gender;
            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->passport_center_id = $request->passport_center;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expire_on;
            

            if($request->hasFile('passport_attachment')){
                $application->formable->passport->attachment = $passport_file_path;
            }
           if($request->hasFile('emirate_id_attachment')){
                $application->formable->emirate_id_attachment = $emirate_id_file_path;
            }

            if($request->hasFile('father_passport_attachment')){
                $application->formable->father_passport_attachment = $father_passport_file_path;
            }
            if($request->hasFile('mother_passport_attachment')){
                $application->formable->mother_passport_attachment = $mother_passport_file_path;
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
                'expires_on' => $request->expire_on,
                'attachment' => $passport_file_path
            ]);
    
            $birthCertificate = BirthCertificate::create([
                'name_arabic' => $request->name_arabic,
                'profession' => $request->profession,
                'date_of_birth' => $request->date_of_birth,
                'country_of_birth' => $request->country_of_birth,
                'city_of_birth' => $request->city_of_birth,
                'mother_name' => $request->mother_name,
                'mother_nationality' => $request->mother_nationality,
                'father_name' => $request->father_name,
                'father_nationality' => $request->father_nationality,
                'passport_id' => $passport->id,
                'emirate_id_attachment' => $emirate_id_file_path,
                'gender' => $request->gender,
                'father_passport_attachment' => $father_passport_file_path,
                'mother_passport_attachment' => $mother_passport_file_path,
            ]);
            $application = auth()->user()->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $birthCertificate->id,
                'formable_type' => \App\Models\BirthCertificate::class,
                'form_type_id' => '1'
            ]); 
        }
        
       
        return redirect()->route('birth-certificate.verify', ['application_id' => $application->id]);
    }
    public function verifyBirthCertificate(Request $request)
    {
        $application_id = $request->application_id;
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        return view('birth-certificate.verify-birth-certificate', ['application' => $application, 'countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

    public function editBirthCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'birth-certificate']);
        
        return view('birth-certificate.birth-certificate');
    }

 /*   public function confirmBirthCertificate(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

        $application->status = 'Applied';
        $application->save();
        
        session()->forget(['edit_birth_certificate', 'application_id']);
        return redirect()->route('birth-certificate.success', ['application_id' => encrypt($application->id)]);

    }

    public function postBirthCertificate(Request $request)
    {
     
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        return view('birth-certificate.confirm-birth-certificate', ['application_id' => $application->id]);
    }*/
}

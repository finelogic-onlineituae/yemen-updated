<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrivingLicenceCenter;
use App\Models\VehicleCategory;
use App\Models\DrivingLicence;
use App\Models\Form;
use App\Models\Country;
use App\Models\PassportCenter;

class DrivingLicenceController extends Controller
{
    public function createDrivingLicence(Request $request)
    {
        session(['category' => '1', 'app' => 'applications/driving-licence']);
        if(session()->has('edit_application'))
        {
            session()->forget(['edit_application', 'application_id']);
        }

        return view('driving-licence.create', [
            'countries' => Country::all(), 
            'passport_centers' => PassportCenter::all(), 
            'driving_licence_centers' => DrivingLicenceCenter::all(), 
            'vehicle_categories' => VehicleCategory::all()
        ]);
    }

    public function storeDrivingLicence(Request $request)
    {
        $request->validate([
            'name_arabic' => 'required',
            'driving_licence_number' => 'required',
            'driving_licence_center' => 'required|exists:driving_licence_centers,id',
            'vehicle_category_id' => 'requiredexists:vehicle_categories,id',
            'dl_issued_on' => 'required',
            'dl_expire_on' => 'required',
            'emirate_id_attachment' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'driving_licence' =>  $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'passport_number' => 'required|string|min:8',
            'expire_on' => 'required',
            'passport_center' => 'required|exists:passport_centers,id',
            'issued_on' => 'required|before:tomorrow',
            'passport_attachment' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
        ]);

        if($request->hasFile('passport_attachment')) {
            $passport_file_path = $request->file('passport_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('emirate_id_attachment')) {
            $emirate_id_file_path = $request->file('emirate_id_attachment')->store('uploads/user_' . auth()->id());
        }
       if($request->hasFile('driving_licence')) {
            $licence_file_path = $request->file('driving_licence')->store('uploads/user_' . auth()->id());
        }

        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->name_arabic = $request->name_arabic;
          
            $application->formable->driving_licence_number = $request->driving_licence_number;
            $application->formable->driving_licence_center_id = $request->driving_licence_center;
            $application->formable->vehicle_category_id = $request->vehicle_category;
            $application->formable->dl_issued_on = $request->dl_issued_on;
            $application->formable->dl_expire_on = $request->dl_expire_on;
        
            //update passport
            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->passport_center_id = $request->passport_center;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expire_on;

            if($request->hasFile('passport_attachment')){
                $application->formable->passport->attachment = $passport_file_path;
            }
             if($request->hasFile('emirate_id_attachment')){
                $application->formable->emirates_id_attachment = $emirate_id_file_path;
            }
            if($request->hasFile('driving_licence')){
                $application->formable->driving_licence_attachment = $licence_file_path;
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
                'expires_on' => $request->expire_on,
                'attachment' => $passport_file_path
            ]);
    
            $drivingLicence = DrivingLicence::create([
                'name_arabic' => $request->name_arabic,
                'passport_id' => $passport->id,
                'driving_licence_number' => $request->driving_licence_number,
                'driving_licence_center_id' => $request->driving_licence_center,
                'vehicle_category_id' => $request->vehicle_category,
                'dl_issued_on' => $request->dl_issued_on,
                'dl_expire_on' => $request->dl_expire_on,
                'emirates_id_attachment' => $emirate_id_file_path,
                'driving_licence_attachment' => $licence_file_path
            ]);

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $drivingLicence->id,
                'formable_type' => \App\Models\DrivingLicence::class,
                'form_type_id' => '2'
            ]); 
        }
       
        return redirect()->route('driving-licence.verify', ['application_id' => $application->id]);
    }
    public function verifyDrivingLicence(Request $request)
    {
        $application_id = $request->application_id;
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        
        //dd($application);
        return view('driving-licence.verify-driving-licence', [
            'application' => $application,
            'countries' => Country::all(), 
            'passport_centers' => PassportCenter::all(), 
            'driving_licence_centers' => DrivingLicenceCenter::all(), 
            'vehicle_categories' => VehicleCategory::all()
        ]);
    }

    public function editDrivingLicence(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'driving-licence']);
        
        return view('driving-licence.create');
    }

    
}

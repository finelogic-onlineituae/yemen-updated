<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrivingLicenceCenter;
use App\Models\VehicleCategory;
use App\Models\DrivingLicence;
use App\Models\Form;

class DrivingLicenceController extends Controller
{
    public function createDrivingLicence(Request $request)
    {
        session(['category' => '1', 'app' => 'applications/driving-licence']);
        if(session()->has('edit_application'))
        {
            session()->forget(['edit_application', 'application_id']);
        }

        return view('driving-licence.create');
    }

    public function storeDrivingLicence(Request $request)
    {
        if($request->hasFile('attachment')) {
            $file_path = $request->file('attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('licence_attachment')) {
            $licence_file_path = $request->file('licence_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('residance_permit')) {
            $residance_permit_file_path = $request->file('residance_permit')->store('uploads/user_' . auth()->id());
        }

        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            
            $application->formable->name = ucfirst($request->name);
            $application->formable->phone_number = $request->phone_number;
            $application->formable->driving_licence_number = $request->driving_licence_number;
            $application->formable->driving_licence_center_id = $request->driving_licence_center;
            $application->formable->vehicle_category_id = $request->vehicle_category;
            $application->formable->issued_on = $request->issued_on;
            $application->formable->expire_on = $request->expire_on;
            $application->formable->emirates_id = $request->emirates_id;

            if($request->hasFile('residance_permit')) {
            $application->formable->residance_permit = $residance_permit_file_path;
            }
            if($request->hasFile('licence_attachment')){
                $application->formable->licence_attachment = $licence_file_path;
            }

            //update passport
            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->passport_center_id = $request->passport_center;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expires_on;

            if($request->hasFile('attachment')){
                $application->formable->passport->attachment = $file_path;
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
                'expires_on' => $request->expires_on,
                'attachment' => $file_path
            ]);
    
            $drivingLicence = DrivingLicence::create([
                'name' => ucwords($request->name),
                'phone_number' => $request->phone_number,
                'passport_id' => $passport->id,
                'driving_licence_number' => $request->driving_licence_number,
                'driving_licence_center_id' => $request->driving_licence_center,
                'vehicle_category_id' => $request->vehicle_category,
                'issued_on' => $request->issued_on,
                'expire_on' => $request->expire_on,
                'emirates_id' => $request->emirates_id,
                'licence_attachment' => $licence_file_path,
                'residance_permit' => $residance_permit_file_path
            ]);

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $drivingLicence->id,
                'formable_type' => \App\Models\DrivingLicence::class,
                'form_type_id' => '2'
            ]); 
        }
       
        return redirect()->route('driving-licence.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verifyDrivingLicence(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        
        //dd($application);
        return view('driving-licence.verify-driving-licence', ['application' => $application]);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoIdCard;
use App\Models\Form;
use App\Models\PassportCenter;
use Illuminate\Support\Facades\URL;

class NoIdCardController extends Controller
{
    public function create(Request $request)
    {
        session(['category' => '1', 'app' => 'applications/no-id-card']);
        if(session()->has('edit_application'))
        {
            session()->forget(['edit_application', 'application_id']);
        }

        return view('no-id-card.create');
    }

    public function store(Request $request)
    {
        if($request->hasFile('attachment')) {
            $file_path = $request->file('attachment')->store('uploads/user_' . auth()->id());
        }
        
        if($request->hasFile('residance_permit')) {
            $residance_permit_file_path = $request->file('residance_permit')->store('uploads/user_' . auth()->id());
        }

        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->name = ucfirst($request->name);
            $application->formable->phone_number = $request->phone_number;
            $application->formable->emirates_id = $request->emirates_id;
            $application->formable->submitted_to = $request->submitted_to;

            if($request->hasFile('residance_permit')) {
            $application->formable->residance_permit = $residance_permit_file_path;
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
    
            $noIdCard = NoIdCard::create([
                'name' => ucwords($request->name),
                'phone_number' => $request->phone_number,
                'passport_id' => $passport->id,
                'emirates_id' => $request->emirates_id,
                'submitted_to' => $request->submitted_to,
                'residance_permit' => $residance_permit_file_path
            ]);

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $noIdCard->id,
                'formable_type' => \App\Models\NoIdCard::class,
                'form_type_id' => '3'
            ]); 
        }
       
        return redirect()->route('no-id-card.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verify(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);

        
        //dd($application);
        return view('no-id-card.verify-no-id-card', ['application' => $application]);
    }

    public function edit(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'no-id-card']);
        
        return view('no-id-card.create');
    }
}

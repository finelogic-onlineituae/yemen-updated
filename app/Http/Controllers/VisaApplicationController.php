<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\VisaApplication;


class VisaApplicationController extends Controller
{
     public function createVisaApplication(Request $request)
    {
        session(['category' => '4', 'app' => 'applications/visa-application']);
       
        return view('visa-application.create');
    }

    public function storeVisaApplicationAccompany(Request $request){

        $validated = $request->validate([
            'accompany_members.*.member_name' => 'required|string|max:255',
            'accompany_members.*.member_emirates_id' => 'required',
            'accompany_members.*.member_passport_number' => 'required|string|max:50',
            'accompany_members.*.member_passport_center' => 'required|exists:countries,id',
            'accompany_members.*.member_issued_on' => 'required|date',
            'accompany_members.*.member_expires_on' => 'required|date',
            'accompany_members.*.member_passport_attachment' => 'nullable|file|mimes:pdf|max:2048',
        ]);

       

        if($request->has('application')) {
          // Track incoming IDs
            $incomingIds = [];
        
            foreach ($request->accompany_members as $index => $member) {

                $passport_path = $request->file("accompany_members.{$index}.member_passport_attachment")?->store("uploads/user_" . auth()->id());

                if (!empty($member['id'])) {
                   
                    // Update existing member
                    $existingMember = \App\Models\VisaApplicationAccompany::find($member['id']);
                    if ($existingMember) {
                        $updateData = [
                            'name' => $member['member_name'],
                            'emirates_id' => $member['member_emirates_id'],
                        ];
                      
            
                        $existingMember->update($updateData);
            
                        if ($existingMember->passport) {
                            $passportUpdate = [
                                'passport_number' => $member['member_passport_number'],
                                'passport_center_id' => $member['member_passport_center'],
                                'issued_by' =>$member['member_passport_center'], 
                                'issued_on' => $member['member_issued_on'],
                                'expires_on' => $member['member_expires_on'],
                            ];
                            if ($passport_path) {
                                $passportUpdate['attachment'] = $passport_path;
                            }
            
                            $existingMember->passport->update($passportUpdate);
                        }
            
                        $incomingIds[] = $existingMember->id;
                    }
                } else {
                    // New member
                    $memberPassport = auth()->user()->passports()->create([
                        'passport_number' => $member['member_passport_number'],
                        'issued_by' =>$member['member_passport_center'], 
                        'passport_center_id' => $member['member_passport_center'],
                        'issued_on' => $member['member_issued_on'],
                        'expires_on' => $member['member_expires_on'],
                        'attachment' => $passport_path,
                    ]);
        
                    $newMember = \App\Models\VisaApplicationAccompany::create([
                        'name' => $member['member_name'],
                        'emirates_id' => $member['member_emirates_id'],
                        'passport_id' => $memberPassport->id,
                        'visa_application_id' => $request->visa_application_id,
                    ]);
        
                    $incomingIds[] = $newMember->id;
                }
            }

        }else{
            $user = auth()->user();
            foreach ($validated['accompany_members'] as $index => $member) {
          
                $passport_path = $request->file("accompany_members.{$index}.member_passport_attachment")?->store('uploads/user_' . auth()->id());
            
                $memberpassport = $user->passports()->create([
                   // 'member_name' => $member['member_name'],
                    'passport_number' => $member['member_passport_number'],
                    'issued_by' =>$member['member_passport_center'], 
                    'passport_center_id' => $member['member_passport_center'],
                    'issued_on' => $member['member_issued_on'],
                    'expires_on' => $member['member_expires_on'],
                    'attachment' => $passport_path,
                ]);

                \App\Models\VisaApplicationAccompany::create([
                    'name' => $member['member_name'],
                    'emirates_id' => $member['member_emirates_id'],
                    'passport_id' => $memberpassport->id,
                    'visa_application_id' => $request->visa_application_id,
                ]);
            }

        }

        return redirect()->route('visa-application.verify', ['application_id' => encrypt($request->applicationstore)]);
    }

    public function storeVisaApplication(Request $request)
    {
      
        if($request->hasFile('attachment')) {
            $file_path = $request->file('attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('id_card')) {
            $id_card_file_path = $request->file('id_card')->store('uploads/user_' . auth()->id());
        }

        if($request->hasFile('sponsor_pass')) {
            $sponsor_pass_file_path = $request->file('sponsor_pass')->store('uploads/user_' . auth()->id());
        }else{
            $sponsor_pass_file_path='';
        }
       // dd($sponsor_pass_file_path.$id_card_file_path);
        if($request->same_address){
            $address_same=$request->same_address;
        }else{
            $address_same=$request->address_uae;
        }

        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->name = ucfirst($request->name);
            $application->formable->nationality = $request->nationality;
            $application->formable->religion = $request->religion;
            $application->formable->permanent_address = $request->address;
            $application->formable->address_uae = $address_same;
            $application->formable->place_of_birth = $request->place_of_birth;
            $application->formable->date_of_birth = $request->date_of_birth;
            $application->formable->proffession = $request->proffession;
            $application->formable->place_of_work = $request->place_of_work;
            $application->formable->purpose_of_travel = $request->purpose_of_travel;
            $application->formable->period_required = $request->period_required;
            $application->formable->address_in_roy = $request->address_in_roy;
            $application->formable->sponsor_1_name = $request->sponsor_1_name;
            $application->formable->sponsor_2_name = $request->sponsor_2_name;
            $application->formable->sponsor_1_address = $request->sponsor_1_address;
            $application->formable->sponsor_2_address = $request->sponsor_2_address;
            $application->formable->previous_visit_date_1 = $request->previous_visit_date_1;
            $application->formable->previous_visit_date_2 = $request->previous_visit_date_2;

            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->passport_center_id = $request->passport_center;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expires_on;
         
            if($request->hasFile('id_card')) {
                $application->formable->id_card = $id_card_file_path;
            } 
            if($request->hasFile('sponsor_pass')) {
                $application->formable->sponsor_pass = $sponsor_pass_file_path;
            }    
            if($request->hasFile('attachment')) {
                $application->formable->passport->attachment = $file_path;
            }

            $application->formable->passport->save(); 
            $application->formable->save();    

             if(!$request->add_accompany){
                return redirect()->route('visa-application.verify', ['application_id' => encrypt($application->id)]);
            }else{
                    return redirect()->route('visa-application-accompany', ['application_id' => encrypt($application->id)]);
            }
            //return redirect()->route('visa-application.verify', ['application_id' => encrypt($application->id)]);

        }
        else{
            $user = auth()->user();
            $passport = $user->passports()->create([
                'passport_number' => $request->passport_number,
                'issued_by' => $request->issued_by, 
                'passport_center_id' => $request->passport_center,
                'issued_on' => $request->issued_on,
                'expires_on' => $request->expires_on,
                'attachment' => $file_path
            ]);

    
            $VisaApplication = VisaApplication::create([
                'name' => $request->name,
                'nationality' => $request->nationality,
                'religion' => $request->religion,
                'permanent_address' => $request->address,
                'address_uae' => $address_same,
                'passport_id' => $passport->id,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'proffession' => $request->proffession,
                'place_of_work' => $request->place_of_work,
                'purpose_of_travel' => $request->purpose_of_travel,
                'period_required' => $request->period_required,
                'address_in_roy' => $request->address_in_roy,
                'sponsor_1_name' => $request->sponsor_1_name,
                'sponsor_2_name' => $request->sponsor_2_name,
                'sponsor_1_address' => $request->sponsor_1_address,
                'sponsor_2_address' => $request->sponsor_2_address,
                'previous_visit_date_1' => $request->previous_visit_date_1,
                'previous_visit_date_2' => $request->previous_visit_date_2,
                'id_card' => $id_card_file_path,
                'sponsor_pass' => $sponsor_pass_file_path,
            ]);

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $VisaApplication->id,
                'formable_type' => \App\Models\VisaApplication::class,
                'form_type_id' => '15'
            ]); 
        }
       if(!$request->add_accompany){
            return redirect()->route('visa-application.verify', ['application_id' => encrypt($application->id)]);
       }else{
            return redirect()->route('visa-application-accompany', ['application_id' => encrypt($application->id)]);
       }
        

    }

    public function verifyVisaApplication(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

        return view('visa-application.verify-visa-application', ['application' => $application]);
    }

    public function VisaApplicationAccompany(Request $request)
    {
        $application_id = decrypt($request->application_id);
        // dd($application_id);
        //$application = Form::findOrFail($application_id);

        return view('visa-application.visa-accompany', ['application_id' => $application_id]);
    }

    public function editVisaApplicationAccompany(Request $request)
    {
        $application_id = decrypt($request->application_id);
       // dd($application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'visa-application-accompany']);
        
        return view('visa-application.visa-accompany', ['application_id' => $application_id]);
    }

    public function editVisaApplication(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'visa-application']);
        
        return view('visa-application.create');
    }




    public function travelDocuments(Request $request)
    {
        return view('visa-application.travel-info');
    }
}

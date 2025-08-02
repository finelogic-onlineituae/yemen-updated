<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\NoIdCardGroup;
use App\Models\NoIdCardGroupPassport;

class NoIdCardGroupController extends Controller
{
     public function create(Request $request)
    {
        session(['category' => '1', 'app' => 'applications/no-id-card-group']);
       
        return view('no-id-card-group.create');
    }

    public function store(Request $request)
    {
      
        $validated = $request->validate([
            'family_members.*.member_name' => 'required|string|max:255',
            'family_members.*.member_phone_number' => 'required',
            'family_members.*.member_emirates_id' => 'required',
            'family_members.*.member_submitted_to' => 'required',
            'family_members.*.member_passport_number' => 'required|string|max:50',
            'family_members.*.member_passport_center' => 'required|exists:passport_centers,id',
            'family_members.*.member_issued_on' => 'required|date',
            'family_members.*.member_residance_permit' => 'nullable|file|mimes:pdf|max:2048',
            'family_members.*.member_passport_attachment' => 'nullable|file|mimes:pdf|max:2048',
        ]);
       
       
        if($request->has('application')) {
            $application = Form::findOrFail($request->application);
            $formable = $application->formable;
        
        
            $formable->save();
                
            // Track incoming IDs
            $incomingIds = [];
        
            foreach ($request->family_members as $index => $member) {
                $res_permit_path = $request->file("family_members.{$index}.member_residance_permit")?->store("uploads/user_" . auth()->id());
                $passport_path = $request->file("family_members.{$index}.member_passport_attachment")?->store("uploads/user_" . auth()->id());

                if (!empty($member['id'])) {
                   
                    // Update existing member
                    $existingMember = \App\Models\NoIdCardGroupPassport::find($member['id']);
                    if ($existingMember) {
                        $updateData = [
                            'name' => $member['member_name'],
                            'phone_number' => $member['member_phone_number'],
                            'submitted_to' => $member['member_submitted_to'],
                            'emirates_id' => $member['member_emirates_id'],
                        ];
                        if ($res_permit_path) {
                            $updateData['residance_permit'] = $res_permit_path;
                        }
                     
            
                        $existingMember->update($updateData);
            
                        if ($existingMember->passport) {
                            $passportUpdate = [
                                'passport_number' => $member['member_passport_number'],
                                'passport_center_id' => $member['member_passport_center'],
                                'issued_on' => $member['member_issued_on'],
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
                        'issued_by' => 'YE',
                        'passport_center_id' => $member['member_passport_center'],
                        'issued_on' => $member['member_issued_on'],
                        'attachment' => $passport_path,
                    ]);
        
                    $newMember = \App\Models\NoIdCardGroupPassport::create([
                        'name' => $member['member_name'],
                        'phone_number' => $member['member_phone_number'],
                        'submitted_to' => $member['member_submitted_to'],
                        'emirates_id' => $member['member_emirates_id'],
                        'passport_id' => $memberPassport->id,
                        'no_id_card_group_id' => $formable->id,
                        'residance_permit' => $res_permit_path,
                    ]);
        
                    $incomingIds[] = $newMember->id;
                }
            }
         
        }
        
        else{
            $user = auth()->user();
            $family = NoIdCardGroup::create([

            ]);


            foreach ($validated['family_members'] as $index => $member) {
                $res_permit_path = $request->file("family_members.{$index}.member_residance_permit")?->store('uploads/user_' . auth()->id());
                $passport_path = $request->file("family_members.{$index}.member_passport_attachment")?->store('uploads/user_' . auth()->id());
            
                $memberpassport = $user->passports()->create([
                   // 'member_name' => $member['member_name'],
                    'passport_number' => $member['member_passport_number'],
                    'issued_by' => 'YE',
                    'passport_center_id' => $member['member_passport_center'],
                    'issued_on' => $member['member_issued_on'],
                    //'expires_on' => '',
                    'attachment' => $passport_path,
                ]);

                \App\Models\NoIdCardGroupPassport::create([
                    'name' => $member['member_name'],
                    'phone_number' => $member['member_phone_number'],
                    'submitted_to' => $member['member_submitted_to'],
                    'emirates_id' => $member['member_emirates_id'],
                    'passport_id' => $memberpassport->id,
                    'no_id_card_group_id' => $family->id,
                    'residance_permit' => $res_permit_path,
                ]);
            }

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $family->id,
                'formable_type' => \App\Models\NoIdCardGroup::class,
                'form_type_id' => '16'
            ]); 
        }
       
        return redirect()->route('no-id-card-group.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verify(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

       // dd($application);
        return view('no-id-card-group.verify-no-id-card-group', ['application' => $application]);
    }

    public function edit(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'no-id-card-group']);
        
        return view('no-id-card-group.create');
    }
}

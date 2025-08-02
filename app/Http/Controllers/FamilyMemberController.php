<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\ApplicationFamilyMembers;
use App\Models\ApplicationFamilyMemberspassport;

class FamilyMemberController extends Controller
{
    public function createFamilyMember(Request $request)
    {
        session(['category' => '1', 'app' => 'applications/family-member']);
       
        return view('family-member.create');
    }

    public function storeFamilyMember(Request $request)
    {
        $validated = $request->validate([
            'family_members.*.member_name' => 'required|string|max:255',
            'family_members.*.member_passport_number' => 'required|string|max:50',
            'family_members.*.member_passport_center' => 'required|exists:passport_centers,id',
            'family_members.*.member_issued_on' => 'required|date',
            'family_members.*.member_relation' => 'required',
            'family_members.*.member_residance_permit' => 'nullable|file|mimes:pdf|max:2048',
            'family_members.*.member_birth_certificate' => 'nullable|file|mimes:pdf|max:2048',
            'family_members.*.member_passport_attachment' => 'nullable|file|mimes:pdf|max:2048',
        ]);

       // dd($validated);
        // if($request->hasFile('passport_attachment')) {
        //     $file_path = $request->file('passport_attachment')->store('uploads/user_' . auth()->id());
        // }
        if($request->hasFile('attachment')) {
            $file_path = $request->file('attachment')->store('uploads/user_' . auth()->id());
        }

        if($request->hasFile('residance_permit')) {
            $residance_permit_file_path = $request->file('residance_permit')->store('uploads/user_' . auth()->id());
        }
        
        if($request->has('application')) {
            $application = Form::findOrFail($request->application);
            $formable = $application->formable;
        
            // Update main applicant info
            $formable->name = ucfirst($request->name);
            $formable->phone_number = $request->phone_number;
            $formable->emirates_id = $request->emirates_id;
            $formable->information_provided = $request->information_provided;
        
            if ($request->hasFile('attachment')) {
                $formable->attachment = $file_path;
            }
            if ($request->hasFile('residance_permit')) {
                $formable->residance_permit = $residance_permit_file_path;
            }
        
            $formable->save();
        
            // Update passport
            if ($formable->passport) {
                $formable->passport->passport_number = $request->passport_number;
                $formable->passport->passport_center_id = $request->passport_center;
                $formable->passport->issued_on = $request->issued_on;
                $formable->passport->save();
            }
        
            // Track incoming IDs
            $incomingIds = [];
        
            foreach ($request->family_members as $index => $member) {
                $res_permit_path = $request->file("family_members.{$index}.member_residance_permit")?->store("uploads/user_" . auth()->id());
                $birth_cert_path = $request->file("family_members.{$index}.member_birth_certificate")?->store("uploads/user_" . auth()->id());
                $passport_path = $request->file("family_members.{$index}.member_passport_attachment")?->store("uploads/user_" . auth()->id());

                if (!empty($member['id'])) {
                   
                    // Update existing member
                    $existingMember = \App\Models\ApplicationFamilyMemberspassport::find($member['id']);
                    if ($existingMember) {
                        $updateData = [
                            'name' => $member['member_name'],
                            'realtion' => $member['member_relation'],
                        ];
                        if ($res_permit_path) {
                            $updateData['residance_permit'] = $res_permit_path;
                        }
                        if ($birth_cert_path) {
                            $updateData['birth_certificiate'] = $birth_cert_path;
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
        
                    $newMember = \App\Models\ApplicationFamilyMemberspassport::create([
                        'name' => $member['member_name'],
                        'realtion' => $member['member_relation'],
                        'passport_id' => $memberPassport->id,
                        'family_member_id' => $formable->id,
                        'residance_permit' => $res_permit_path,
                        'birth_certificiate' => $birth_cert_path,
                    ]);
        
                    $incomingIds[] = $newMember->id;
                }
            }

             

        
            // $formable->familyMembers()->whereNotIn('id', $incomingIds)->each(function ($member) {
            //     // Delete member first to break the foreign key link
            //     $member->delete();
            
            //     // Now delete passport safely
            //     if ($member->passport) {
            //         $member->passport->delete();
            //     }
            // });

         
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

            $family = ApplicationFamilyMembers::create([
                'name' => ucwords($request->name),
                'phone_number' => $request->phone_number,
                'passport_id' => $passport->id,
                'emirates_id' => $request->emirates_id,
                'information_provided' => $request->information_provided,
                'residance_permit' => $residance_permit_file_path,
            ]);


            foreach ($validated['family_members'] as $index => $member) {
                $res_permit_path = $request->file("family_members.{$index}.member_residance_permit")?->store('uploads/user_' . auth()->id());
                $birth_cert_path = $request->file("family_members.{$index}.member_birth_certificate")?->store('uploads/user_' . auth()->id());
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

                \App\Models\ApplicationFamilyMemberspassport::create([
                    'name' => $member['member_name'],
                    'realtion' => $member['member_relation'],
                    'passport_id' => $memberpassport->id,
                    'family_member_id' => $family->id,
                    'residance_permit' => $res_permit_path,
                    'birth_certificiate' => $birth_cert_path,
                ]);
            }

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $family->id,
                'formable_type' => \App\Models\ApplicationFamilyMembers::class,
                'form_type_id' => '8'
            ]); 
        }
       
        return redirect()->route('family-member.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verifyFamilyMember(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

       // dd($application);
        return view('family-member.verify-family-member', ['application' => $application]);
    }

    public function editFamilyMember(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'family-member']);
        
        return view('family-member.create');
    }
}

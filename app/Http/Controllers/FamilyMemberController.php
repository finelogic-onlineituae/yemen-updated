<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Country;
use App\Models\PassportCenter;
use App\Models\Kinship;
use App\Models\FamilyMember;
use Illuminate\Support\Facades\Storage;

class FamilyMemberController extends Controller
{
    public function createFamilyMember(Request $request)
    {
        session(['category' => '1', 'app' => 'applications/family-member']);
       
        return view('family-member.create', ['countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

    public function storeFamilyMember(Request $request)
    {
        $validated = $request->validate([
            'applicant_name' => 'required|max:250',
            'applicant_passport_number' => 'required|max:250',
            'applicant_passport_center.*' => 'required|exists:passport_centers,id',
            'applicant_issued_on.*' => 'required|date',
            'member_name.*' => 'required|string|max:255',
            'member_passport_number.*' => 'required|string|max:50',
            'member_passport_center.*' => 'required|exists:passport_centers,id',
            'member_issued_on.*' => 'required|date',
            'member_relation.*' => 'required',
            'member_passport_attachment.*' =>  $request->has('application') ? 'nullable' : 'file|mimes:pdf,jpg,png,jpeg|max:2048',
            'applicant_passport_attachment.*' => $request->has('application') ? 'nullable' : 'file|mimes:pdf,jpg,png,jpeg|max:2048',
            'applicant_emirate_id_attachment' => $request->has('application') ? 'nullable' : 'file|mimes:pdf,jpg,png,jpeg|max:2048',
            'applicant_passport_attachment' => $request->has('application') ? 'nullable' : 'file|mimes:pdf,jpg,png,jpeg|max:2048',
        ]);

       // dd($validated);
        // if($request->hasFile('passport_attachment')) {
        //     $file_path = $request->file('passport_attachment')->store('uploads/user_' . auth()->id());
        // }
        $passport_file_paths = [];
        $emirate_id_file_paths = [];

        if($request->file('member_passport_attachment') != null)
        {
            foreach($request->file('member_passport_attachment') as $passport)
            {
                $file_path = $passport->store('uploads/user_' . auth()->id());
                array_push($passport_file_paths, $file_path);
            }
        }
        
      /*  if($request->file('member_emirate_id_attachment') != null)
        {
            foreach($request->file('member_emirate_id_attachment') as $emirate_id)
            {
                $file_path = $emirate_id->store('uploads/user_' . auth()->id());
                array_push($emirate_id_file_paths, $file_path);
            }
        }*/

       
        if($request->has('application')) {
            dd('work under progress');
            $i = 0;
            $application = Form::where('id', $request->application)->first();
            //$application->formable
            $i = 0;
            foreach($request->member_id as $member_id){
                $member = FamilyMember::where('id', decrypt($request->member_id))->first();
                if($member->kinship_id != $application->formable->id){
                    abort(403);
                }
                $passport = Passport::where('id', $member->passport_id)->first();
                $attach = 'member_passport_attachment'.
                $passport_attachment = null;
                if($request->file('member_passport_attachment')[$i]){
                    $passport_attachment_path = $request->file('member_passport_attachment')[$i]->store('uploads/user_' . auth()->id());
                }
                
                $passport->passport_number = $request->member_passport_number[$i];
                $passport->issued_by = $request->member_passport_number[$i];
                $passport->passport_center_id = $request->member_passport_number[$i];
                $passport->issued_on = $request->member_passport_number[$i];
                $passport->attachment = $request->passport_attachment_path;
                   
            
                $member->member_name = $request->member_name[$i];
                $member->member_passport = $request->member_name[$i];
                $member->member_name = $request->member_name[$i];
                $member->member_name = $request->member_name[$i];
            }
        }
        
        else{
           

            $applicant_passport_file = $request->file('applicant_passport_attachment')->store('uploads/user_' . auth()->id());
            $applicant_emirates_id_file = $request->file('applicant_emirate_id_attachment')->store('uploads/user_' . auth()->id());
            $user = auth()->user();
            $applicant_passport = $user->passports()->create([
                    'passport_number' => $request->applicant_passport_number,
                    'issued_by' => 'YE',
                    'passport_center_id' => $request->applicant_passport_center,
                    'issued_on' => $request->applicant_issued_on,
                    'attachment' => $applicant_passport_file
                ]);
            
            $kinship = Kinship::create([
                'applicant_name' => $request->applicant_name,
                'passport_id' => $applicant_passport->id,
                'emirates_id_attachment' => $applicant_emirates_id_file
            ]);

            $i=0;
            foreach($passport_file_paths as $file_path){
                $passport = $user->passports()->create([
                    'passport_number' => $request->member_passport_number[$i],
                    'issued_by' => 'YE',
                    'passport_center_id' => $request->member_passport_center[$i],
                    'issued_on' => $request->member_issued_on[$i],
                    'attachment' => $file_path
                ]);
                $member = FamilyMember::create([
                        'name' => $request->member_name[$i],
                        'relationship' => $request->member_relation[$i],
                        //'emirates_id_attachment' => $emirate_id_file_paths[$i],
                        'kinship_id' => $kinship->id,
                        'passport_id' => $passport->id
                ]);
                
                $i++;
            }

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $kinship->id,
                'formable_type' => \App\Models\Kinship::class,
                'form_type_id' => '8'
            ]); 
        }
       
        return redirect()->route('family-member.verify', ['application_id' => $application->id]);
    }
    public function verifyFamilyMember(Request $request)
    {
        $application_id = $request->application_id;
        $application = Form::findOrFail($application_id);

       // dd($application);
        return view('family-member.verify-family-member', ['application' => $application,'countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

    public function editFamilyMember(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'family-member']);
        
        return view('family-member.create');
    }

    public function removeFamilyMember(Request $request)
    {
        
        $member = FamilyMember::where('id', $request->member_id)->first();
        $supporter = Kinship::where('id', $member->kinship_id)->first();
        if(auth()->user()->id != $supporter->form->user_id){
            abort(403);
        }   
        Storage::delete([ $member->passport->attachment, $member->emirates_id_attachment]);
        $member->delete();
        return redirect()->route('family-member.verify', ['application_id' => $supporter->form->id]);
    }

    public function addFamilyMember(Request $request)
    {
        $application = Form::where('id', $request->application_id)->first();
        
        if(auth()->user()->id != $application->user_id){
            abort(403);
        }   

        $validated = $request->validate([
            'member_name' => 'required|string|max:255',
            'member_passport_number' => 'required|string|max:50',
            'member_passport_center' => 'required|exists:passport_centers,id',
            'member_issued_on' => 'required|date',
            'member_expire_on' => 'required|date',
            'member_relation' => 'required',
            'member_emirates_id_attachment' => 'file|mimes:pdf|max:2048',
            'member_passport_attachment' => 'file|mimes:pdf|max:2048',
        ]);

        $passport_path = $request->file('member_passport_attachment')->store('uploads/user_' . auth()->id());
        $emirate_id_path = $request->file('member_emirates_id_attachment')->store('uploads/user_' . auth()->id());

        $passport = auth()->user()->passports()->create([
                    'passport_number' => $request->member_passport_number,
                    'issued_by' => 'YE',
                    'passport_center_id' => $request->member_passport_center,
                    'issued_on' => $request->member_issued_on,
                    'expires_on' => $request->member_expire_on,
                    'attachment' => $passport_path
        ]);

        $member = FamilyMember::create([
                        'name' => $request->member_name,
                        'relationship' => $request->member_relation,
                        'emirates_id_attachment' => $emirate_id_path,
                        'kinship_id' => $application->formable->id,
                        'passport_id' => $passport->id
                ]);
        
        return redirect()->route('family-member.verify', ['application_id' => $application->id]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Country;
use App\Models\PassportCenter;
use App\Models\Kinship;
use App\Models\FamilyMember;

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
            'supporter_name' => 'required|max:250',
            'dependancy_relationship' => 'required|max:250',
            'member_name.*' => 'required|string|max:255',
            'member_passport_number.*' => 'required|string|max:50',
            'member_passport_center.*' => 'required|exists:passport_centers,id',
            'member_issued_on.*' => 'required|date',
            'member_expire_on.*' => 'required|date',
            'member_relation.*' => 'required',
            'member_emirates_id_attachment.*' => 'file|mimes:pdf|max:2048',
            'member_passport_attachment.*' => 'file|mimes:pdf|max:2048',
        ]);

       // dd($validated);
        // if($request->hasFile('passport_attachment')) {
        //     $file_path = $request->file('passport_attachment')->store('uploads/user_' . auth()->id());
        // }
        $passport_file_paths = [];
        $emirate_id_file_paths = [];
        
        foreach($request->file('member_passport_attachment') as $passport)
        {
            $file_path = $passport->store('uploads/user_' . auth()->id());
            array_push($passport_file_paths, $file_path);
        }
        
        foreach($request->file('member_emirate_id_attachment') as $emirate_id)
        {
            $file_path = $emirate_id->store('uploads/user_' . auth()->id());
            array_push($emirate_id_file_paths, $file_path);
        }

       
        if($request->has('application')) {

        }
        
        else{
            $kinship = Kinship::create([
                'supporter_name' => $request->supporter_name,
                'dependancy_relationship' => $request->dependancy_relationship,
            ]);

            $user = auth()->user();
            $i=0;
            foreach($passport_file_paths as $file_path){
                $passport = $user->passports()->create([
                    'passport_number' => $request->member_passport_number[$i],
                    'issued_by' => 'YE',
                    'passport_center_id' => $request->member_passport_center[$i],
                    'issued_on' => $request->member_issued_on[$i],
                    'expires_on' => $request->member_expire_on[$i],
                    'attachment' => $file_path
                ]);
                $member = FamilyMember::create([
                        'name' => $request->member_name[$i],
                        'relationship' => $request->member_relation[$i],
                        'emirates_id_attachment' => $emirate_id_file_paths[$i],
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
}

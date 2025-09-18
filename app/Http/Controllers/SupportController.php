<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Support;
use App\Models\Passport;
use App\Models\SupportMember;
use App\Models\PassportCenter;
use App\Models\Form;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller
{
    public function create(Request $request)
    {
        session(['category' => '1', 'app' => 'applications/support']);
       
        return view('support.create', ['countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

    public function store(Request $request)
    {
          // dd($request->all());
        $validated = $request->validate([
            'applicant_name' => 'required|max:250',
            'nationality' => 'required|exists:countries,id',
            'applicant_passport_number' => 'required|max:250',
            'applicant_passport_center.*' => 'required|exists:passport_centers,id',
            'applicant_issued_on.*' => 'required|date',
            'member_name.*' => 'required|string|max:255',
            'member_passport_number.*' => 'required|string|max:50',
            'member_passport_center.*' => 'required|exists:passport_centers,id',
            'member_issued_on.*' => 'required|date',
            'member_relation.*' => 'required',
            'member_nationality.*' => 'required|exists:countries,id',
            'member_passport_attachment.*' =>  $request->has('application') ? 'nullable' : 'file|mimes:pdf,jpg,png,jpeg|max:2048',
            'member_passport_attachment.*' => $request->has('application') ? 'nullable' : 'file|mimes:pdf,jpg,png,jpeg|max:2048',
            'applicant_emirate_id_attachment' => $request->has('application') ? 'nullable' : 'file|mimes:pdf,jpg,png,jpeg|max:2048',
            'applicant_passport_attachment' => $request->has('application') ? 'nullable' : 'file|mimes:pdf,jpg,png,jpeg|max:2048',
        ]);

       
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
        if($request->file('member_emirate_id_attachment') != null)
        {
            foreach($request->file('member_emirate_id_attachment') as $emirate_id)
            {
                $file_path = $emirate_id->store('uploads/user_' . auth()->id());
                array_push($emirate_id_file_paths, $file_path);
            }
        }
        

        if($request->has('application')) {
           // dd('work under progress');
            $i = 0;
            $application = Form::where('id', $request->application)->first();
            //$application->formable
            $i = 0;
            foreach($request->member_id as $member_id){
                $member = SupportMember::where('id', decrypt($member_id))->first();
                if($member->support_id != $application->formable->id){
                    abort(403);
                }
                $passport = Passport::where('id', $member->passport_id)->first();
                $passport_attachment = null;
                if($request->hasFile("member_passport_attachment.$i")){
                    $passport_attachment_path = $request->file('member_passport_attachment')[$i]->store('uploads/user_' . auth()->id());
                }
                if($request->hasFile("member_emirate_id_attachment.$i")){
                    $emirate_id_attachment_path = $request->file('member_emirate_id_attachment')[$i]->store('uploads/user_' . auth()->id());
                }
                $passport->passport_number = $request->member_passport_number[$i];
               // $passport->issued_by = $request->member_passport_number[$i];
                $passport->passport_center_id = $request->member_passport_center[$i];
                $passport->issued_on = $request->member_issued_on[$i];
                if($request->hasFile("member_passport_attachment.$i")){
                    $passport->attachment = $request->passport_attachment_path;
                }
          
                $member->name = $request->member_name[$i];
                $member->relationship = $request->member_relation[$i];
                $member->nationality = $request->member_nationality[$i];
                if($request->hasFile("member_emirate_id_attachment.$i")){
                    $member->emirate_id_attachment = $emirate_id_attachment_path;
                }
                $passport->save();
                $member->save();
                $i++;
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
            
            $support = Support::create([
                'applicant_name' => $request->applicant_name,
                'nationality' => $request->nationality,
                'passport_id' => $applicant_passport->id,
                'emirate_id_attachment' => $applicant_emirates_id_file
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
                $member = SupportMember::create([
                        'name' => $request->member_name[$i],
                        'nationality' => $request->member_nationality[$i],
                        'relationship' => $request->member_relation[$i],
                        'emirate_id_attachment' => $emirate_id_file_paths[$i],
                        'support_id' => $support->id,
                        'passport_id' => $passport->id
                ]);
                
                $i++;
            }

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $support->id,
                'formable_type' => \App\Models\Support::class,
                'form_type_id' => '20'
            ]); 
        }
       
        return redirect()->route('support.verify', ['application_id' => $application->id]);
    }

    public function verifySupport(Request $request)
    {
        $application_id = $request->application_id;
        $application = Form::findOrFail($application_id);

       // dd($application);
        return view('support.verify-support', ['application' => $application,'countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

     public function removeSupportMember(Request $request)
    {
        
        $member = SupportMember::where('id', $request->member_id)->first();
        $supporter = Support::where('id', $member->support_id)->first();
        if(auth()->user()->id != $supporter->form->user_id){
            abort(403);
        }   
        Storage::delete([ $member->passport->attachment, $member->emirate_id_attachment]);
        $member->delete();
        return redirect()->route('support.verify', ['application_id' => $supporter->form->id]);
    }

    public function addSupportMember(Request $request)
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
            'member_relation' => 'required',
            'member_emirate_id_attachment' => 'required|file|mimes:pdf|max:2048',
            'member_passport_attachment' => 'required|file|mimes:pdf|max:2048',
        ]);

        $passport_path = $request->file('member_passport_attachment')->store('uploads/user_' . auth()->id());
        $emirate_id_path = $request->file('member_emirate_id_attachment')->store('uploads/user_' . auth()->id());

        $passport = auth()->user()->passports()->create([
                    'passport_number' => $request->member_passport_number,
                    'issued_by' => 'YE',
                    'passport_center_id' => $request->member_passport_center,
                    'issued_on' => $request->member_issued_on,
                    'expires_on' => $request->member_expire_on,
                    'attachment' => $passport_path
        ]);

        $member = SupportMember::create([
                        'name' => $request->member_name,
                        'nationality' => $request->member_nationality,
                        'relationship' => $request->member_relation,
                        'emirate_id_attachment' => $emirate_id_path,
                        'support_id' => $application->formable->id,
                        'passport_id' => $passport->id
                ]);
        
        return redirect()->route('support.verify', ['application_id' => $application->id]);
    }
}

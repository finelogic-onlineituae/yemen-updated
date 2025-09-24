<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Visa;
use App\Models\Country;
use App\Models\PassportCenter;
use Illuminate\Support\Facades\Storage;

class VisaApplicationController extends Controller
{
     public function createVisaApplication(Request $request)
    {
        session(['category' => '4', 'app' => 'applications/visa-application']);
       
        return view('visa-application.create', ['countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
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
        //dd($request->issued_by);
        $request->validate([
                'name_arabic' => 'required|max:255',
                'name_english' => 'required|max:255',
                'nationality' => 'required|max:255',
                
                'address' => 'required|max:255',
                'address_uae' => 'required|max:500',
                'place_of_birth' => 'required|max:255',
                'date_of_birth' => 'required|date|before:tomorrow',
                'proffession' => 'required|max:255',
                'place_of_work' => 'required|max:255',
                'purpose_of_travel' => 'required|max:255',
                'period_required' => '1 month',
                'address_in_roy' => 'required|max:500',
                'sponsor_name' => 'required|max:255',
                
                'passport_number' => 'required',
                'issued_by' => 'required|exists:countries,id',
                'issued_on' => 'required',
                'expire_on' => 'required',

                'sponsor_address' => 'required|max:500',
                'accompany_name' => $request->has('accompany') ? 'required|max:255' : 'nullable',
                'previous_visit_1' => 'required|date|before:today',
                'previous_visit_2' => 'required|date|before:today',
                'id_card' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'passport_attachment' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'sponsor_pass' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'sponsor_passport' => $request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
                'accompany_passport' => !$request->has('has_accompany') ? 'nullable' : ($request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048'),
                'accompany_id_card' => !$request->has('has_accompany') ? 'nullable' : ($request->has('application') ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048'),
        ]);
      
        $file_path = null;
        $id_card_file_path = null;
        $sponsor_noc_file_path = null;
        $sponsor_pass_file_path = null;
        $accompany_id_card_file_path = null;
        $accompany_passport_file_path = null;
        $photo_file_path = null;

        if ($request->cropped_image) {
                $base64Image = $request->input('cropped_image');

                if (!$base64Image) {
                    return back()->with('error', 'No image provided.');
                }

                // Strip base64 header if present
                $base64Image = preg_replace('#^data:image/\w+;base64,#i', '', $base64Image);

                // Decode the image
                $imageData = base64_decode($base64Image);

                // Generate filename and path
                $filename = 'crop_' . time() . '.jpg';
                $photo_file_path = '/uploads/user_' . auth()->id() .'/'. $filename;

                // Store in /storage/app/public/images
                Storage::disk('public')->put($photo_file_path, $imageData);

                // (Optional) Get full URL to return or save in DB
                 //$photo_file_path = $path; // e.g., /storage/images/crop_123456.jpg
                        
         }
        if($request->hasFile('passport_attachment')) {
            $file_path = $request->file('passport_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('id_card')) {
            $id_card_file_path = $request->file('id_card')->store('uploads/user_' . auth()->id());
        }

        if($request->hasFile('sponsor_pass')) {
            $sponsor_noc_file_path = $request->file('sponsor_pass')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('sponsor_passport')) {
            $sponsor_passport_file_path = $request->file('sponsor_passport')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('accompany_passport')) {
            $accompany_passport_file_path = $request->file('accompany_passport')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('accompany_id_card')) {
            $accompany_id_card_file_path = $request->file('accompany_id_card')->store('uploads/user_' . auth()->id());
        }
       // dd($sponsor_pass_file_path.$id_card_file_path);
        if($request->same_address){
            $address_same=$request->same_address;
        }else{
            $address_same=$request->address_uae;
        }

        if($request->has('application')){
            $application = Form::findOrFail($request->application);

            $application->formable->name_english = $request->name_english;
            $application->formable->name_arabic = $request->name_arabic;
            $application->formable->nationality = $request->nationality;
            $application->formable->permanent_address = $request->address;
            $application->formable->uae_address = $request->address_uae;
            $application->formable->place_of_birth = $request->place_of_birth;
            $application->formable->date_of_birth = $request->date_of_birth;
            $application->formable->profession = $request->proffession;
            $application->formable->place_of_work = $request->place_of_work;
            $application->formable->travel_purpose = $request->purpose_of_travel;
            $application->formable->roy_address = $request->address_in_roy;
            $application->formable->sponsor_name = $request->sponsor_name;
            
            $application->formable->sponsor_address = $request->sponsor_address;
   
            $application->formable->previous_visit_1 = $request->previous_visit_1;
            $application->formable->previous_visit_2 = $request->previous_visit_1;

            $application->formable->passport->passport_number = $request->passport_number;
            $application->formable->passport->passport_center_id = $request->passport_center;
            $application->formable->passport->issued_on = $request->issued_on;
            $application->formable->passport->expires_on = $request->expire_on;
            $application->formable->passport->issued_by = $request->issued_by;
         
            
            if($request->has('has_accompany')){
                $application->formable->has_accompany = $request->has_accompany ? true : false;
                $application->formable->accompany_name = $request->accompany_name;
            }

            if($request->hasFile('id_card')) {
                $application->formable->id_card = $id_card_file_path;
            } 
               
            if($request->hasFile('passport_attachment')) {
                $application->formable->passport->attachment = $file_path;
            }
            if($request->hasFile('sponsor_pass')) {
                $application->formable->sponsor_noc = $sponsor_noc_file_path;
            } 
            if($request->hasFile('sponsor_passport')) {
                $application->formable->sponsor_passport = $sponsor_passport_file_path;
            }
            if($request->cropped_image) {
                $application->formable->photo = $photo_file_path;
            }
            if($request->hasFile('accompany_passport')) {
                $application->formable->accompany_passport = $accompany_passport_file_path;
            }
            if($request->hasFile('accompany_id_card')) {
                $application->formable->accompany_id_card = $accompany_id_card_file_path;
            }

            $application->formable->passport->save(); 
            $application->formable->save();    

                return redirect()->route('visa-application.verify', ['application_id' => $application->id]);
          
                
    
            //return redirect()->route('visa-application.verify', ['application_id' => encrypt($application->id)]);

        }
        else{
            $user = auth()->user();
            $passport = $user->passports()->create([
                'passport_number' => $request->passport_number,
                'issued_by' => $request->issued_by, 
                'passport_center_id' => $request->passport_center,
                'issued_on' => $request->issued_on,
                'expires_on' => $request->expire_on,
                'attachment' => $file_path
            ]);

    
            $VisaApplication = Visa::create([
                'name_arabic' => $request->name_arabic,
                'name_english' => $request->name_english,
                'nationality' => $request->nationality,
                
                'permanent_address' => $request->address,
                'uae_address' => $address_same,
                'passport_id' => $passport->id,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'profession' => $request->proffession,
                'place_of_work' => $request->place_of_work,
                'travel_purpose' => $request->purpose_of_travel,
                'roy_address' => $request->address_in_roy,
                'sponsor_name' => $request->sponsor_name,
                'sponsor_address' => $request->sponsor_address,
                'previous_visit_1' => $request->previous_visit_1,
                'previous_visit_2' => $request->previous_visit_2,
                'emirate_id_attachment' => $id_card_file_path,
                'sponsor_noc' => $sponsor_noc_file_path,
                'sponsor_passport' => $sponsor_passport_file_path,
                'photo' => $photo_file_path,
                'has_accompany' => $request->has_accompany ? true : false,
                'accompany_name' => $request->accompany_name,
                'accompany_passport' => $accompany_passport_file_path,
                'accompany_id_card' => $accompany_id_card_file_path,
            ]);

            $application = $user->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $VisaApplication->id,
                'formable_type' => \App\Models\Visa::class,
                'form_type_id' => '15'
            ]); 
        }
      
        return redirect()->route('visa-application.verify', ['application_id' => $application->id]);
      
        

    }

    public function verifyVisaApplication(Request $request)
    {
        $application = Form::findOrFail($request->application_id);

        return view('visa-application.verify-visa-application', ['application' => $application, 'countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
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

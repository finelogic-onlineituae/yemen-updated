<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\NoIdCardGroup;
use App\Models\PassportCenter;
use App\Models\NoIdentityCard;
use App\Models\NoIdCardGroupPassport;

class NoIdCardGroupController extends Controller
{
     public function create(Request $request)
    {
        session(['category' => '1', 'app' => 'applications/no-id-card-group']);
       
        return view('no-id-card-group.create',['passport_centers' => PassportCenter::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_arabic' => 'required|max:255',
            'passport_number' => 'required|string|min:8',
            'expire_on' => 'required',
            'passport_center' => 'required|exists:passport_centers,id',
            'issued_on' => 'required|before:tomorrow',
            'passport_attachment' => 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'emirate_id_attachment' => 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            'father_passport' => $request->is_above_18 == 'adult' ? 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048' : 'nullable',
            'mother_passport' => $request->is_above_188 == 'adult' ? 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048' : 'nullable',
            'father_emirate_id' => $request->is_above_188 == 'adult' ? 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048' : 'nullable',
            'mother_emirate_id' => $request->is_above_188 == 'adult' ? 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048' : 'nullable',
            'husband_passport' => $request->emirati_wife ? 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048' : 'nullable',
            'marriage_cocument' => $request->emirati_wife ? 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048' : 'nullable',
        ]);

          $photo_file_path = null;
          $father_passport = null;
          $mother_passport = null;
          $husband_passport = null;
          $father_emirate_id = null;
          $mother_emirate_id = null;
          
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
         if($request->hasFile('passport_attachment')){
            $passport_file_path = $request->file('passport_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('emirate_id_attachment')){
            $emirate_id_file_path = $request->file('emirate_id_attachment')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('father_passport')){
            $father_passport = $request->file('father_passport')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('father_passport')){
            $father_passport = $request->file('father_passport')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('mother_passport')){
            $mother_passport = $request->file('father_passport')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('father_emirate_id')){
            $father_emirate_id = $request->file('father_passport')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('mother_emirate_id')){
            $mother_emirate_id = $request->file('father_passport')->store('uploads/user_' . auth()->id());
        }
        if($request->hasFile('husband_passport')){
            $husband_passport = $request->file('father_passport')->store('uploads/user_' . auth()->id());
        }
        if($request->has('batch')){
            $application_batch = NoIdentityCard::findOrFail(decrypt($request->batch));
        }
        else{
            $application_batch = NoIdentityCard::create();
        }

        $passport = auth()->user()->passports()->create([
            'passport_number' => $request->passport_number,
            'issued_by' => $request->issued_by,
            'passport_center_id' => $request->passport_center,
            'issued_on' => $request->issued_on,
            'expires_on' => $request->expire_on,
            'attachment' => $passport_file_path
        ]);

        $application_batch->groupIdCardMembers()->create([
            'name_arabic' => $request->name_arabic,
            'passport_id' => $passport->id,
            'father_passport' => $father_passport,
            'mother_passport' => $mother_passport,
            'father_emirate_id' => $father_emirate_id,
            'mother_emirate_id' => $mother_emirate_id,
            'husband_passport' => $husband_passport,
            'emirate_id_attachment' => $emirate_id_file_path
        ]);
        $application = auth()->user()->forms()->create([
                'status' => 'Initiated',
                'formable_id' => $application_batch->id,
                'formable_type' => \App\Models\NoIdentityCard::class,
                'form_type_id' => '16'
            ]); 

       
        return redirect()->route('no-id-card-group.create', ['batch' => encrypt($application_batch->id), 'application' => $application_batch]);
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

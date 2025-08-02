<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On; 
use App\Models\Form;
use App\Models\VisaApplicationAccompany;

class ApplicationVisaAccompany extends Component
{

     use WithFileUploads;

    public $member_name;
    public $member_passport_number;
    public $member_issued_by;
    public $member_issued_on;
    public $member_expires_on;
    public $member_emirates_id;
    public $member_passport_center;
    public $member_passport_attachment;
    public $member_passport_attachment_existing;

    public $passport;
    public $allowVerification;
    public $completed;
    public $application;
    public $application_id;
    public $visa_application_id;
    public $passport_centers;

    public $applicationstore;

    public $accompany_members = [];

    public function addFamilyMember()
    {
        $this->accompany_members[] = [
            'member_name' => '',
            'member_emirates_id' => '',
            'member_passport_number' => '',
            'member_passport_center' => '',
            'member_issued_on' => '',
            'member_expires_on' => '',
            'member_passport_attachment' => '',
        ];
    }

    public function removeAccompanyMembers($index)
    {
        $member = $this->accompany_members[$index] ?? null;
    
        if ($member && isset($member['id'])) {
            // Delete the member from the database
            VisaApplicationAccompany::find($member['id'])?->delete();
        }
    
        // Remove from the local array so it disappears from the form
        unset($this->accompany_members[$index]);
    
        // Reindex the array to avoid Livewire reactivity issues
        $this->accompany_members = array_values($this->accompany_members);
    }

    public function updatedFamilyMembers()
    {
        $this->validate($this->rules());
    }

   

    public function rules()
    {

        foreach ($this->accompany_members as $index => $member) {

            $rules["accompany_members.$index.member_name"] = 'required|string|max:255';
            $rules["accompany_members.$index.member_emirates_id"] = 'required|min:17';
            $rules["accompany_members.$index.member_passport_number"] = 'required|string|min:8';
            $rules["accompany_members.$index.member_passport_center"] = 'required|exists:countries,id';
            $rules["accompany_members.$index.member_issued_on"] = 'required|date|before:tomorrow';
            $rules["accompany_members.$index.member_expires_on"] = 'required|date|after:today';
            $rules["accompany_members.$index.member_passport_attachment"] = 
            $member['existing_passport_attachment'] ?? false ? 'nullable' : 'required|file|mimes:pdf|max:2048';

        }

        return $rules;
    }

    protected $validationAttributes = [
  
        // 'name' => 'Name',
        // 'emirates_id' => 'Emirates Number',
        // 'phone_number' => 'Phone Number',
        // 'information_provided' => 'Information Provided',
        // 'residance_permit' => 'Residence Permit',

    ];




    public function mount($applicationId)
    {
        $this->accompany_members = [
            [
                'member_name' => '',
                'member_emirates_id' => '',
                'member_passport_number' => '',
                'member_passport_center' => '',
                'member_issued_on' => '',
                'member_expires_on' => '',
                'member_passport_attachment' => null,

            ]
        ];

        $user = auth()->user();

        $application = Form::findOrFail($applicationId);

        $this->allowVerification = false;
        $this->completed = false;
        $this->passport = null;
        $this->application_id = null;
        $this->application = null;
        $this->applicationstore = $applicationId;
        
        $this->visa_application_id=$application->formable_id;
        
        $this->passport_centers = \App\Models\Country::get();

        if(session()->has('edit_application') && session('edit_application') == 'visa-application-accompany' && session()->has('application_id'))
        {
            //dd('hai');
            $this->application = Form::findOrFail(session('application_id'));
   
            $this->accompany_members = $this->application->formable->AccompanyMembers->map(function ($member) {
               
                return [
                    'id' => $member->id,
                    'member_name' => $member->name,
                    'member_emirates_id' => $member->emirates_id,
                    'member_passport_number' => $member->passport->passport_number,
                    'member_passport_center' => $member->passport->passport_center_id,
                    'member_issued_on' => $member->passport->issued_on,
                    'member_expires_on' => $member->passport->expires_on,
                    'existing_passport_attachment' => $member->passport->attachment,
                ];
            })->toArray();

        }
    }

    // #[On('passport-validated')] 
    // public function registerApplication()
    // {
    //     $this->validate();
    //     $this->dispatch('submitFamilyForm');
    // }

    public function verifyApplication()
    {
        $this->validate();
        $this->dispatch('submitVisaApplicationAccompanyForm');

       // $this->dispatch('validate-passport');

    }


    public function render()
    {
        return view('livewire.application-visa-accompany');
    }
}

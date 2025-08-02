<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On; 
use App\Models\Form;
use App\Models\Country;
use App\Models\NoIdCardGroupPassport;

class NoIdCardGroup extends Component
{

    use WithFileUploads;

    public $member_name;
    public $member_passport_number;
    public $member_phone_number;
    public $member_submitted_to;
    public $member_issued_by;
    public $member_issued_on;
    public $member_emirates_id;
    public $member_passport_center;
    public $member_passport_attachment;
    public $member_passport_attachment_existing;
    public $member_residance_permit;
    public $existing_member_residance_permit;
 
    public $name;
    public $emirates_id;
    public $information_provided;
    public $phone_number;
    public $residance_permit;
    public $existing_residance_permit;

    public $passport;
    public $allowVerification;
    public $completed;
    public $application;
    public $application_id;
    public $passport_centers;
    public $countries;

    public $family_members = [];

    public function addFamilyMember()
    {
        $this->family_members[] = [
            'member_name' => '',
            'member_passport_number' => '',
            'member_submitted_to' => '',
            'member_emirates_id' => '',
            'member_residance_permit' => '',
            'member_passport_number' => '',
            'member_passport_center' => '',
            'member_issued_on' => '',
            'member_passport_attachment' => '',
        ];
    }

    public function removeFamilyMember($index)
    {
        $member = $this->family_members[$index] ?? null;
    
        if ($member && isset($member['id'])) {
            // Delete the member from the database
            NoIdCardGroupPassport::find($member['id'])?->delete();
        }
    
        // Remove from the local array so it disappears from the form
        unset($this->family_members[$index]);
    
        // Reindex the array to avoid Livewire reactivity issues
        $this->family_members = array_values($this->family_members);
    }

    public function updatedFamilyMembers()
    {
        $this->validate($this->rules());
    }

   

    public function rules()
    {
      
 
        foreach ($this->family_members as $index => $member) {

            $rules["family_members.$index.member_name"] = 'required|string|max:255';
            $rules["family_members.$index.member_passport_number"] = 'required|string|min:8';
            $rules["family_members.$index.member_passport_center"] = 'required|exists:passport_centers,id';
            $rules["family_members.$index.member_issued_on"] = 'required|date';
            $rules["family_members.$index.member_phone_number"] = 'required';
            $rules["family_members.$index.member_submitted_to"] = 'required';
            $rules["family_members.$index.member_emirates_id"] = 'required|min:17';
            $rules["family_members.$index.member_residance_permit"] = 
                $member['existing_residance_permit'] ?? false ? 'nullable' : 'required|file|mimes:pdf|max:2048';

            $rules["family_members.$index.member_passport_attachment"] = 
                $member['existing_passport_attachment'] ?? false ? 'nullable' : 'required|file|mimes:pdf|max:2048';

           
        }
  //dd($rules);
        return $rules;
    }

    protected $validationAttributes = [
  
         'name' => 'Name',
        // 'emirates_id' => 'Emirates Number',
        // 'phone_number' => 'Phone Number',
        // 'information_provided' => 'Information Provided',
        // 'residance_permit' => 'Residence Permit',

    ];




    public function mount()
    {
        $this->family_members = [
            [
                'member_name' => '',
                'member_phone_number' => '',
                'member_submitted_to' => '',
                'member_residance_permit' => null,
                'member_passport_number' => '',
                'member_passport_center' => '',
                'member_issued_on' => '',
                'member_passport_attachment' => null,
                'member_emirates_id' => null,

            ]
        ];

        $user = auth()->user();

        $this->allowVerification = false;
        $this->completed = false;
        $this->passport = null;
        $this->application_id = null;
        $this->application = null;

        $this->passport_centers = \App\Models\PassportCenter::all();
        $this->countries = Country::all();

        if(session()->has('edit_application') && session('edit_application') == 'no-id-card-group' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));

            
            $this->family_members = $this->application->formable->familyMembers->map(function ($member) {
               
                return [
                    'id' => $member->id,
                    'member_name' => $member->name,
                    'member_passport_number' => $member->passport->passport_number,
                    'member_passport_center' => $member->passport->passport_center_id,
                    'member_submitted_to' => $member->submitted_to,
                    'member_emirates_id' => $member->emirates_id,
                    'member_phone_number' => $member->phone_number,
                    'member_issued_on' => $member->passport->issued_on,
                    'existing_residance_permit' => $member->residance_permit,
                    'existing_passport_attachment' => $member->passport->attachment,
                ];
            })->toArray();

          
 
        }
    }

   // #[On('passport-validated')] 
    // public function registerApplication()
    // {
    //     $this->validate();
    //     $this->dispatch('submitNoIDCardGroupForm');
    // }

    public function verifyApplication()
    {
        $this->validate();
        $this->dispatch('submitNoIDCardGroupForm');
        //$this->dispatch('validate-passport');

    }

    public function render()
    {
        return view('livewire.no-id-card-group');
    }
}

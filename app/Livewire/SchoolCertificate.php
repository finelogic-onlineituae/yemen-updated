<?php

namespace App\Livewire;


use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Form;
use Livewire\Attributes\On; 

class SchoolCertificate extends Component
{

    use WithFileUploads;

    public $name;
    public $phone_number;
    public $emirates_id;

    public $guardian_passport_number;
    public $guardian_issued_by;
    public $guardian_issued_on;
    public $guardian_expire_on;
    public $guardian_passport_center;
    public $guardian_passport_attachment;
    public $guardian_passport_attachment_existing;

    public $guardian_emirates_id;
    public $guardian_name;
    public $guardian_id_card;
    public $existing_guardian_id_card;
    public $supporting_reason;
    public $supporting_document;
    public $existing_supporting_document;

    public $passport;
    public $allowVerification;
    public $completed;
    public $application;
    public $application_id;
    public $passport_centers;

    protected function rules() 
    {
        return [
            'guardian_passport_number' => 'required|string|min:8',
            'guardian_issued_by' => 'nullable',
            'guardian_passport_center' => 'required|exists:passport_centers,id',
            'guardian_issued_on' => 'required|before:tomorrow',
            'supporting_reason' => 'required',
            'guardian_passport_attachment' => $this->guardian_passport_attachment_existing ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'supporting_document' => $this->existing_supporting_document ? 'nullable' : 'required|file|mimes:pdf|max:2048',

            'guardian_name' => 'required|max:100',
            'name' => 'required|max:100',
            'phone_number' => 'required|string|max:15',
            'guardian_emirates_id' => 'required|min:17',
            'emirates_id' => 'required|min:17',
            'guardian_id_card' => $this->existing_guardian_id_card ? 'nullable' : 'required|file|mimes:pdf|max:2048',
        ];
    }
    protected $validationAttributes = [
        'guardian_passport_number' => 'Guardian Passport Number',
        'guardian_issued_by' => 'Guardian Passport Issued By',
        'guardian_issued_on' => 'Guardian Passport Issued On',
        'guardian_passport_attachment' => 'Guardian Passport Attachment',
        'guardian_passport_attachment' => 'Guardian Passport Attachment',
        'supporting_document' => 'Supporting Document',
        'supporting_reason' => 'Supporting Document Reason',

        'name' => 'Name',
        'guardian_name' => 'Guardian Name',
        'phone_number' => 'Phone Number',
        'guardian_emirates_id' => 'Guardian Emirates ID',
        'emirates_id' => 'Emirates ID',
        'guardian_id_card' => 'Guardian ID Card',

    ];




    public function mount()
    {
        $user = auth()->user();

        $this->allowVerification = false;
        $this->completed = false;
        $this->passport = null;
        $this->application_id = null;
        $this->application = null;
        

        //$this->is_consular = true;
        $this->application = null;
        $this->passport_centers = \App\Models\PassportCenter::all();

        if(session()->has('edit_application') && session('edit_application') == 'school-certificate' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));
            $this->passport = $this->application->formable->passport_id;

            $this->name = $this->application->formable->name;
            $this->guardian_name = $this->application->formable->guardian_name;
            $this->phone_number = $this->application->formable->phone_number;
            $this->guardian_emirates_id = $this->application->formable->guardian_emirates_id;
            $this->emirates_id = $this->application->formable->emirates_id;
            $this->supporting_reason = $this->application->formable->supporting_reason;
            $this->guardian_passport_attachment_existing = $this->application->formable->guardian_passport_attachment;
            $this->existing_supporting_document = $this->application->formable->supporting_document;
            $this->existing_guardian_id_card = $this->application->formable->guardian_id_card;

            $this->guardian_passport_number = $this->application->formable->guardian->passport_number;
            $this->guardian_issued_by = $this->application->formable->guardian->issued_by;
            $this->guardian_issued_on = $this->application->formable->guardian->issued_on;
            $this->guardian_passport_attachment_existing = $this->application->formable->guardian->attachment;
            $this->guardian_passport_center = $this->application->formable->guardian->passport_center_id;

            
        }
    }


    public function verifyApplication()
    {
        $this->validate();
        $this->dispatch('validate-passport');
    }

    #[On('passport-validated')] 
    public function registerApplication()
    {
     
        $this->dispatch('submitSchoolForm');
    }
  

    public function render()
    {
        return view('livewire.school-certificate');
    }
}

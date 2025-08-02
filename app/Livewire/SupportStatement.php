<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Form;
use App\Models\Country;
use Livewire\Attributes\On; 

class SupportStatement extends Component
{

    use WithFileUploads;

    public $name;
    public $emirates_id;
    public $phone_number;
    public $relation_to_beneficiary;
    public $information_provided;
    public $beneficiary_name;
    public $beneficiary_passport_number;
    public $beneficiary_issued_by;
    public $beneficiary_issued_on;
    public $breadwinner_passport;
    public $existing_breadwinner_passport;
    public $beneficiary_passport;
    public $existing_beneficiary_passport;
    public $birth_certificate;
    public $existing_birth_certificate;
    public $registration_summary;
    public $existing_registration_summary;


    public $passport;
    public $allowVerification;
    public $completed;
    public $application;
    public $application_id;
    public $passport_centers;
    public $countries;

    protected function rules() 
    {
        return [
            'name' => 'required',
            'phone_number' => 'required|string|max:15',
            'emirates_id' => 'required|min:17',
            'relation_to_beneficiary' => 'required',
            'information_provided' => 'required',
            'beneficiary_name' => 'required',
            'beneficiary_passport_number' => 'required|min:8',
            'beneficiary_issued_on' =>'required|before:tomorrow',
            'beneficiary_issued_by' => 'required',
            'beneficiary_passport' => $this->existing_beneficiary_passport ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            //'breadwinner_passport' => $this->existing_breadwinner_passport ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'birth_certificate' =>$this->existing_birth_certificate ? 'nullable' :'required|file|mimes:pdf|max:2048',
            'registration_summary' =>$this->existing_registration_summary ? 'nullable' :'required|file|mimes:pdf|max:2048',
        ];
    }
    protected $validationAttributes = [
        'name' => 'Name',
        'phone_number' => 'Mobile Number',
        'emirates_id' => 'Emirates ID',
        'relation_to_beneficiary' => 'Relationship to the beneficiary',
        'information_provided' => 'Party to whom the information will be provided',
        'beneficiary_name' => 'Beneficiary  Name',
        'beneficiary_passport_number' => 'Beneficiary Passport Number',
        'beneficiary_issued_on' => 'Release date',
        'beneficiary_issued_by' => 'Issuing authority',
        'beneficiary_passport' => 'beneficiary passport',
       // 'breadwinner_passport' => 'breadwinners passport',
        'birth_certificate' => 'Birth certificate',
        'registration_summary' => 'Registration Summary',
    ];

    
    public function mount()
    {
        $user = auth()->user();

        $this->allowVerification = false;
        $this->completed = false;
        $this->passport = null;
        $this->application_id = null;
        $this->application = null;
        $this->countries = Country::all();
        $this->passport_centers = \App\Models\PassportCenter::all();

        if(session()->has('edit_application') && session('edit_application') == 'support-statement' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));
            $this->name = $this->application->formable->name;
            $this->phone_number = $this->application->formable->phone_number;
            $this->passport = $this->application->formable->passport_id;
            $this->emirates_id = $this->application->formable->emirates_id;
            $this->relation_to_beneficiary = $this->application->formable->relation_to_beneficiary;
            $this->information_provided = $this->application->formable->information_provided;
            $this->beneficiary_name = $this->application->formable->beneficiary_name;
            $this->beneficiary_passport_number = $this->application->formable->beneficiary_passport_number;
            $this->beneficiary_issued_on = $this->application->formable->beneficiary_issued_on;
            $this->beneficiary_issued_by = $this->application->formable->PassportCenterName->id;;
            $this->existing_beneficiary_passport = $this->application->formable->beneficiary_passport;
           // $this->existing_breadwinner_passport = $this->application->formable->breadwinner_passport;
            $this->existing_birth_certificate = $this->application->formable->birth_certificate;
            $this->existing_registration_summary = $this->application->formable->registration_summary;

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
        $this->dispatch('submitSupportForm');
    }
 
    public function render()
    {
        return view('livewire.support-statement');
    }
}

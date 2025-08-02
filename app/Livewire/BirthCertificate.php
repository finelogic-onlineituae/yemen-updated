<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\BirthCertificate as BirthCertificateModel;
use App\Models\Form;
use App\Models\Country;
use App\Models\Passport;
use App\Models\PassportCenter;
use Livewire\Attributes\On; 

class BirthCertificate extends Component
{
    use WithFileUploads;

    public $name;
    public $phone_number;
    public $emirates_id;
    public $place_of_birth;
    public $date_of_birth;
    public $marital_status;
    public $fathers_name;
    public $fathers_issued_on;
    public $fathers_passport_number;
    public $fathers_nationality;
    public $mothers_name;
    public $mothers_issued_on;
    public $mothers_passport_number;
    public $mothers_nationality;
    public $residance_permit;
    public $existing_residance_permit;
    public $beneficiary_passport;
    public $fathers_passport;
    public $existing_fathers_passport;
    public $mothers_passport;
    public $existing_mothers_passport;
    public $countries;

    public $passport;
    public $allowVerification;
    public $completed;
    public $application;
    public $application_id;

    public $passport_centers;
    
    protected $listeners = ['useExistingPassport' => 'updatePassportUsage'];
    
    protected function rules() 
    {
        return [
            'name' => 'required',
            'phone_number' => 'required|string|max:15',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'marital_status' => 'required',
            'fathers_name' => 'required',
            'fathers_issued_on' =>'required|before:tomorrow',
            'fathers_passport_number' => 'required|min:8',
            'fathers_nationality' => 'required|exists:countries,id',
            'mothers_name' => 'required',
            'mothers_issued_on' =>'required|before:tomorrow',
            'mothers_passport_number' =>'required|min:8',
            'mothers_nationality' =>'required|exists:countries,id',
            'emirates_id' => 'required|min:17',
            'residance_permit' => $this->existing_residance_permit ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'fathers_passport' =>$this->existing_fathers_passport ? 'nullable' :'required|file|mimes:pdf|max:2048',
            'mothers_passport' =>$this->existing_mothers_passport ? 'nullable' :'required|file|mimes:pdf|max:2048',
        ];
    }
    protected $validationAttributes = [
        'name' => 'Name',
        'phone_number' => 'Mobile Number',
        'emirates_id' => 'Emirates ID',
        'place_of_birth' => 'Place Of Birth',
        'date_of_birth' => 'Date of Birth',
        'marital_status' => 'Marital status',
        'fathers_name' => 'Fathers name',
        'fathers_issued_on' => 'Fathers Issued On',
        'fathers_passport_number' => 'Fathers Passport Number',
        'fathers_nationality' => 'Fathers Nationality',
        'mothers_name' => 'Mothers Name',
        'mothers_issued_on' => 'Mothers Issued On',
        'mothers_passport_number' => 'Mothers Passport Number',
        'mothers_nationality' => 'Mothers Nationality',
        'residance_permit' => 'Residence Permit',
        'fathers_passport' => 'Fathers Passport',
        'mothers_passport' => 'Mothers Passport',

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
        $this->passport_centers = PassportCenter::all();

        if(session()->has('edit_application') && session('edit_application') == 'birth-certificate' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));
            $this->name = $this->application->formable->name;
            $this->phone_number = $this->application->formable->phone_number;
            $this->place_of_birth = $this->application->formable->place_of_birth;
            $this->date_of_birth = $this->application->formable->date_of_birth;
            $this->marital_status = $this->application->formable->marital_status;
            $this->fathers_name = $this->application->formable->fathers_name;
            $this->fathers_issued_on = $this->application->formable->fathers_issued_on;
            $this->fathers_passport_number = $this->application->formable->fathers_passport_number;
            $this->fathers_nationality = $this->application->formable->fathers_nationality;
            $this->mothers_name = $this->application->formable->mothers_name;
            $this->mothers_issued_on = $this->application->formable->mothers_issued_on;
            $this->mothers_passport_number = $this->application->formable->mothers_passport_number;
            $this->mothers_nationality = $this->application->formable->mothers_nationality;
            $this->passport = $this->application->formable->passport_id;
            $this->emirates_id = $this->application->formable->emirates_id;
            $this->existing_residance_permit = $this->application->formable->residance_permit;
            $this->existing_fathers_passport = $this->application->formable->fathers_passport;
            $this->existing_mothers_passport = $this->application->formable->mothers_passport;

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
        $this->dispatch('submitBirthForm');
    }
  
    public function render()
    {
        return view('livewire.birth-certificate');
    }
}

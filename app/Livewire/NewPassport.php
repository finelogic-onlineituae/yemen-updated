<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Form;
use App\Models\Country;
use Livewire\Attributes\On; 

class NewPassport extends Component
{
    use WithFileUploads;
  
    public $name;
    public $phone_number;
    public $birth_certificate;
    public $existing_birth_certificate;
    public $father_passport;
    public $existing_father_passport;
    public $father_id_card;
    public $existing_father_id_card;
    public $mother_passport;
    public $existing_mother_passport;
    public $mother_id_card;
    public $existing_mother_id_card;
    public $marriage_certificate_parents;
    public $existing_marriage_certificate_parents;
    public $photo;
    public $existing_photo;

    public $passport;
    public $allowVerification;
    public $completed;
    public $application;
    public $application_id;
    public $croppedPhoto; // base64 image

    public $countries;

    protected function rules() 
    {
        return [
            'name' => 'required',
            'phone_number' => 'required|string|max:15',
            'birth_certificate' => $this->existing_birth_certificate ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'father_passport' => $this->existing_father_passport ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'father_id_card' => $this->existing_father_id_card ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'mother_passport' => $this->existing_mother_passport ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'mother_id_card' => $this->existing_mother_id_card ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'marriage_certificate_parents' => $this->existing_marriage_certificate_parents ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'croppedPhoto' =>$this->existing_photo ? 'nullable' : 'required',

           // 'photo' =>$this->existing_photo ? 'nullable' : 'required|file|mimes:jpg,png,jpeg|max:2048|dimensions:width=200,height=200',
        ];
    }
    protected $validationAttributes = [
        'name' => 'Name',
        'phone_number' => 'Mobile Number',
        'birth_certificate' => 'Birth Certificate',
        'father_passport' => 'Father Passport',
        'father_id_card' => 'Father ID card',
        'mother_passport' => 'mother Passport',
        'mother_id_card' => 'Mother ID card',
        'marriage_certificate_parents' => 'marriage certificate of parents ',
        'photo' => 'Photo',
    ];

    
    public function mount()
    {
        $user = auth()->user();

        $this->allowVerification = false;
        $this->completed = false;
        $this->passport = null;
        $this->application_id = null;
        $this->application = null;
        $this->photo = null;

        $this->countries = Country::all();
        
        if(session()->has('edit_application') && session('edit_application') == 'new-passport' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));
            $this->name = $this->application->formable->name;
            $this->phone_number = $this->application->formable->phone_number;
            $this->existing_birth_certificate = $this->application->formable->birth_certificate;
            $this->existing_father_passport = $this->application->formable->father_passport;
            $this->existing_father_id_card = $this->application->formable->father_id_card;
            $this->existing_mother_passport = $this->application->formable->mother_passport;
            $this->existing_mother_id_card = $this->application->formable->mother_id_card;
            $this->existing_marriage_certificate_parents = $this->application->formable->marriage_certificate_parents;
            $this->existing_photo = $this->application->formable->photo;
        }
    }

    public function verifyApplication()
    {
        $this->validate();
        //$this->dispatch('validate-passport');
        $this->registerApplication();
    }

//#[On('passport-validated')] 
    public function registerApplication()
    {
       
        $this->dispatch('submitNewPassportForm');
    }

    public function render()
    {
        return view('livewire.new-passport');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Form;
use Livewire\Attributes\On; 

class PassportNameChange extends Component
{

    use WithFileUploads;
  
    public $emirates_id;
    public $phone_number;
    public $name;
    public $old_name;
    public $present_passholder;
    public $left_thumb;
    public $existing_left_thumb;
    public $supporting_document;
    public $existing_supporting_document;
    public $photo;
    public $existing_photo;

    public $passport;
    public $allowVerification;
    public $completed;
    public $application;
    public $application_id;


    protected function rules() 
    {
        return [
            'phone_number' => 'required|string|max:15',
            'emirates_id' => 'required|min:17',
            'name' => 'required',
            'old_name' => 'required',
            'present_passholder' => 'required',
            'left_thumb' => $this->existing_left_thumb ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'supporting_document' => $this->existing_supporting_document ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'photo' =>$this->existing_photo ? 'nullable' : 'required|file|mimes:jpg,png,jpeg|max:2048|dimensions:width=200,height=200',
        ];
    }
    protected $validationAttributes = [
        'phone_number' => 'Mobile Number',
        'emirates_id' => 'Emirates ID',
        'name' => 'Name',
        'old_name' => 'Old Name',
        'present_passholder' => 'Present Parent Passholder ',
        'left_thumb' => 'left thumb finger',
        'supporting_document' => 'Supporting Document',
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

        if(session()->has('edit_application') && session('edit_application') == 'passport-name-change' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));
            $this->phone_number = $this->application->formable->phone_number;
            $this->name = $this->application->formable->name;
            $this->old_name = $this->application->formable->old_name;
            $this->present_passholder = $this->application->formable->present_passholder;
            $this->passport = $this->application->formable->passport_id;
            $this->emirates_id = $this->application->formable->emirates_id;
            $this->existing_left_thumb = $this->application->formable->left_thumb;
            //$this->existing_emirates_id_copy = $this->application->formable->emirates_id_copy;
            $this->existing_supporting_document = $this->application->formable->supporting_document;
            //$this->existing_police_reporting_letter = $this->application->formable->police_reporting_letter;
            $this->existing_photo = $this->application->formable->photo;
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
        $this->dispatch('submitPassportNameChangeForm');
    }

    public function render()
    {
        return view('livewire.passport-name-change');
    }
}

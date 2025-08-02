<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Form;
use Livewire\Attributes\On; 
use App\Models\Country;

class OtherCertificate extends Component
{
    
     use WithFileUploads;

    public $name;
    public $phone_number;
    public $emirates_id;
    public $id_card;
    public $existing_id_card;

    public $supporting_reason;
    public $supporting_document;
    public $existing_supporting_document;
    public $countrys;

    public $passport;
    public $allowVerification;
    public $completed;
    public $application;
    public $application_id;


    
    protected function rules() 
    {
        return [
            'name' => 'required',
            'phone_number' => 'required|string|max:15',
            'emirates_id' => 'required|min:17',
            'supporting_reason' => 'required',
            'id_card' => $this->existing_id_card ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'supporting_document' => $this->existing_supporting_document ? 'nullable' : 'required|file|mimes:pdf|max:2048',

        ];
    }
    protected $validationAttributes = [
        'name' => 'Name',
        'phone_number' => 'Mobile Number',
        'emirates_id' => 'Emirates ID',
        'id_card' => 'ID Card',
        'supporting_document' => 'Supporting Document',
        'supporting_reason' => 'Supporting Document Reason',
    ];

    
    public function mount()
    {
        $user = auth()->user();

        
        $this->allowVerification = false;
        $this->completed = false;
        $this->passport = null;
        $this->application_id = null;
        $this->application = null;
        
        $this->countrys = Country::all();

        if(session()->has('edit_application') && session('edit_application') == 'other-certificate' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));
            $this->name = $this->application->formable->name;
            $this->phone_number = $this->application->formable->phone_number;
            $this->passport = $this->application->formable->passport_id;
            $this->emirates_id = $this->application->formable->emirates_id;
            $this->existing_id_card = $this->application->formable->id_card;
            $this->supporting_reason = $this->application->formable->supporting_reason;
            $this->existing_supporting_document = $this->application->formable->supporting_document;
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
       
        $this->dispatch('submitotherForm');
    }

    public function render()
    {
        return view('livewire.other-certificate');
    }
}

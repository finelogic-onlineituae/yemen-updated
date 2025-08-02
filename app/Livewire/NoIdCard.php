<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On; 
use App\Models\Form;

class NoIdCard extends Component
{

    use WithFileUploads;

    public $name;
    public $phone_number;
    public $emirates_id;
    public $application;
    public $residance_permit;
    public $existing_residance_permit;
    public $submitted_to;
    public $passport;

    
    
    protected function rules() 
    {
        return [
            'name' => 'required|max:100',
            'phone_number' => 'required|string|max:15',
            'emirates_id' => 'required|min:17',
            'residance_permit' => $this->existing_residance_permit ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'submitted_to' => 'required|max:100'
        ];
    }
    protected $validationAttributes = [
        'name' => 'Name',
        'phone_number' => 'Mobile Number',
        'emirates_id' => 'Emirates ID',
        'residance_permit' => 'Residance Permit'
    ];

    public function mount()
    {

        if(session()->has('edit_application') && session('edit_application') == 'no-id-card' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));
            $this->name = $this->application->formable->name;
            $this->phone_number = $this->application->formable->phone_number;
            $this->passport = $this->application->formable->passport_id;
            $this->submitted_to = $this->application->formable->submitted_to;
            $this->emirates_id = $this->application->formable->emirates_id;
            $this->existing_licence = $this->application->formable->licence_attachment;
            $this->existing_residance_permit = $this->application->formable->residance_permit;
        }
    }
    public function updatedResidancePermit()
    {
        // Trigger validation only after the file is fully uploaded
        $this->validateOnly('residance_permit');
    }

    public function verifyApplication()
    {
        $this->validate();
        $this->dispatch('validate-passport');
    }

    #[On('passport-validated')] 
    public function registerApplication()
    {
        $this->dispatch('submit-no-id-card-Form');
    }
    public function render()
    {
        return view('livewire.no-id-card');
    }
}

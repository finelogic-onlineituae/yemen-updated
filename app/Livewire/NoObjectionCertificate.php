<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Form;
use FontLib\Table\Type\name;
use Livewire\Attributes\On; 
use Illuminate\Support\Str;

class NoObjectionCertificate extends Component
{

    use WithFileUploads;

    public $name;
    public $emirates_id;
    public $phone_number;
    public $birth_certifcate_no;
    public $birth_certifcate_issuing_authority;
    public $amendment_or_correction;
    public $existing_amendment_or_correction;
    public $modified_name;
    public $modified_issued_by;
    public $modified_issued_on;
    public $birth_certifcate;
    public $existing_birth_certifcate;
    public $residance_permit;
    public $existing_residance_permit;

    public $passport;
    public $allowVerification;
    public $completed;
    public $application;
    public $application_id;

    protected function rules(){
        return[
            'name'=> 'required',
            'emirates_id'=> 'required|min:17',
            'phone_number' => 'required|string|max:15',
            'birth_certifcate_no'=> 'required',
            'birth_certifcate_issuing_authority'=> 'required',
            'amendment_or_correction'=> $this->existing_amendment_or_correction ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'modified_name'=> 'required',
            'modified_issued_by'=> 'required',
            'modified_issued_on'=> 'required|before:tomorrow',
            'birth_certifcate'=> $this->existing_birth_certifcate ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'residance_permit'=> $this->existing_residance_permit ? 'nullable' : 'required|file|mimes:pdf|max:2048',
        ];
    }

    protected $validationAttributes = [
        'name' => 'Name',
        'phone_number' => 'Mobile Number',
        'birth_certifcate_no' => 'Birth certificate registration number',
        'emirates_id' => 'Emirates ID',
        'birth_certifcate_issuing_authority' => 'Birth certificate issuing authority',
        'amendment_or_correction' => 'Amendment/correction',
        'modified_name' => 'Name after modification',
        'modified_issued_by' => 'Issued By',
        'modified_issued_on' => 'Issued On',
        'birth_certifcate' => 'Birth Certificate',
        'residance_permit' => 'Residence Permit',
    ];

    public function mount()
    {
        $user = auth()->user();

        $this->birth_certifcate = null;
        $this->allowVerification = false;
        $this->completed = false;
        $this->passport = null;
        $this->application_id = null;
        $this->application = null;
        

        if(session()->has('edit_application') && session('edit_application') == 'no-objection-certificate' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));
            $this->name = $this->application->formable->name;
            $this->emirates_id = $this->application->formable->emirates_id;
            $this->phone_number = $this->application->formable->phone_number;
            $this->birth_certifcate_no = $this->application->formable->birth_certifcate_no;
            $this->birth_certifcate_issuing_authority = $this->application->formable->birth_certifcate_issuing_authority;
            $this->existing_amendment_or_correction = $this->application->formable->amendment_or_correction;
            $this->modified_name = $this->application->formable->modified_name;
            $this->modified_issued_by = $this->application->formable->modified_issued_by;
            $this->passport = $this->application->formable->passport_id;
            $this->modified_issued_on = $this->application->formable->modified_issued_on;
            $this->existing_birth_certifcate = $this->application->formable->birth_certifcate;
            $this->existing_residance_permit = $this->application->formable->residance_permit;
           
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
        $this->dispatch('submitNOCForm');
    }

    public function render()
    {
        return view('livewire.no-objection-certificate');
    }
}

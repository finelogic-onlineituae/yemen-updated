<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use Livewire\WithFileUploads;
use App\Models\Form;

class PowerOfAttorney extends Component
{
    use WithFileUploads;

    public $client_passport_number;
    public $client_issued_by;
    public $client_issued_on;
    public $client_expires_on;
    public $client_passport_center;
    public $client_passport_attachment;
    public $client_passport_attachment_existing;

    public $agent_passport_number;
    public $agent_issued_by;
    public $agent_issued_on;
    public $agent_expire_on;
    public $agent_passport_center;
    public $agent_passport_attachment;
    public $agent_passport_attachment_existing;

    public $purpose;
    public $client_name;
    public $phone_number;
    public $agent_name;
    public $emirate_id;
    public $poa_document;
    public $residance_permit;
    public $existing_residance_permit;
    public $application;
    public $passport_centers;
    public $passport_center_client;
    public $passport_center_agent;
    public $existing_poa_document;
    public $is_consular;
    public $countries;


    protected function rules() 
    {
        return [
            'client_passport_number' => 'required|string|min:8',
            'client_issued_by' => 'nullable',
            'client_passport_center' => 'required|exists:passport_centers,id',
            'client_issued_on' => 'required|before:tomorrow',
            'client_passport_attachment' => $this->client_passport_attachment_existing ? 'nullable' : 'required|file|mimes:pdf|max:2048',

            'agent_passport_number' => 'required|string|min:8',
            'agent_issued_by' => 'nullable',
            'agent_passport_center' => 'required|exists:passport_centers,id',
            'agent_issued_on' => 'required|before:tomorrow',
            'agent_passport_attachment' => $this->agent_passport_attachment_existing ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'agent_expire_on' => 'required|after:today',

            'client_name' => 'required|max:100',
            'agent_name' => 'required|max:100',
            'phone_number' => 'required|string|max:15',
            'emirate_id' => 'required|min:17',
            'residance_permit' => $this->existing_residance_permit ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'purpose' => 'required|min:3|max:500',
            'poa_document' => $this->existing_poa_document ? 'nullable' : 'required|file|mimes:pdf|max:2048',
        ];
    }
    protected $validationAttributes = [
        'client_passport_number' => 'Client Passport Number',
        'client_issued_by' => 'Client Passport Issued By',
        'client_issued_on' => 'Client Passport Issued On',
        'client_passport_attachment' => 'Client Passport Attachment',

        'agent_passport_number' => 'Agent Passport Number',
        'agent_issued_by' => 'Agent Passport Issued By',
        'agent_issued_on' => 'Agent Passport Issued On',
        'agent_passport_attachment' => 'Agent Passport Attachment',
        'agent_expire_on' => 'Agent Passport Expire On',

        'name' => 'Name',
        'phone_number' => 'Mobile Number',
        'emirates_id' => 'Emirates ID',
        'residance_permit' => 'Residance Permit',
        'purpose' => 'Purpose of Power Of Attorney'
    ];




    public function mount()
    {
        $user = auth()->user();

        $this->is_consular = true;
        $this->allowVerification = false;
        $this->completed = false;
        $this->passport = null;
        $this->application_id = null;
        $this->application = null;
        $this->passport_centers = \App\Models\PassportCenter::all();
        $this->countries = \App\Models\Country::all();

        if(session()->has('edit_application') && session('edit_application') == 'power-of-attorney' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));

            $this->client_name = $this->application->formable->client_name;
            $this->phone_number = $this->application->formable->phone_number;
            $this->agent_name = $this->application->formable->agent_name;
            $this->emirate_id = $this->application->formable->emirate_id;
            $this->purpose = $this->application->formable->purpose;
            $this->existing_poa_document = $this->application->formable->poa_document;
            $this->existing_residance_permit = $this->application->formable->residance_permit;

            $this->client_passport_number = $this->application->formable->clientPassport->passport_number;
            $this->client_issued_by = $this->application->formable->clientPassport->issued_by;
            $this->client_issued_on = $this->application->formable->clientPassport->issued_on;
            $this->client_passport_attachment_existing = $this->application->formable->clientPassport->attachment;
            $this->client_passport_center = $this->application->formable->clientPassport->passport_center_id;

            $this->agent_passport_number = $this->application->formable->agentPassport->passport_number;
            $this->agent_issued_by = $this->application->formable->agentPassport->issued_by;
            $this->agent_issued_on = $this->application->formable->agentPassport->issued_on;
            $this->agent_passport_attachment_existing = $this->application->formable->agentPassport->attachment;
            $this->agent_expire_on = $this->application->formable->agentPassport->expires_on;
            $this->agent_passport_center = $this->application->formable->agentPassport->passport_center_id;
            
            
        }
    }

    public function updatedClientPassportAttachment()
    {
        $this->validateOnly('client_passport_attachment');
    }

    public function updatedAgentPassportAttachment()
    {
        $this->validateOnly('agent_passport_attachment');
    }

    public function registerApplication()
    {
        $this->validate();
        $this->dispatch('submit-power-of-attorney-Form');
    }

    public function render()
    {
        return view('livewire.power-of-attorney');
    }
}

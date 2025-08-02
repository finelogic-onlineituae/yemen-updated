<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Form;
use Livewire\Attributes\On; 

class MarriageCertificate extends Component
{
    use WithFileUploads;

    public $husband_passport_number;
    public $husband_issued_by;
    public $husband_issued_on;
    public $husband_expires_on;
    public $husband_passport_center;
    public $husband_passport_attachment;
    public $husband_passport_attachment_existing;

    public $wife_passport_number;
    public $wife_issued_by;
    public $wife_issued_on;
    public $wife_expire_on;
    public $wife_passport_center;
    public $wife_passport_attachment;
    public $wife_passport_attachment_existing;

    public $husband_emirates_id;
    public $date_of_marriage;
    public $wife_emirates_id;
    public $husband_name;
    public $wife_name;
    public $phone_number;
    public $contract_issued_by;
    public $contract_issued_on;
    public $registration_number;
    public $husband_residance_permit;
    public $existing_husband_residance_permit;
    public $wife_residance_permit;
    public $existing_wife_residance_permit;
    public $marriage_document;
    public $existing_marriage_document;
    public $application;
    public $passport_centers;
    public $countries;



    protected function rules() 
    {
        return [
            'husband_passport_number' => 'required|string|min:8',
            'husband_issued_by' => 'nullable',
            'husband_passport_center' => 'required|exists:passport_centers,id',
            'husband_issued_on' => 'required|before:tomorrow',
            'husband_passport_attachment' => $this->husband_passport_attachment_existing ? 'nullable' : 'required|file|mimes:pdf|max:2048',

            'wife_passport_number' => 'required|string|min:8',
          //  'wife_issued_by' => 'nullable',
            'wife_passport_center' => 'required|exists:passport_centers,id',
            'wife_issued_on' => 'required|before:tomorrow',
            'wife_passport_attachment' => $this->wife_passport_attachment_existing ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            //'wife_expire_on' => 'required|after:today',

            'husband_name' => 'required|max:100',
            'wife_name' => 'required|max:100',
            'date_of_marriage' => 'required',
            'phone_number' => 'required|string|max:15',
            'husband_emirates_id' => 'required|min:17',
            'wife_emirates_id' => 'required|min:17',
            'contract_issued_by' => 'required',
            'contract_issued_on' => 'required|before:tomorrow',
            'registration_number' => 'required',
            'husband_residance_permit' => $this->existing_husband_residance_permit ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'wife_residance_permit' => $this->existing_wife_residance_permit ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'marriage_document' => $this->existing_marriage_document ? 'nullable' : 'required|file|mimes:pdf|max:2048',
        ];
    }
    protected $validationAttributes = [
        'husband_passport_number' => 'Husband Passport Number',
        'husband_issued_by' => 'Husband Passport Issued By',
        'husband_issued_on' => 'Husband Passport Issued On',
        'husband_passport_attachment' => 'Husband Passport Attachment',

        'wife_passport_number' => 'Wife Passport Number',
        'wife_issued_by' => 'Wife Passport Issued By',
        'wife_issued_on' => 'Wife Passport Issued On',
        'wife_passport_attachment' => 'Wife Passport Attachment',
        'wife_expire_on' => 'Wife Passport Expire On',

        'husband_name' => 'Husband Name',
        'wife_name' => 'Wife Number',
        'phone_number' => 'Phone Number',
        'date_of_marriage' => 'Date Of Marriage',
        'husband_emirates_id' => 'Husband Emirates ID',
        'wife_emirates_id' => 'Wife Emirates ID',
        'contract_issued_by' => 'Contract Issued by',
        'contract_issued_on' => 'Contract Issued on',
        'registration_number' => 'Registration Number',
        'husband_residance_permit' => 'Husband Residence Permit',
        'wife_residance_permit' => 'Wife Residence Permit',
        'marriage_document' => 'Marriage Document',

    ];




    public function mount()
    {
        $user = auth()->user();

        //$this->is_consular = true;
        $this->application = null;
        $this->passport_centers = \App\Models\PassportCenter::all();
        $this->countries = \App\Models\Country::all();

        if(session()->has('edit_application') && session('edit_application') == 'marriage-certificate' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));

            $this->husband_name = $this->application->formable->husband_name;
            $this->wife_name = $this->application->formable->wife_name;
            $this->date_of_marriage = $this->application->formable->date_of_marriage;
            $this->phone_number = $this->application->formable->phone_number;
            $this->husband_emirates_id = $this->application->formable->husband_emirates_id;
            $this->wife_emirates_id = $this->application->formable->wife_emirates_id;
            $this->contract_issued_by = $this->application->formable->contract_issued_by;
            $this->contract_issued_on = $this->application->formable->contract_issued_on;
            $this->registration_number = $this->application->formable->registration_number;
            $this->existing_husband_residance_permit = $this->application->formable->husband_residance_permit;
            $this->existing_wife_residance_permit = $this->application->formable->wife_residance_permit;
            $this->existing_marriage_document = $this->application->formable->marriage_document;


            $this->husband_passport_number = $this->application->formable->husbandPassport->passport_number;
            $this->husband_issued_by = $this->application->formable->husbandPassport->issued_by;
            $this->husband_issued_on = $this->application->formable->husbandPassport->issued_on;
            $this->husband_passport_attachment_existing = $this->application->formable->husbandPassport->attachment;
            $this->husband_passport_center = $this->application->formable->husbandPassport->passport_center_id;

            $this->wife_passport_number = $this->application->formable->wifePassport->passport_number;
            $this->wife_issued_by = $this->application->formable->wifePassport->issued_by;
            $this->wife_issued_on = $this->application->formable->wifePassport->issued_on;
            $this->wife_passport_attachment_existing = $this->application->formable->wifePassport->attachment;
            $this->wife_expire_on = $this->application->formable->wifePassport->expires_on;
            $this->wife_passport_center = $this->application->formable->wifePassport->passport_center_id;
            
            
        }
    }

    // public function updatedClientPassportAttachment()
    // {
    //     $this->validateOnly('client_passport_attachment');
    // }

    // public function updatedAgentPassportAttachment()
    // {
    //     $this->validateOnly('agent_passport_attachment');
    // }

    public function registerApplication()
    {
        $this->validate();
        $this->dispatch('submitMarriageForm');
    }

    public function render()
    {
        return view('livewire.marriage-certificate');
    }
}

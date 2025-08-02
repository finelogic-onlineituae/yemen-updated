<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use Livewire\WithFileUploads;
use App\Models\Passport as PassportModel;


class Passport extends Component
{
    use WithFileUploads;

    public $existingPassport;
    public $useExistingPassport;
    public $passport_number;
    public $issued_by;
    public $issued_on;
    public $expires_on;
    public $attachment;
    public $issued_by_other;
    public PassportModel $livePassport;
    public $updateCompleted;
    public $show_expire;
    public $countries;
    public $passport_centers;
    public $passport_center;
    public $is_consular;
    public $existing_attachment;
    public $passport;
    public $titleRemove = false;

    protected function rules() 
    {
        return [
            'passport_number' => 'required|string|min:8',
            'expires_on' => $this->is_consular ? 'nullable' : 'required|after:today',
            'issued_by' => $this->is_consular ? 'nullable' : 'required|exists:countries,country_code',
            'passport_center' => $this->is_consular ? 'required|exists:passport_centers,id' : 'nullable',
            'issued_on' => 'required|before:tomorrow',
            'attachment' => $this->existing_attachment ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
        ];
    }
    protected $validationAttributes = [
        'passport_number' => 'Passport Number',
        'issued_by' => 'issued By',
        'issued_on' => 'Issued On',
        'attachment' => 'Passport Attachment'
    ];

    public function mount($show_expire = false,  $is_consular = true, $passport = null,$titleRemove = false)
    {
        $this->titleRemove = $titleRemove;
        //dd(auth()->user()->passports()->first());
         $this->is_consular = $is_consular;
         if($is_consular)
         {
            $this->passport_centers = \App\Models\PassportCenter::all();
         }
         else{
            $this->countries = \App\Models\Country::where('country_code', '!=', 'YE')->get();
         }

         if($passport){
            $this->passport = PassportModel::findOrFail($passport);
            $this->passport_number = $this->passport->passport_number;
            $this->issued_by = $this->passport->issued_by;
            $this->expires_on = $this->passport->expires_on;
            $this->passport_center = $this->passport->passport_center_id;
            $this->issued_on = $this->passport->issued_on;
            $this->existing_attachment = $this->passport->attachment;
         }
    }

    public function updatedAttachment()
    {
        // Trigger validation only after the file is fully uploaded
        $this->validateOnly('attachment');
    }

    #[On('validate-passport')] 
    public function updatePassportInfo()
    {
        $this->validate();
        $this->dispatch('passport-validated');
    }
   
    public function render()
    {
        return view('livewire.passport');
    }
}

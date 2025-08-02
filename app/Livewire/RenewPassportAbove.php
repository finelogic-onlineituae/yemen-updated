<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Form;
use App\Models\Country;
use App\Models\PassportCenter;
use Livewire\Attributes\On; 
use Storage;

class RenewPassportAbove extends Component
{
    use WithFileUploads;
 
    public $name;
    public $emirates_id;
    public $name_arabic;
    public $profession;
    public $place_of_birth;
    public $date_of_birth;
    public $relative_in_uae;
    public $relative_in_uae_number;
    public $relative_in_yemen;
    public $relative_in_yemen_number;
    public $address_land_mark;
    public $address_street;
    public $address_area;
    public $address_emirate;
//    public $address;
    public $id_card;
    public $existing_id_card;

    public $phone_number;
    public $present_passholder;
    public $left_thumb;
    public $existing_left_thumb;
    public $right_thumb;
    public $existing_right_thumb;
    public $photo;
    public $existing_photo;
    public $emirates_id_copy;
    public $existing_emirates_id_copy;

    public $passport;
    public $allowVerification;
    public $completed;
    public $application;
    public $application_id;
    public $croppedPhoto; // base64 image

    public $countries;
    public $passport_centers;

    //protected $listeners = ['uploadCroppedImage'];

    protected function rules() 
    {
        return [
            'name' => 'required',
            'phone_number' => 'required|string|max:15',
            'emirates_id' => 'nullable|min:17',
            'name_arabic' => 'required',
            'profession' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'relative_in_uae' => 'required',
            'relative_in_uae_number' => 'required|string|max:15',
            'relative_in_yemen' => 'required',
            'relative_in_yemen_number' => 'required|string|max:15',
            'address_land_mark' => 'required',
            'address_street' => 'required',
            'address_area' => 'required',
            'address_emirate' => 'required',
           
            //'present_passholder' => 'required',
            'left_thumb' => $this->existing_left_thumb ? 'nullable' : 'required|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            //'id_card' => $this->existing_id_card ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'emirates_id_copy' => $this->existing_emirates_id_copy ? 'nullable' : 'nullable|file|mimes:pdf,webp,png,jpg,jpeg|max:2048',
            //'right_thumb' => $this->existing_right_thumb ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'croppedPhoto' =>$this->existing_photo ? 'nullable' : 'required',
           
        ];
    }
    protected $validationAttributes = [
        'name' => 'Name in English',
        'name_arabic' => 'Name in Arabic',
        'profession' => 'Profession',
        'place_of_birth' => 'Place of Birth',
        'date_of_birth' => 'Date of Birth',
        'relative_in_uae' => 'Relative in uae',
        'relative_in_uae_number' => 'Relative in uae mobile number',
        'relative_in_yemen' => 'Relative in yemen',
        'relative_in_yemen_number' => 'Relative in yemen mobile number',
        'address' => 'Address',
        //'id_card' => 'ID Card',
        'phone_number' => 'Mobile Number',
        'emirates_id' => 'Emirates ID',
        'present_passholder' => 'Present ',
        'left_thumb' => 'Left Thumb Fingerprint',
        'emirates_id_copy' => 'EID copy',
        //'right_thumb' => 'Right Thumb Fingerprint',
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
        $this->passport_centers = PassportCenter::all();
        if(session()->has('edit_application') && session('edit_application') == 'renew-passport-above' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));
            $this->name = $this->application->formable->name;
            $this->name_arabic = $this->application->formable->name_arabic;
            $this->profession = $this->application->formable->profession;
            $this->place_of_birth = $this->application->formable->place_of_birth;
            $this->date_of_birth = $this->application->formable->date_of_birth;
            $this->relative_in_uae = $this->application->formable->relative_in_uae;
            $this->relative_in_uae_number = $this->application->formable->relative_in_uae_number;
            $this->relative_in_yemen = $this->application->formable->relative_in_yemen;
            $this->relative_in_yemen_number = $this->application->formable->relative_in_yemen_number;
            $this->address_land_mark = $this->application->formable->address_land_mark;
            $this->address_street = $this->application->formable->address_street;
            $this->address_area = $this->application->formable->address_area;
            $this->address_emirate = $this->application->formable->address_emirate;
            //$this->existing_id_card = $this->application->formable->id_card;
            $this->phone_number = $this->application->formable->phone_number;
            $this->passport = $this->application->formable->passport_id;
            $this->emirates_id = $this->application->formable->emirates_id;
            $this->present_passholder = $this->application->formable->present_passholder;
            $this->existing_left_thumb = $this->application->formable->left_thumb;
            $this->existing_emirates_id_copy = $this->application->formable->emirates_id_copy;
           // $this->existing_right_thumb = $this->application->formable->right_thumb;
            $this->existing_photo = $this->application->formable->photo;
            $this->address_land_mark = $this->application->formable->land_mark;
            $this->address_area = $this->application->formable->area;
            $this->address_street = $this->application->formable->street;
            $this->address_emirate = $this->application->formable->emirate;
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
        $this->dispatch('submitRenewAboveForm');
    }
    
    public function render()
    {
        return view('livewire.renew-passport-above');
    }
}

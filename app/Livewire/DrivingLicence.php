<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\DrivingLicence as DrivingLicenceModel;
use App\Models\Form;
use App\Models\Passport;
use App\Models\Country;
use App\Models\PassportCenter;
use Livewire\Attributes\On; 
use App\Models\DrivingLicenceCenter;
use App\Models\VehicleCategory;

class DrivingLicence extends Component
{
    use WithFileUploads;

    public $name;
    public $phone_number;
    public $driving_licence_number;
    public $vehicle_category;
    public $issued_at;
    public $issued_on;
    public $expire_on;
    public $emirates_id;
    public $driving_licence_centers;
    public $driving_licence_center;
    public $vehicle_categories;
    public $licence_attachment;
    public $existing_licence;
    public $passport;
    public $application;
    public $residance_permit;
    public $existing_residance_permit;
    public $countries;
    public $passport_centers;

    protected function rules() 
    {
        return [
            'name' => 'required',
            'phone_number' => 'required|string|max:15',
            'driving_licence_number' => 'required',
            'driving_licence_center' => 'required|exists:driving_licence_centers,id',
            'vehicle_category' => 'required|exists:vehicle_categories,id',
            'issued_on' => 'required|before:tomorrow',
            'expire_on' => 'required|after:today',
            'emirates_id' => 'required|min:15',
            'licence_attachment' => $this->existing_licence ? 'nullable' : 'required|file|mimes:pdf|max:2048',
            'residance_permit' => $this->existing_residance_permit ? 'nullable' : 'required|file|mimes:pdf|max:2048'
        ];
    }
    protected $validationAttributes = [
        'name' => 'Name',
        'phone_number' => 'Mobile Number',
        'driving_licence_number' => 'Driving Licence Number',
        'driving_licence_center' => 'Issued At',
        'vehicle_category' => 'Vehicle Category',
        'issued_on' => 'Issued On',
        'expire_on' => 'Expires On',
        'emirates_id' => 'Emirates ID',
        'licence_attachment' => 'Licence',
        'residance_permit' => 'Residance Permit'
    ];


    public function mount()
    {
        $this->driving_licence_centers = DrivingLicenceCenter::all();
        $this->vehicle_categories = VehicleCategory::all();

        $this->countries = Country::all();
        $this->passport_centers = PassportCenter::all();

        if(session()->has('edit_application') && session('edit_application') == 'driving-licence' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));
            $this->name = $this->application->formable->name;
            $this->phone_number = $this->application->formable->phone_number;
            $this->passport = $this->application->formable->passport_id;
            $this->driving_licence_number = $this->application->formable->driving_licence_number;
            $this->driving_licence_center = $this->application->formable->driving_licence_center_id;
            $this->vehicle_category = $this->application->formable->vehicle_category_id;
            $this->issued_on = $this->application->formable->issued_on;
            $this->expire_on = $this->application->formable->expire_on;
            $this->emirates_id = $this->application->formable->emirates_id;
            $this->existing_licence = $this->application->formable->licence_attachment;
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
        $this->dispatch('submitDLForm');
    }

    public function render()
    {
        return view('livewire.driving-licence');
    }
}

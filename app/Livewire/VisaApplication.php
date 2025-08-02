<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\VisaApplication as VisaApplicationModel;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Form;

class VisaApplication extends Component
{
    use WithFileUploads;
 
    public $name;
    public $nationality;
    public $countries;
    public $religion;
    public $address;
    public $address_uae;
    public $place_of_birth;
    public $date_of_birth;
    public $proffession;
    public $place_of_work;
    public $purpose_of_travel;
    public $period_required;
    public $address_in_roy;
    public $sponsor_1_name;
    public $sponsor_1_address;
    public $sponsor_2_name;
    public $sponsor_2_address;
    public $previous_visit_date_1;
    public $previous_visit_date_2;
    public $id_card;
    public $sponsor_pass;
    public $id_card_file;
    public $sponsor_pass_file;
    public $add_accompany;
    
    public $same_address;
    public $hasPassport;
    public $allowVerification;
    public $completed;
    public $confirmDeclaration;
    public $passport;
    public $application;
    public $application_id;
    public $passport_centers;


    protected $listeners = ['useExistingPassport' => 'updatePassportUsage'];

    protected function rules()
    {
        return [
            'name' => 'required',
            'nationality' => 'required|exists:countries,country_code',
            'religion' => 'required|max:25',
            'place_of_birth' => 'required|max:50',
            'date_of_birth' => 'required|before:today',
            'proffession' => 'required|max:50',
            'place_of_work' => 'required|max:50',
            'purpose_of_travel' => 'required|max:100',
            'period_required' => 'required|digits_between:1,1200',
            'address' => 'required|max:300',
            'address_uae' => 'required|max:300',
            'address_in_roy' => 'required|max:300',
            'sponsor_1_name' => 'required|max:50',
            'sponsor_1_address' => 'required|max:300',
            'sponsor_2_name' => 'nullable|max:50',
            'sponsor_2_address' => 'nullable|max:300',
            'previous_visit_date_1' => 'nullable|before:yesterday',
            'previous_visit_date_2' => 'nullable|before:yesterday',
            'id_card' => $this->id_card_file ? 'nullable|file|mimes:pdf|max:2048' : 'required|file|mimes:pdf|max:2048',
            'sponsor_pass' => $this->sponsor_pass_file ? 'nullable|file|mimes:pdf|max:2048' : 'required|file|mimes:pdf|max:2048',
        ];
    }
    public function mount()
    {
        $this->countries = \App\Models\Country::all();
        //$this->name = auth()->user()->name;
       
        $this->allowVerification = false;
        $this->completed = false;
        $this->hasPassport = true;
        $this->confirmDeclaration = false;
        $this->passport = null;
        $this->application_id = null;
        $this->application = null;

        if(session()->has('edit_application') && session('edit_application') == 'visa-application' && session()->has('application_id'))
        {
            $this->application = Form::findOrFail(session('application_id'));

            $this->name = $this->application->formable->name;
            $this->nationality = $this->application->formable->nationality;
            $this->religion = $this->application->formable->religion;
            $this->address = $this->application->formable->permanent_address;
            $this->address_uae = $this->application->formable->address_uae;
            $this->place_of_birth = $this->application->formable->place_of_birth;
            $this->date_of_birth = $this->application->formable->date_of_birth;
            $this->proffession = $this->application->formable->proffession;
            $this->place_of_work = $this->application->formable->place_of_work;
            $this->address_in_roy = $this->application->formable->address_in_roy;
            $this->period_required = $this->application->formable->period_required;
            $this->purpose_of_travel = $this->application->formable->purpose_of_travel;
            $this->sponsor_1_name = $this->application->formable->sponsor_1_name;
            $this->sponsor_2_name = $this->application->formable->sponsor_2_name;
            $this->sponsor_1_address = $this->application->formable->sponsor_1_address;
            $this->sponsor_2_address = $this->application->formable->sponsor_2_address;
            $this->id_card_file = $this->application->formable->id_card;
            $this->sponsor_pass_file = $this->application->formable->sponsor_pass;
            $this->previous_visit_date_1 = $this->application->formable->previous_visit_date_1;
            $this->previous_visit_date_2 = $this->application->formable->previous_visit_date_2;
            $this->passport = $this->application->formable->passport_id;
        }

    }
    
    public function updatePassportUsage($value)
    {
        $this->hasPassport = $value;
    }
    public function copyAddress()
    {
        if($this->same_address)
        {
            $this->address_uae = $this->address;
        }
        else
        {
            $this->address_uae = '';
        }
    }

    public function updatedIdCard()
    {
        $this->validateOnly('id_card');
    }

    public function updatedSponsorPass()
    {
        $this->validateOnly('sponsor_pass');
    }


    public function verifyApplication()
    {
        $this->validate();
        $this->dispatch('validate-passport');
    }

    #[On('passport-validated')] 
    public function registerApplication()
    {
        
        $this->validate();
        $this->dispatch('submitVisaApplicationForm');
    }

    // #[On('passport-updated')] 
    // public function toggleView()
    // {
    //     $this->allowVerification = !$this->allowVerification;
    //     $this->confirmDeclaration = false;
    //     $this->js('window.scrollTo({ top: 0, behavior: "smooth" })');
    // }

    // public function toggleDeclaration()
    // {
    //     $this->confirmDeclaration = !$this->confirmDeclaration;
    // }
    // public function submitApplication()
    // {
    //     //dd(auth()->user()->name);
    //     $visaApplication = VisaApplicationModel::create([
    //         'name' => auth()->user()->name,
    //         'nationality' => $this->nationality,
    //         'religion' => $this->religion,
    //         'permanent_address' => $this->address,
    //         'address_uae' => $this->address_uae,
    //         'place_of_birth' => $this->place_of_birth,
    //         'date_of_birth' => $this->date_of_birth,
    //         'proffession' => $this->proffession,
    //         'place_of_work' => $this->place_of_work,
    //         'purpose_of_travel' => $this->purpose_of_travel,
    //         'period_required' => $this->period_required,
    //         'address_in_roy' => $this->address_in_roy,
    //         'sponsor_1_name' => $this->sponsor_1_name,
    //         'sponsor_2_name' => $this->sponsor_2_name,
    //         'sponsor_1_address' => $this->sponsor_1_address,
    //         'sponsor_2_address' => $this->sponsor_2_address,
    //         'id_card' => $this->id_card_file,
    //         'sponsor_pass' => $this->sponsor_pass_file,
    //      //   'previous_visit_date_1' => $this->previous_visit_date_1,
    //      //   'previous_visit_date_2' => $this->previous_visit_date_2,

    //         'passport_id' => auth()->user()->passports()->first()->id,
    //     ]);
    //     auth()->user()->forms()->create([
    //         'status' => 'Applied',
    //         'formable_id' => $visaApplication->id,
    //         'formable_type' => \App\Models\VisaApplication::class
    //     ]);

    //     $this->completed = true;
    //     $this->js('window.scrollTo({ top: 0, behavior: "smooth" })');
    // }

    public function render()
    {
        return view('livewire.visa-application');
    }
}

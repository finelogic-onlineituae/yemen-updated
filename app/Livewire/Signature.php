<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Form;
use Storage;

class Signature extends Component
{
    use WithFileUploads;

    public $signature;
    public $declaration;
    public $verification;
    public $submitBtn;
    public $success;
    public $application_id; 
public $croppedSignature;

    protected function rules()
    {
        return [
            'signature' => 'required|file|mimes:jpg,png,jpeg|max:2048'
        ];
    }
    protected $listeners = ['setCroppedSignature'];

    protected $validationAttributes = [
        'signature' => 'Signature File'
    ];

    public function mount($application_id)
    {
        $this->verification = false;
        $this->declaration = false;
        $this->submitBtn = false;
        $this->success = false;
        $this->application_id = $application_id;
    }




   
    public function updatedSignature()
    {
      
        try {
            $this->validateOnly('signature');
            $this->submitBtn = true;
        } catch (ValidationException $e) {
            $this->submitBtn = false;
        }

        $application = Form::findOrFail($this->application_id);
        $application->signature = null;

        $extension = $this->signature->getClientOriginalExtension();
        $file_path = $this->signature->storeAs('user-signature', auth()->user()->id.'-'.Str::uuid()->toString().'.'.$extension);
        $this->signature = $file_path;
        $this->verification = true;
        $this->submitBtn = true;
      
    }
    public function toggleDeclaration()
    {
        $this->submitBtn = !$this->submitBtn;
    }
    public function confirmSignature()
    {
            $image = $this->signature;
                // Split the base64 string to extract the file extension and the data
            $image_parts = explode(";base64,", $image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $extension = $image_type_aux[1]; // jpeg, png, etc.

            $image_base64 = base64_decode($image_parts[1]);

           

            // Generate file name with extension
            $extension = 'png'; // or png depending on your data URI
            $filename = auth()->user()->id . '-' . Str::uuid()->toString() . '.' . $extension;
            $file_path = 'user-signature/' . $filename;

                // Store the decoded image
            Storage::disk('public')->put($file_path, $image_base64);

       //dd( 'shid');
        $application = Form::findOrFail($this->application_id);
        $application->signature = $file_path;
        $application->save();
        $this->success = true;

    }
    public function render()
    {
        return view('livewire.signature');
    }
}

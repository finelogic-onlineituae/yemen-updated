<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passport;
use App\Models\Form;
use App\Models\Officer;
use App\Models\Country;
use App\Models\BirthCertificate;
use Mpdf\Mpdf;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Mail;
use App\Mail\PdfFormMail;
use App\Jobs\SendPdfMailJob;

class ApplicationController extends Controller
{
    
    public function index(Request $request)
    {
       
        $request->session()->put('category', 'my-apps');
        $request->session()->put('app', 'my-apps');
       // $applications = auth()->user()->forms()->orderBy('created_at', 'desc')->paginate(15);

      //  $applications = Form::query()->where([['user_id', auth()->id()],['status', 'Applied']])->latest()->paginate(15);
        $query = Form::where('user_id', auth()->id());
        if ($request->status_select && $request->status_select !== 'all') {
            $query->where('status', $request->status_select);
        } 
        // else {
        //     $query->where('status', '!=', 'Initiated');
        // }
        if($request->application_id){
            $query->where('id', $request->application_id);
        }
        if ($request->from_date && $request->to_date) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }
        $query->where('status', '!=', 'Initiated');
        $applications = $query->latest()->paginate(15);
       // dd($applications);
        return view('applications', ['applications' => $applications]);
    }
    public function createVisaApplication()
    {
        $countries = Country::all();
        return view('visa-application', ['countries' => $countries]);
    }

    public function confirmApplication(Request $request)
    {
        $application_id = $request->application_id;
        $application = Form::findOrFail($application_id);

        $application->status = 'Applied';
        $staffWithToken = Officer::where('current_token', true)->first();
        $query = Officer::where('role_id', '3');

        if($staffWithToken){
            $query->where('id', '>', $staffWithToken->id);              
        }
        $next_staff = $query->orderBy('id')->first();

        $next_staff = $next_staff ?: Officer::where('role_id', 3)->orderBy('id')->first();

        if($staffWithToken){
            $staffWithToken->current_token = false;
            $staffWithToken->save();
        }
        $application->current_position = $next_staff->user->id;
        $application->applied_on = now();
        $application->save();

     

        $next_staff->current_token = true;
        $next_staff->save();
      
      /*  $pdfGenerator = New PDFController();

        $pdfContent = $pdfGenerator->generateForMail($request->application_id);
//dd('hai');

        // Send email
        //Mail::to('recipient@example.com')->send(new PdfFormMail($application, $pdfContent));
        $encodedPdfContent = base64_encode($pdfContent);

        dispatch(new SendPdfMailJob($application, $encodedPdfContent, $application->applicant->email));*/
        
        session()->forget(['edit_application', 'application_id']);
        return redirect()->route('post-confirmation', ['application_id' => $application->id]);
    }

    public function postConfirmation(Request $request)
    {
        $application_id = $request->application_id;
        $application = Form::findOrFail($application_id);
        return view('post-confirmation', ['application_id' => $application->id]);
    }
   

}

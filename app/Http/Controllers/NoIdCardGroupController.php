<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\NoIdCardGroup;
use App\Models\NoIdCardGroupPassport;

class NoIdCardGroupController extends Controller
{
     public function create(Request $request)
    {
        session(['category' => '1', 'app' => 'applications/no-id-card-group']);
       
        return view('no-id-card-group.create');
    }

    public function store(Request $request)
    {
       $request->validate([
            ''
       ]);
       
        return redirect()->route('no-id-card-group.verify', ['application_id' => encrypt($application->id)]);
    }
    public function verify(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);

       // dd($application);
        return view('no-id-card-group.verify-no-id-card-group', ['application' => $application]);
    }

    public function edit(Request $request)
    {
        $application_id = decrypt($request->application_id);
        $application = Form::findOrFail($application_id);
        session(['application_id' => $application_id]);
        session(['edit_application' => 'no-id-card-group']);
        
        return view('no-id-card-group.create');
    }
}

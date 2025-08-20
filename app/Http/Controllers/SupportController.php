<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\PassportCenter;

class SupportController extends Controller
{
    public function create(Request $request)
    {
        session(['category' => '1', 'app' => 'applications/family-member']);
       
        return view('support.create', ['countries' => Country::all(), 'passport_centers' => PassportCenter::all()]);
    }

}

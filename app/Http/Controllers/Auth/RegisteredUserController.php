<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Route;
use App\Models\Country;
use Illuminate\Validation\Rule;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $countries = Country::withoutYemen();
        return view('auth.register', ['countries' => $countries]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
       // dd(session('captcha'));
        /*if($request->captcha != session('captcha'))
        {
            return redirect()->back()->with('error', 'Captche is Invalid!');
        }*/
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required',  'min:8', 'max:15'],
            'password' => ['required', 'min:8', 'max:15'],
            //'is_yemen' => ['required', Rule::in(['yes','no'])],
            //'nationality' => ['required_if:is_yemen,no', $request->is_yemen == 'no' ? 'exists:countries,country_code' : ''],
            'captcha' => ['required', new Captcha()],
        ],  [], [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone Number',
            'password' => 'Password',
            //'is_yemen' => 'Yemen Citizenship'
        ]);

       // $file_path = $request->file('signature')->store('user-signature');
        $user = User::create([
            'name' => ucwords($request->surname.'. '.$request->name),
            'email' => $request->email,
            'phone_number' => $request->phone,
        //    'nationality' => $request->is_yemen == 'yes' ? 'YE' : $request->nationality,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

/*         $token = csrf_token();
        $request = Request::create('/email/verification-notification', 'POST');
        $request->headers->set('X-CSRF-TOKEN', $token);
        $response = Route::dispatch($request);
        //dd($response); */

        return redirect(route('verify.email', absolute: false));
    }
}

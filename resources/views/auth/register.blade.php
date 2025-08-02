<x-guest-layout>
    <div class="manage-width mx-auto mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="w-full text-center text-xl py-3">User Registration</h1>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="align-items-center">
        @csrf

        <div class="row">
            <div class="col-12">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name (اسم)')" />
            <div class="row">
                <div class=" col col-lg-2 col-sm-4 col-md-4">
                    <select class="form-control mt-1" name="surname">
                        <option value="Mr">Mr</option>
                        <option value="Mr">Mrs</option>
                        <option value="Mr">Ms</option>
                    </select>
                </div>
                <div class="col col-lg-10 col-sm-8 col-md-8">
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

         <!-- Phone Number -->
         <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number (رقم الهاتف)')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div> 

            <!-- Phone Number -->
            {{-- <div class="mt-4">
                <x-input-label for="is_yemen" :value="__('Nationality (رقم الهاتف)')" class="fw-bold"/>
                <label class="form-check-label" for="is_yemen">Are you a Yemen citizen?</label>
                <input class="mx-2" type="radio" name="is_yemen" value="yes" @checked(old('is_yemen') == 'yes')/>Yes
                <input class="mx-2" type="radio" name="is_yemen" value="no" id="not_yemen" @checked(old('is_yemen') == 'no')/>No
                <x-input-error :messages="$errors->get('is_yemen')" class="mt-2" />
                <select style="display:none" id="nationality" class="form-select mt-2" name="nationality" :value="old('nationality')">
                    <option value="">Choose Your Nationality</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->country_code }}" @selected(old('nationality') == $country->country_code)>{{ $country->country_name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
            </div>  --}}

{{--         <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address in UAE (العنوان في الإمارات العربية المتحدة)')" />
            <x-textarea-input id="address" rows="5" class="block mt-1 w-full" name="address" :value="old('address')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div> --}}


 
{{--         <!-- Signature -->
        <div class="mt-4 mt-lg-0 mt-xl-0">
            <x-input-label for="signature" :value="__('Your Signature (التوقيع الخاص بك)')" />
            <input id="signature" class="form-control rounded border-primary mt-1 w-100" type="file" name="signature" :value="old('signature')" autofocus autocomplete="signature" />
            <x-input-label for="signature" :value="__('This signature will be embedded on your Applications')" />
            <x-input-label for="signature" :value="__('(سيتم تضمين هذا التوقيع في تطبيقاتك)')" />
            <x-input-label for="signature" :value="__('Type: jpeg / png, size min: 100KB max: 2MB)')" />
            <x-input-error :messages="$errors->get('signature')" class="mt-2" />
        </div>  --}}
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email (بريد إلكتروني)')" />
            <x-text-input id="email" class="form-control mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password (8-15 Characters) (كلمة المرور)')" />
            <div class="">
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
             {{--    <button class="px-2 border border-2  rounded-right border-dark fs-5" onclick="event.preventDefult();"><i class="fa fa-eye"></i></button> --}}
                            <input class="rounded" type="checkbox" name="show_password" id="showPassword" onclick="togglePassword();" />
                            <label class="form-check-label" for="show_password">Show Password</label> 
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        {{-- <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password (تأكيد كلمة المرور)')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div> --}}
        <div class="mt-4">
            <div class="d-flex">
            <img src="{{ url('/captcha') }}" id="captcha" alt="CAPTCHA" class="mb-2"/>
                <button type="button" class="fs-2" onclick="event.preventDefault();reloadCaptcha()">🔄</button>
            </div>    
            <x-input-label for="captcha" :value="__('Enter the CAPTCHA:')" />
    <x-text-input type="text" name="captcha" class="block mt-1 w-full" required />
    <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
        </div>

    </div>
</div>
<div class="flex items-center justify-center mt-4">
    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
        {{ __('Already registered?') }}
    </a>

    <x-primary-button class="ms-4">
        {{ __('Register') }}
    </x-primary-button>
</div>

    </form>
</div>
<script>
    function reloadCaptcha() {
        document.getElementById('captcha').src = '/captcha?' + Math.random();
    }
    function togglePassword()
    {
        const password = document.getElementById('password');
        const showPassword = document.getElementById('showPassword');
        if(showPassword.checked)
        {
            password.type = "text";
        }
        else
        {
            password.type = "password";
        }
    }

//     $(window).on('load', function() {
//         if($('#not_yemen').is(':checked')) {
//             $('#nationality').css('display','block');
//         }
// });

//     $(document).ready(function () {

        

//     $('input[name="is_yemen"]').on('change', function () {
//        // const nationality = document.getElementById('nationality');
//       if($(this).val() == 'yes'){
//                 $("#nationality").slideUp(400);
//                 $("#nationality").removeAttr('required');
//             }
//             else{
//                 $("#nationality").slideDown(400);
//                 $("#nationality").attr('required', true);
//             }
//     });
//   });

</script>
</x-guest-layout>

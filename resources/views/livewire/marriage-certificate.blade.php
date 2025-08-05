<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100">
        <form action="{{ route('marriage-certificate.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="registerApplication" id="marriage-certificate-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                
                
            <div class="card text-start my-2">

                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">معلومات جواز سفر الزوج</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_arabic">الاسم باللغة العربية بحسب جواز السفر</label>
                                        <input type="text" class="form-control" name="name_arabic" wire:model="surname_arabic"/>
                                        @error('name_arabic')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_english">الاسم الكامل باللغة الإنجليزية كما هو الحال في جواز السفر</label>
                                        <input type="text" class="form-control" name="name_english" wire:model="name_english"/>
                                        @error('name_arname_englishabic')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    
                                        <label class="form-label fw-bold"  for="passport_number">رقم جواز السفر</label>
                                        
                                        <input type="text" id="passportInput-" maxlength="8" class="form-control" name="passport_number" wire:model="passport_number" />
                                        <small id="passportError-" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                        @error('passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">مهنة</label>
                                        <input type="text" class="form-control" name="profession" wire:model="profession"/>
                                        @error('profession')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">تاريخ الميلاد</label>
                                        <input type="date" class="form-control" name="date_of_birth" wire:model="date_of_birth"/>
                                        @error('date_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">جنس</label>
                                        <select class="form-select" name="gender" wire:model="gender">
                                            <option value="">Choose Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        @error('profession')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="country_of_birth">(المحافظة) محل الميلاد</label>
                                        <select class="form-select" name="country_of_birth" wire:model="country_of_birth">
                                            <option value="">Choose a Country</option>
                                            @forelse ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                        @error('country_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="city_of_birth">(المحافظة - المدينة) محل الميلاد</label>
                                        <input type="text" class="form-control" name="city_of_birth" wire:model="city_of_birth"/>
                                        @error('city_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="issued_on">تاريخ الإصدار</label>
                                        <input type="date" class="form-control" name="issued_on" wire:model="issued_on"/>
                                        @error('issued_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">تاريخ الانتهاء</label>
                                        <input type="date" class="form-control" name="expire_on" wire:model="expire_on"/>
                                        @error('expire_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                 <div class="row">
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="issued_by">جهة الإصدار</label>
                                        <select class="form-select" name="passport_center" wire:model="passport_center">
                                            <option>جهة الإصدار</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}">{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 <div class="card text-start my-2">
                    <div class="card-header">
                        معلومات عقد الزواج
                    </div>
                    <div class="card-body">
                        {{-- Agent Passport --}}
    
                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="contract_issued_by">سلطة الإصدار</label>
                                    <input type="text" class="form-control" name="contract_issued_by" wire:model="contract_issued_by"/>
                                    @error('contract_issued_by')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="registration_number">رقم التسجيل </label>
                                    <input  type="text" class="form-control" wire:model="registration_number"  name="registration_number"/>
                                    @error('registration_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="contract_issued_on">تاريخ الافراج عنه </label>
                                    <input  type="date" class="form-control" wire:model="contract_issued_on" id="contract_issued_on" name="contract_issued_on"/>
                                    @error('contract_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>     
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="date_of_marriage">تاريخ الزواج </label>
                                    <input  type="date" class="form-control" wire:model="date_of_marriage"  name="date_of_marriage"/>
                                    @error('date_of_marriage') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                              
                            </div>
                            
                        </div>
                    </div>

                    <div class="card text-start my-2">
                    <div class="card-header">المرفقات</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="attachment"> جواز (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" wire:model="attachment" name="attachment" />
                             @error('attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="attachment"> الهوية الإماراتية (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" wire:model="attachment" name="attachment" />
                                @error('attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>   
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="attachment"> إثبات الزواج (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" wire:model="attachment" name="attachment" />
                                @error('attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>    
                        
                    </div>
                </div>
            <div class="form-group my-3 text-center">
                <button class="btn buttom-effect">تقديم الطلب</button>
            </div>
            </div>
        </form>
    </div>
     {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif  --}}

</div>

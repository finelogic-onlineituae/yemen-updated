<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('visa-application.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="visa-application-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                <div class="card text-start my-2">

                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">معلومات شخصية</div>
                            <div class="card-body">
                        <div class="row">
                           
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_english">الاسم الكامل باللغة الإنجليزية كما هو الحال في جواز السفر</label>
                                        <input type="text" class="form-control" name="name_english" wire:model="name_english"/>
                                        @error('name_english')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_arabic">الاسم الكامل (كما هو مذكور في جواز السفر)</label>
                                        <input type="text" class="form-control" name="name_arabic" wire:model="surname_arabic"/>
                                        @error('name_arabic')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <p class="text-danger fw-bold mt-5">معلومات الميلاد والجنسية</p>
                        <hr>
                        <div class="row">
                            
                               <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="country_of_birth">بلد الميلاد</label>
                                <select name="country_of_birth" wire:model="country_of_birth" class="form-select">
                                    <option value="">اختر البلد</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->country_code }}">{{ $country->country_name.'('.$country->country_code.')' }}</option>
                                    @endforeach
                                </select>
                                @error('country_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 ">
                                <label class="form-label fw-bold" for="name">مدينة الميلاد</label>
                                <input type="text" class="form-control" name="city_of_birth" wire:model="city_of_birth"/>
                                @error('city_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="country_of_birth">الجنسية الحالية</label>
                                <select name="current_nationality" wire:model="current_nationality" class="form-select">
                                    <option value="">اختر الجنسية</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->country_code }}">{{ $country->country_name.'('.$country->country_code.')' }}</option>
                                    @endforeach
                                </select>
                                @error('current_nationality') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="country_of_birth">الجنسية الأصلية</label>
                                <select name="original_nationality" wire:model="original_nationality" class="form-select">
                                    <option value="">اختر الجنسية</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->country_code }}">{{ $country->country_name.'('.$country->country_code.')' }}</option>
                                    @endforeach
                                </select>
                                @error('original_nationality') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                    <label class="form-label fw-bold" for="name">تاريخ الميلاد</label>
                                    <input type="date" class="form-control" name="date_of_birth" wire:model="date_of_birth"/>
                                    @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        <p class="text-danger fw-bold mt-5">العنوان في بلد الإقامة</p>
                        <hr>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="land_mark">معلم بارز</label>
                                <input type="text" class="form-control" name="address_land_mark" wire:model="address_land_mark"/>
                                @error('address_land_mark')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             
                              <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone">شارع</label>
                                <input type="text" class="form-control" name="address_street" wire:model="address_street"/>
                                @error('address_street') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="address_area">منطقة </label>
                                <input type="text" class="form-control" name="address_area" wire:model="address_area"/>
                                @error('address_area')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="address_city">مدينة العنوان</label>
                                <input type="text" class="form-control" name="address_city" wire:model="address_city"/>
                                @error('address_city') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <p class="text-danger fw-bold mt-5">أرقام الهاتف البريد الإلكتروني</p>
                        <hr>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone_number">رقم التليفون </label>
                                <input type="text" class="form-control" name="phone_number" wire:model="phone_number"/>
                                @error('phone_number')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="alternate_phone">رقم الهاتف البديل</label>
                                <input type="text" class="form-control" name="alternate_phone" wire:model="address_city"/>
                                @error('alternate_phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="email">بريد إلكتروني</label>
                                <input type="text" class="form-control" name="email" wire:model="email"/>
                                @error('email')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <p class="text-danger fw-bold mt-5">معلومات أخرى</p>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="coming_from">قادم من البلاد</label>
                                <select name="coming_from" wire:model="coming_from" class="form-select">
                                    <option value="">اختر الجنسية</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->country_code }}">{{ $country->country_name.'('.$country->country_code.')' }}</option>
                                    @endforeach
                                </select>
                                @error('coming_from') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="coming_from">الحالة الاجتماعية</label>
                                <select name="coming_from" wire:model="coming_from" class="form-select">
                                    <option value="">الحالة الاجتماعية</option>
                                    <option value="married">Married</option>
                                    <option value="single">Single</option>
                                    <option value="divorced">Divorced</option>
                                </select>
                                @error('coming_from') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="coming_from">جنس</label>
                                <select name="coming_from" wire:model="coming_from" class="form-select">
                                    <option value="">اختر الجنس</option>
                                    <option value="Male">ذكر</option>
                                    <option value="Female">أنثى</option>
                                    <option value="transgender">المتحولين جنسيا</option>
                                </select>
                                @error('coming_from') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">مهنة</label>
                                <input type="text" class="form-control" name="proffession" wire:model="proffession"/>
                                @error('proffession') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">صورة الوجه</label>
                                <input type="file" class="form-control" name="face_photo" wire:model="face_photo"/>
                                @error('face_photo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            <div class="form-group my-3 text-center">
                <a class="btn buttom-effect" href="{{ route('visa-application.travel') }}">تقديم الطلب</a>
            </div> 
            </div>
        </form>
    </div>
</div>

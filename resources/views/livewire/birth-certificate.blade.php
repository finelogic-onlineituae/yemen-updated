<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="form-div align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('birth-certificate.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="birthcertificate-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width  bg-ash">
               <div class="card text-start my-2">

                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">معلومات جواز السفر</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_arabic">الاسم الكامل (كما هو مذكور في جواز السفر)</label>
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
                                        <label class="form-label fw-bold" for="country_of_birth">بلد الميلاد</label>
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
                                        <label class="form-label fw-bold" for="profession">مدينة الميلاد</label>
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
                                        <label class="form-label fw-bold" for="name">تاريخ انتهاء الصلاحية</label>
                                        <input type="date" class="form-control" name="expire_on" wire:model="expire_on"/>
                                        @error('expire_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                 <div class="row">
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="issued_by">سلطة الإصدار</label>
                                        <select class="form-select" name="passport_center" wire:model="passport_center">
                                            <option>Issuing Authority</option>
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

                   {{--  <div class="card-header">
                        معلومات الأب
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <label class="form-label fw-bold" for="fathers_name">اسم</label>
                                <input type="text" class="form-control" name="fathers_name" wire:model="fathers_name"/>
                                @error('fathers_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="fathers_issued_on">تاريخ الإصدار</label>
                                <input type="date" class="form-control" name="fathers_issued_on" id="fathers_issued_on" wire:model="fathers_issued_on"/>
                                @error('fathers_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="fathers_passport_number">رقم جواز سفر </label>
                                <input type="text" class="form-control" id="passportInput-1" maxlength="8" name="fathers_passport_number"  wire:model="fathers_passport_number"/>
                                <small id="passportError-1" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                @error('fathers_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div> --}}
                            {{-- <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="fathers_nationality">Nationality</label>
                                <input type="text" class="form-control" name="fathers_nationality"  wire:model="fathers_nationality"/>
                                @error('fathers_nationality') <span class="text-danger">{{ $message }}</span> @enderror
                            </div> --}}
                        {{-- <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="fathers_nationality">الجنسية</label>
                                <select class="form-select" name="fathers_nationality" wire:model="fathers_nationality">
                                    <option>الجنسية</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                                @error('fathers_nationality')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="fathers_passport">جواز (ملف بي دي إف )</label>
                                <input type="file" class="form-control" name="fathers_passport" wire:model="fathers_passport" />
                                @error('fathers_passport')<span class="text-danger">{{ $message }}</span> @enderror
        
                                @if($existing_fathers_passport && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-fathers_passport')">عرض جواز السفر</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-fathers_passport" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-fathers_passport')">&times;</span>
                                                <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($existing_fathers_passport) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div>
                        </div> 
                    </div>
          --}}
                {{-- <div class="card text-start my-2">

                    <div class="card-header">
                        معلومات الأم
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <label class="form-label fw-bold" for="mothers_name">اسم</label>
                                <input type="text" class="form-control" name="mothers_name" wire:model="mothers_name"/>
                                @error('mothers_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="mothers_issued_on">تاريخ الإصدار</label>
                                <input type="date" class="form-control" name="mothers_issued_on" id="mothers_issued_on" wire:model="mothers_issued_on"/>
                                @error('mothers_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="mothers_passport_number">رقم جواز سفر </label>
                                <input type="text" class="form-control" id="passportInput-2" maxlength="8" name="mothers_passport_number"  wire:model="mothers_passport_number"/>
                                <small id="passportError-2" class="text-danger d-none"> Please enter a valid Passport Number</small>

                                @error('mothers_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                           
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="mothers_nationality">الجنسية</label>
                                <select class="form-select" name="mothers_nationality" wire:model="mothers_nationality">
                                    <option>الجنسية</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                                @error('mothers_nationality')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="mothers_passport">جواز (ملف بي دي إف )</label>
                                <input type="file" class="form-control" name="mothers_passport" wire:model="mothers_passport" />
                                @error('mothers_passport')<span class="text-danger">{{ $message }}</span> @enderror
        
                                @if($existing_mothers_passport && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-mothers_passport')">عرض جواز السفر</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-mothers_passport" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-mothers_passport')">&times;</span>
                                                <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($existing_mothers_passport) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div>
                        </div>
                    </div>
                </div>
             
            --}}
            <div class="card">
                <div class="card-header">معلومات الوالدين</div>
                    <div class="card-body text-start">
                        <div class="row">
                           <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="profession">اسم الأم</label>
                                <input type="text" class="form-control" name="mother_name" wire:model="mother_name"/>
                                @error('mother_name')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="profession">جنسية الأم</label>
                                <select class="form-select" name="mother_nationality" wire:model="mother_nationality">
                                    <option value="">Choose a Country</option>
                                    @forelse ($countries as $country)
                                        <option value="{{ $country->id }}" @selected($country->country_code == 'YE')>{{ $country->country_name }}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                                @error('mother_nationality')<span class="text-danger">{{ $message }}</span> @enderror
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
                                <label class="form-label fw-bold" for="attachment"> الهوية الإماراتية (ملف بي دي إف  ,jpg, png, jpeg) (Optional)</label>
                                <input type="file" class="form-control" wire:model="attachment" name="attachment" />
                                @error('attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>   
                        </div>    
                        
                    </div>
                </div>
            <div class="form-group my-3 text-center">
                <button class="btn buttom-effect ">تقديم الطلب</button>
            </div>
            </div>
        </form>
    </div>
</div>

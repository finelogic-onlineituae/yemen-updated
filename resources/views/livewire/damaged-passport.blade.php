<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
         <div id="renew-form-wrapper" data-existing-photo="{{ $existing_photo ? '1' : '0' }}"></div>
        <form action="{{ route('renew-passport-above.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="renew-passport-above-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
           
                <div class="card-body">
                        <div class="card">
                            <div class="card-header">معلومات جواز السفر</div>
                            <div class="card-body text-start">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_arabic">الاسم الكامل (كما هو مذكور في جواز السفر)</label>
                                        <input type="text" class="form-control" name="name_arabic" wire:model="surname_arabic"/>
                                        @error('name_arabic')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_english">الاسم الكامل باللغة الإنجليزية كما هو الحال في جواز السفر</label>
                                        <input type="text" class="form-control" name="name_english" wire:model="name_english"/>
                                        @error('name_english')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                    
                                        <label class="form-label fw-bold"  for="passport_number">رقم جواز السفر</label>
                                        
                                        <input type="text" id="passportInput-" maxlength="8" class="form-control" name="passport_number" wire:model="passport_number" />
                                        <small id="passportError-" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                        @error('passport_number') <span class="text-danger">{{ $message }}</span> @enderror
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
                                     <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="cause_of_damage">سبب الضرر</label>
                                        <textarea class="form-control"></textarea>
                                        @error('cause_of_damage')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                {{-- <div class="card text-start my-2">
                    <div class="card-body">
                        <div class="row">
                           <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="profession">مهنة</label>
                                <input type="text" class="form-control" name="profession" wire:model="profession"/>
                                @error('profession')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="emirates_id">رقم الهوية الإماراتية <i>(optional)</i></label>
                                <input type="text" class="form-control" id="emiratesIdInput-"  maxlength="17" name="emirates_id" wire:model="emirates_id"/>
                                <small id="emiratesIdError-" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                                @error('emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div> 
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="date_of_birth">تاريخ الميلاد</label>
                                <input type="date" class="form-control" name="date_of_birth" wire:model="date_of_birth"/>
                                @error('date_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                           
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="place_of_birth">مكان الميلاد </label>
                                <input type="text" class="form-control" name="place_of_birth" wire:model="place_of_birth"/>
                                @error('place_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="left_thumb">إصبع الإبهام الأيسر (ملف بي دي إف ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="left_thumb" wire:model="left_thumb" />
                                @error('left_thumb')<span class="text-danger">{{ $message }}</span> @enderror

                                @if($existing_left_thumb && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-left_thumb')">إصبع الإبهام الأيسر  </a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-left_thumb" class="modal">
                                
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-left_thumb')">&times;</span>
                                                @if(Str::of($existing_left_thumb)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                                    <img src="{{ generate_signed_storage_url($existing_left_thumb) }}"
                                                        alt="Preview"
                                                        style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                                @else
                                                <iframe id="pdfViewer-verify-left_thumb" src="{{ generate_signed_storage_url($existing_left_thumb) }}"></iframe>
                                                     
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div> 

                        </div> --}}
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
                    <div class="card-header">أقارب في الإمارات / الجمهورية اليمنية</div>
                    <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Republic of Yemen
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                UAE
                                            </label>
                                        </div>
                                        @error('relative1_name')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="relative1_name">الاسم الكامل للقريب </label>
                                        <input type="text" class="form-control" name="relative1_name" wire:model="relative1_name"/>
                                        @error('relative1_name')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="relative1_phone">علاقة</label>
                                        <input type="text" class="form-control" name="relative1_phone" wire:model="relative1_phone"/>
                                        @error('relative1_phone')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="relative1_address">العنوان النسبي </label>
                                        <input type="text" class="form-control" name="relative1_address" wire:model="relative1_address"/>
                                        @error('relative1_address')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="relative1_phone">رقم الهاتف النسبي </label>
                                        <input type="text" class="form-control" name="relative1_phone" wire:model="relative1_phone"/>
                                        @error('relative1_phone')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                        </div>
                </div>
          

                 <div class="card text-start my-2">
                    <div class="card-header">معلومات التسليم</div>
                    <div class="card-body">
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
                                <label class="form-label fw-bold" for="land_mark">منطقة </label>
                                <input type="text" class="form-control" name="address_area" wire:model="address_area"/>
                                @error('address_area')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone">إمارة</label>
                                <input type="text" class="form-control" name="address_emirate" wire:model="address_emirate"/>
                                @error('address_emirate') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="phone">رقم التليفون</label>
                                    <input type="text" class="form-control" name="phone_number" wire:model="phone_number"/>
                                    @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
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
                        </div>    
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="photo">صورة (jpg, png, jpeg) (200x200)</label>
                                <input type="file" class="form-control item-photo" id="photoInput"  accept="image/*">
                                @error('croppedPhoto')<span class="text-danger">{{ $message }}</span> @enderror

                                <!-- Cropper Preview Modal -->
                                <div id="crop-modal" style="display:none;">
                                    <div id="croppie-container"></div>
                                    <button type="button" id="cropImageBtn" class="btn btn-success mt-2">Crop & Upload</button>
                                </div>
                                <textarea wire:model.defer="croppedPhoto"  name="photo"  id="croppedImageInput" style="display:none;"></textarea>
                            
                                <!-- Show preview after crop -->
                               
                                <div class="mt-3"  id="cropped-div" @if(!$croppedPhoto) style="display: none" @endif>
                                    <img src="{{ $croppedPhoto }}"  id="cropped-image" width="150" height="150" class="border rounded" />
                                </div>
                                @if ($existing_photo && session()->has('edit_application') && !$croppedPhoto)
                                    <div class="form-group mb-2 mt-2" id="existing-image">
                                        <img src="{{ generate_signed_storage_url($existing_photo) }}" width="150" height="150" class="border img-fluid rounded" />
                                    </div>
                                @endif
                            </div>
                        </div>       
                    </div>
                </div>
                       
                           
                            {{-- <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="id_card">بطاقة الهوية(ملف بي دي إف )</label>
                                <input type="file" class="form-control" name="id_card" wire:model="id_card" />
                                @error('id_card')<span class="text-danger">{{ $message }}</span> @enderror

                                @if($existing_id_card && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-id_card')">بطاقة الهوية  </a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-id_card" class="modal">
                                
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-id_card')">&times;</span>
                                                <iframe id="pdfViewer-verify-id_card" src="{{ generate_signed_storage_url($existing_id_card) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div> --}}
                          
                            {{-- <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="address">عنوان التسليم </label>
                                    <textarea type="text" style="height: auto;" class="form-control" rows="4" name="address" wire:model="address" ></textarea>
                                   
                                    @error('address')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div> --}}
                            
                    </div>
                </div>
           

           
              

            <div class="form-group my-3 text-center">
                <button class="btn buttom-effect">تقديم الطلب</button>
            </div>
            </div>
        </form>
    </div>
</div>

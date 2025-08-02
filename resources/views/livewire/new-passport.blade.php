<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
         <div id="renew-form-wrapper" data-existing-photo="{{ $existing_photo ? '1' : '0' }}"></div>
        <form action="{{ route('new-passport.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="new-passport-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                <div class="card text-start my-2">

                    <div class="card-body">
                        <div class="row">
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name_arabic">الاسم باللغة العربية حسب شهادة الميلاد</label>
                                <input type="text" class="form-control" name="name_arabic" wire:model="name_arabic"/>
                                @error('name_arabic')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name">الاسم باللغة الإنجليزية كما هو الحال في شهادة الميلاد</label>
                                <input type="text" class="form-control" name="name" wire:model="name"/>
                                @error('name')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                           <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="dob">تاريخ الميلاد</label>
                                <input type="text" class="form-control" name="dob" wire:model="dob"/>
                                @error('dob')<span class="text-danger">{{ $message }}</span> @enderror
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
                        <div class="card">
                            <div class="card-header">المرفقات</div>
                            <div class="card-body">
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
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="birth_certificate">شهادة الميلاد  (ملف بي دي إف )</label>
                                    <input type="file" class="form-control" name="birth_certificate" wire:model="birth_certificate" />
                                    @error('birth_certificate')<span class="text-danger">{{ $message }}</span> @enderror

                                    @if($existing_birth_certificate && session()->has('edit_application'))
                                    <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-birth_certificate')">شهادة الميلاد </a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-verify-birth_certificate" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-verify-birth_certificate')">&times;</span>
                                                    <iframe id="pdfViewer-verify-birth_certificate" src="{{ generate_signed_storage_url($existing_birth_certificate) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                    @endif  
                                </div>
                         
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="marriage_certificate_parents">شهادة زواج الوالدين (ملف بي دي إف )</label>
                                    <input type="file" class="form-control" name="marriage_certificate_parents" wire:model="marriage_certificate_parents" />
                                    @error('marriage_certificate_parents')<span class="text-danger">{{ $message }}</span> @enderror

                                    @if($existing_marriage_certificate_parents && session()->has('edit_application'))
                                    <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-marriage_certificate_parents')">شهادة زواج الوالدين</a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-verify-marriage_certificate_parents" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-verify-marriage_certificate_parents')">&times;</span>
                                                    <iframe id="pdfViewer-verify-marriage_certificate_parents" src="{{ generate_signed_storage_url($existing_marriage_certificate_parents) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                    @endif  
                                </div>
                                
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="mother_passport">جواز سفر الأم (ملف بي دي إف )</label>
                                    <input type="file" class="form-control" name="mother_passport" wire:model="mother_passport" />
                                    @error('mother_passport')<span class="text-danger">{{ $message }}</span> @enderror

                                    @if($existing_mother_passport && session()->has('edit_application'))
                                    <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-mother_passport')">جواز سفر الأم</a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-verify-mother_passport" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-verify-mother_passport')">&times;</span>
                                                    <iframe id="pdfViewer-verify-mother_passport" src="{{ generate_signed_storage_url($existing_mother_passport) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                    @endif  
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="father_passport">جواز سفر الأب (ملف بي دي إف )</label>
                                    <input type="file" class="form-control" name="father_passport" wire:model="father_passport" />
                                    @error('father_passport')<span class="text-danger">{{ $message }}</span> @enderror

                                    @if($existing_father_passport && session()->has('edit_application'))
                                    <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-father_passport')">جواز سفر الأب</a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-verify-father_passport" class="modal">
                                    
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-verify-father_passport')">&times;</span>
                                                    <iframe id="pdfViewer-verify-father_passport" src="{{ generate_signed_storage_url($existing_father_passport) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                    @endif  
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="mother_id_card">بطاقة هوية الأم (ملف بي دي إف )</label>
                                    <input type="file" class="form-control" name="mother_id_card" wire:model="mother_id_card" />
                                    @error('mother_id_card')<span class="text-danger">{{ $message }}</span> @enderror

                                    @if($existing_mother_id_card && session()->has('edit_application'))
                                    <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-mother_id_card')">بطاقة هوية الأم </a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-verify-mother_id_card" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-verify-mother_id_card')">&times;</span>
                                                    <iframe id="pdfViewer-verify-mother_id_card" src="{{ generate_signed_storage_url($existing_mother_id_card) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                    @endif  
                                </div>
                            
                            </div>

                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="father_id_card">بطاقة هوية الأب (ملف بي دي إف )</label>
                                    <input type="file" class="form-control" name="father_id_card" wire:model="father_id_card" />
                                    @error('father_id_card')<span class="text-danger">{{ $message }}</span> @enderror

                                    @if($existing_father_id_card && session()->has('edit_application'))
                                    <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-father_id_card')">بطاقة هوية الأب</a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-verify-father_id_card" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-verify-father_id_card')">&times;</span>
                                                    <iframe id="pdfViewer-verify-father_id_card" src="{{ generate_signed_storage_url($existing_father_id_card) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                    @endif  
                                </div>
                            
                                
                            </div>
                         
                            
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

            <div class="form-group my-3 text-center">
                <button class="btn buttom-effect">تقديم الطلب</button>
            </div>
            </div>
        </form>
    </div>
</div>

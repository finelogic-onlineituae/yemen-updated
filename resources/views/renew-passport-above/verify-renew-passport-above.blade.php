<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center" >تجديد جواز السفر لمن هم فوق سن 18 عامًا</h2>
    
<div>
    
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
         <form action="@if(request()->has('edit')) {{ route('renew-passport-above.store', ['application' => $application->id]) }} @else {{ route('application.confirm', ['application_id' => $application->id]) }}  @endif" enctype="multipart/form-data" method="POST" id="renew-passport-above-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                <div class="card text-start my-2">
                     <div class="card-body">
                        <div class="card">
                            <div class="card-header">معلومات جواز السفر</div>
                            <div class="card-body">
                                <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <div @class(["d-none" => !request('edit'), "mb-2"])>
                                    <label class="form-label fw-bold" for="photo">صورة (jpg, png, jpeg) (200x200)</label>
                                    <input type="file" class="form-control item-photo" id="imageInput"  @if(!request('edit')) disabled @endif  accept="image/*">
                                    @error('croppedPhoto')<span class="text-danger">{{ $message }}</span> @enderror

                                    <!-- Cropper Preview Modal -->
                                    <div class="d-flex mt-2">
                                        <div style="width: 200px; height: 200px;" id="crop-platform" style="display: none;">
                                            <img id="previewImage" style="max-width: 100%;">
                                            <p>Crop Your Photo Here!</p>
                                        </div>
                                        <div>
                                            <button type="button" class=" mx-2 btn btn-info" id="cropButton" style="display: none;">Crop</button>
                                        </div>
                                        <br><br>
                                    </div>
                                </div>
                                <img src="/storage/{{ $application->formable->photo }}" width="200" class="img-thumbnail">
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12" id="preview-crop" style="display: none;">
                                    <!-- Show Cropped Result -->
                                    <p><strong>Cropped Preview:</strong></p>
                                    <img id="croppedPreview" width="200" height="200" style="border: 1px solid #aaa;">
                                    <br><br>
                                    <input type="hidden" name="cropped_image" id="croppedImage">
                            </div>
                            
                        </div>    
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_arabic">الاسم باللغة العربية بحسب جواز السفر</label>
                                        <input type="text" class="form-control" name="name_arabic" value="{{ $application->formable->name_arabic }}"  @if(!request('edit')) disabled @endif   required/>
                                        @error('name_arabic')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_english">الاسم الكامل باللغة الإنجليزية كما هو الحال في جواز السفر</label>
                                        <input type="text" class="form-control" name="name_english" value="{{ $application->formable->name }}"  @if(!request('edit')) disabled @endif  required/>
                                        @error('name_english')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    
                                        <label class="form-label fw-bold"  for="passport_number">رقم جواز السفر</label>
                                        
                                        <input type="text" id="passportInput-" maxlength="8" class="form-control" name="passport_number" value="{{ $application->formable->passport->passport_number }}"  @if(!request('edit')) disabled @endif   required/>
                                        <small id="passportError-" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                        @error('passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                     <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">تاريخ الميلاد</label>
                                        <input type="date" class="form-control" name="date_of_birth" value="{{ $application->formable->date_of_birth }}"  @if(!request('edit')) disabled @endif  required/>
                                        @error('date_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="country_of_birth">(المحافظة) محل الميلاد</label>
                                        <select class="form-select" name="country_of_birth"  @if(!request('edit')) disabled @endif  required>
                                            <option value="">Choose a Country</option>
                                            @forelse ($countries as $country)
                                                <option value="{{ $country->id }}" @selected($application->formable->country_of_birth == $country->id)>{{ $country->country_name }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                        @error('country_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="city_of_birth">(المحافظة - المدينة) محل الميلاد</label>
                                        <input type="text" class="form-control" name="city_of_birth" value="{{ $application->formable->city_of_birth }}"  @if(!request('edit')) disabled @endif  required/>
                                        @error('city_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">مهنة</label>
                                        <input type="text" class="form-control" name="profession" value="{{ $application->formable->profession }}"  @if(!request('edit')) disabled @endif   required/>
                                        @error('profession')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">جنس</label>
                                        <select class="form-select" name="gender"  @if(!request('edit')) disabled @endif  required>
                                            <option value="">Choose Gender</option>
                                            <option value="Male" @selected( $application->formable->gender == 'Male')>Male</option>
                                            <option value="Female" @selected( $application->formable->gender == 'Female')>Female</option>
                                        </select>
                                        @error('gender')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="issued_on">تاريخ الإصدار</label>
                                        <input type="date" class="form-control" name="issued_on" value="{{ $application->formable->passport->issued_on }}"  @if(!request('edit')) disabled @endif  required/>
                                        @error('issued_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="expire_on">تاريخ الانتهاء</label>
                                        <input type="date" class="form-control" name="expire_on"  value="{{ $application->formable->passport->expires_on }}"  @if(!request('edit')) disabled @endif   required/>
                                        @error('expire_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="issued_by">سلطة الإصدار</label>
                                        <select class="form-select" name="passport_center"  @if(!request('edit')) disabled @endif  required>
                                            <option>جهة الإصدار</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}" @selected($center->id == $application->formable->passport->passport_center_id)>{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                       
                    <div class="card">
                            <div class="card-header">معلومات الأم</div>
                            <div class="card-body">
                                <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">اسم الأم</label>
                                        <input type="text" class="form-control" name="mother_name"  @if(!request('edit')) disabled @endif  value="{{ $application->formable->mother_name }}" required/>
                                        @error('mother_name')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">جنسية الأم</label>
                                        <select class="form-select" name="mother_nationality"  @if(!request('edit')) disabled @endif  required>
                                            <option value="">Choose a Country</option>
                                            @forelse ($countries as $country)
                                                <option value="{{ $country->id }}" @selected($country->id == $application->formable->mother_nationality)>{{ $country->country_name }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                        @error('mother_nationality')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            
                                <div class="row">
                                {{-- <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="marital_status">الحالة الاجتماعية</label>
                                        <select class="form-select" name="marital_status" wire:model="marital_status">
                                            <option value="">Choose an Option</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                        @error('marital_status')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div> --}}
                        </div>
                </div>
                <div class="card text-start my-2">
                    <div class="card-header">المرفقات</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <div @class(["d-none" => !request('edit'), "mb-2"])>
                                <label class="form-label fw-bold" for="passport_attachment"> جواز (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="passport_attachment"  @if(!request('edit')) disabled @endif/>
                                 @error('passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                           <div>
                            <a onclick="openModal('passport')" class="btn btn-dark">View Passport</a>
                            <!-- Modal -->
                                    <div id="passport" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('passport')">&times;</span>
                                            <iframe id="passport_iframe" src="/storage/{{ $application->formable->passport->attachment }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                            </div>
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <div @class(["d-none" => !request('edit'), "mb-2"])>
                                <label class="form-label fw-bold" for="emirate_id_attachment"> الهوية الإماراتية (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="emirate_id_attachment"  @if(!request('edit')) disabled @endif  />
                                @error('emirate_id_attachment')<span class="text-danger">{{ $message }}</span> @enderror
                                 </div>
                           <div>
                            <a onclick="openModal('emirate_id')" class="btn btn-dark">View Emirate ID</a>
                            <!-- Modal -->
                                    <div id="emirate_id" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('emirate_id')">&times;</span>
                                            <iframe id="emirate_id_iframe" src="/storage/{{ $application->formable->emirates_id_attachment }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                            </div>
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
                                            <input class="form-check-input" type="radio" name="relative_country" id="flexRadioDefault1" value="Yemen"  @checked($application->formable->relative_country == 'Yemen')>
                                            <label class="form-check-label" for="relative_country">
                                                Republic of Yemen
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="relative_country" id="flexRadioDefault2" value="UAE" @checked($application->formable->relative_country == 'UAE')>
                                            <label class="form-check-label" for="relative_country">
                                                UAE
                                            </label>
                                        </div>
                                        @error('relative_country')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="relative_name">الاسم الكامل للقريب </label>
                                        <input type="text" class="form-control" name="relative_name" value="{{ $application->formable->relative_name }}"  @if(!request('edit')) disabled @endif   required/>
                                        @error('relative_name')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="relative_relation">علاقة</label>
                                        <input type="text" class="form-control" name="relative_relation" value="{{ $application->formable->relative_relationship }}"  @if(!request('edit')) disabled @endif   required/>
                                        @error('relative_relation')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="relative_address">العنوان النسبي </label>
                                        <input type="text" class="form-control" name="relative_address" value="{{ $application->formable->relative_address }}"  @if(!request('edit')) disabled @endif   required/>
                                        @error('relative_address')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="relative_phone">رقم الهاتف النسبي </label>
                                        <input type="text" class="form-control" name="relative_phone" value="{{ $application->formable->relative_phone }}"  @if(!request('edit')) disabled @endif   required/>
                                        @error('relative_phone')<span class="text-danger">{{ $message }}</span> @enderror
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
                                <input type="text" class="form-control" name="address_land_mark" value="{{ $application->formable->land_mark }}"  @if(!request('edit')) disabled @endif   required/>
                                @error('address_land_mark')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             
                              <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="address_street">الشارع</label>
                                <input type="text" class="form-control" name="address_street" value="kjhkj{{ $application->formable->street }}"  @if(!request('edit')) disabled @endif   required/>
                                @error('address_street') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="address_area">المنطقه</label>
                                <input type="text" class="form-control" name="address_area" value="{{ $application->formable->area }}"   @if(!request('edit')) disabled @endif   required/>
                                @error('address_area')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone">المنطقة - الإمارة</label>
                                <input type="text" class="form-control" name="address_emirate" value="{{ $application->formable->emirate }}"  @if(!request('edit')) disabled @endif   required/>
                                @error('address_emirate') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="phone">رقم التليفون</label>
                                    <input type="text" class="form-control" name="phone_number" value="{{ $application->formable->phone_number }}"  @if(!request('edit')) disabled @endif   required/>
                                    @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="alt_phone_number">رقم التليفون</label>
                                    <input type="text" class="form-control" name="alt_phone_number" value="{{ $application->formable->alt_phone_number }}"  @if(!request('edit')) disabled @endif   required/>
                                    @error('alt_phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                    </div>
                </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group my-3 text-center">
                @if(request()->has('edit'))
                    <button class="btn buttom-effect" id="submitBtn" >تغييرات التحديث</button>
                @else
                    <button class="btn buttom-effect" id="submitBtn" >تأكيد التطبيق</button>
                @endif
                <a class="btn btn-dark" id="submitBtn" href="{{ route('renew-passport-above.verify', ['application_id' => $application->id, 'edit'=> true]) }}">قم بإجراء التغييرات</a>
            </div>
            </div>
            </div>
        </form>
    </div>
</div>
</x-app-layout>

<script>
        let cropper;
        const imageInput = document.getElementById('imageInput');
        const previewImage = document.getElementById('previewImage');
        const cropButton = document.getElementById('cropButton');
        const croppedPreview = document.getElementById('croppedPreview');
        const croppedImageInput = document.getElementById('croppedImage');
        const cropPlatform = document.getElementById('crop-platform');
        const cropPreview = document.getElementById('preview-crop');
        const submitBtn = document.getElementById('submitBtn');

        imageInput.addEventListener('change', function (e) {
            cropPlatform.style.display = 'block';
            cropButton.style.display = 'block';
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (event) {
                previewImage.src = event.target.result;

                if (cropper) cropper.destroy();

                cropper = new Cropper(previewImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1
                });
            };
            reader.readAsDataURL(file);
        });

        cropButton.addEventListener('click', function () {
            if (!cropper) return;

            const canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200
            });

            const dataURL = canvas.toDataURL('image/jpeg');

            // Set preview and hidden input
            croppedPreview.src = dataURL;
            croppedImageInput.value = dataURL;
            cropPreview.style.display="block";
            submitBtn.disabled  = false;
        });
    </script>
<script>
    const form = document.querySelector('form');

    form.addEventListener('submit', function (e) {
        const croppedImage = croppedImageInput.value;

        if (!croppedImage || !croppedImage.startsWith("data:image")) {
            e.preventDefault(); // prevent form from submitting
            alert("Please crop the image before submitting.");
        }
    });
</script>


<script>
// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];
  // Set max attribute to today's date
  document.getElementById('issued_on').setAttribute('max', today);

</script>


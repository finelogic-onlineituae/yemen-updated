<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center" >قم بمراجعة طلبك</h2>
    
<div>
    
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
         <form action="@if(request()->has('edit')) {{ route('new-passport.store', ['application' => $application->id]) }} @else {{ route('application.confirm', ['application_id' => $application->id]) }}  @endif" enctype="multipart/form-data" method="POST" id="renew-passport-above-form" class="w-100 align-items-center text-center d-flex justify-content-center">
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
                                        <label class="form-label fw-bold" for="name_arabic">الاسم الكامل (كما هو مذكور في جواز السفر)</label>
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
                                        <label class="form-label fw-bold" for="name">تاريخ الميلاد</label>
                                        <input type="date" class="form-control" name="date_of_birth" value="{{ $application->formable->date_of_birth }}"  @if(!request('edit')) disabled @endif  required/>
                                        @error('date_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="country_of_birth">بلد الميلاد</label>
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
                                        <label class="form-label fw-bold" for="city_of_birth">مدينة الميلاد</label>
                                        <input type="text" class="form-control" name="city_of_birth" value="{{ $application->formable->city_of_birth }}"  @if(!request('edit')) disabled @endif  required/>
                                        @error('city_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
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
                            
                                
                </div>
                <div class="card text-start my-2">
                    <div class="card-header">المرفقات</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <div @class(["d-none" => !request('edit'), "mb-2"])>
                                <label class="form-label fw-bold" for="birth_certificate"> جواز (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="birth_certificate"  @if(!request('edit')) disabled @endif/>
                                 @error('birth_certificate') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                           <div>
                            <a onclick="openModal('birth_certificate')" class="btn btn-dark">View Birth Certificate</a>
                            <!-- Modal -->
                                    <div id="birth_certificate" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('birth_certificate')">&times;</span>
                                            <iframe id="passport_iframe" src="/storage/{{ $application->formable->birth_certificate }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                            </div>
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <div @class(["d-none" => !request('edit'), "mb-2"])>
                                <label class="form-label fw-bold" for="marriage_certificate"> الهوية الإماراتية (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="marriage_certificate"  @if(!request('edit')) disabled @endif  />
                                @error('marriage_certificate')<span class="text-danger">{{ $message }}</span> @enderror
                                 </div>
                           <div>
                            <a onclick="openModal('marriage_certificate')" class="btn btn-dark">View Parents' Marriage Certificate</a>
                            <!-- Modal -->
                                    <div id="marriage_certificate" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('marriage_certificate')">&times;</span>
                                            <iframe id="emirate_id_iframe" src="/storage/{{ $application->formable->marriage_certificate_parents }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                            </div>
                            </div>   
                        </div>    
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <div @class(["d-none" => !request('edit'), "mb-2"])>
                                <label class="form-label fw-bold" for="father_passport"> جواز (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="father_passport"  @if(!request('edit')) disabled @endif/>
                                 @error('father_passport') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                           <div>
                            <a onclick="openModal('father_passport')" class="btn btn-dark">View Father's Passport</a>
                            <!-- Modal -->
                                    <div id="father_passport" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('father_passport')">&times;</span>
                                            <iframe id="passport_iframe" src="/storage/{{ $application->formable->father_passport }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                            </div>
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <div @class(["d-none" => !request('edit'), "mb-2"])>
                                <label class="form-label fw-bold" for="mother_passport"> الهوية الإماراتية (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="mother_passport"  @if(!request('edit')) disabled @endif  />
                                @error('mother_passport')<span class="text-danger">{{ $message }}</span> @enderror
                                 </div>
                           <div>
                            <a onclick="openModal('mother_passport')" class="btn btn-dark">View Mother's Passport</a>
                            <!-- Modal -->
                                    <div id="mother_passport" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('mother_passport')">&times;</span>
                                            <iframe id="emirate_id_iframe" src="/storage/{{ $application->formable->mother_passport }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                            </div>
                            </div>   
                        </div> 
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <div @class(["d-none" => !request('edit'), "mb-2"])>
                                <label class="form-label fw-bold" for="father_id_card"> جواز (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="father_id_card"  @if(!request('edit')) disabled @endif/>
                                 @error('father_id_card') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                           <div>
                            <a onclick="openModal('father_id_card')" class="btn btn-dark">View Father Emirate ID</a>
                            <!-- Modal -->
                                    <div id="father_id_card" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('father_id_card')">&times;</span>
                                            <iframe id="passport_iframe" src="/storage/{{ $application->formable->father_id_card }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                            </div>
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <div @class(["d-none" => !request('edit'), "mb-2"])>
                                <label class="form-label fw-bold" for="mother_id_card"> الهوية الإماراتية (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="mother_id_card"  @if(!request('edit')) disabled @endif  />
                                @error('mother_id_card')<span class="text-danger">{{ $message }}</span> @enderror
                                 </div>
                           <div>
                            <a onclick="openModal('mother_id_card')" class="btn btn-dark">View Mother Emirate ID</a>
                            <!-- Modal -->
                                    <div id="mother_id_card" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('mother_id_card')">&times;</span>
                                            <iframe id="emirate_id_iframe" src="/storage/{{ $application->formable->mother_id_card }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
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
                                <label class="form-label fw-bold" for="address_landmark">معلم بارز</label>
                                <input type="text" class="form-control" name="address_landmark" value="{{ $application->formable->address_landmark }}"  @if(!request('edit')) disabled @endif   required/>
                                @error('address_landmark')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             
                              <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="address_street">شارع</label>
                                <input type="text" class="form-control" name="address_street" value="kjhkj{{ $application->formable->address_street }}"  @if(!request('edit')) disabled @endif   required/>
                                @error('address_street') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="land_mark">منطقة </label>
                                <input type="text" class="form-control" name="address_area" value="{{ $application->formable->address_area }}"   @if(!request('edit')) disabled @endif   required/>
                                @error('address_area')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone">إمارة</label>
                                <input type="text" class="form-control" name="address_emirate" value="{{ $application->formable->address_emirate }}"  @if(!request('edit')) disabled @endif   required/>
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
                <a class="btn btn-dark" id="submitBtn" href="{{ route('new-passport.verify', ['application_id' => $application->id, 'edit'=> true]) }}">قم بإجراء التغييرات</a>
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


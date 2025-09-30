<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h3 class="text-success w-100 text-center">لإصدار جواز سفر للمولود الجديد، يرجى تعبئة جميع الحقول الإلزامية لإتمام الطلب</h3>
   <div>
    
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
         <form action="{{ route('new-passport.store') }}" enctype="multipart/form-data" method="POST" id="renew-passport-above-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                <div class="card text-start my-2">
                     <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                           {{--  <div class="card-header">المعلومات الأساسية</div> --}}
                            <div class="card-body">
                                <div class="row">
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name_arabic">الاسم باللغة العربية حسب شهادة الميلاد</label>
                                <input type="text" class="form-control" name="name_arabic"  value="{{ old('name_arabic') }}" required/>
                                @error('name_arabic')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name_english">الاسم باللغة الإنجليزية حسب شهادة الميلاد</label>
                                <input type="text" class="form-control" name="name_english" value="{{ old('name_english') }}" required/>
                                @error('name')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                           <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="dob">تاريخ الميلاد</label>
                                <input type="date" class="form-control" min="1900-01-01" max="2099-12-31" name="date_of_birth" value="{{ old('date_of_birth') }}" required/>
                                @error('date_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="country_of_birth">محل الميلاد</label>
                                <select class="form-select" name="country_of_birth" wire:model="country_of_birth" required>
                                    <option value="">Choose a Country</option>
                                    @forelse ($countries as $country)
                                        <option value="{{ $country->id }}" @selected($country->id == old('country_of_birth'))>{{ $country->country_name }}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                                @error('country_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="city_of_birth">المحافظة - المدينة</label>
                                <input type="text" class="form-control" name="city_of_birth" value="{{ old('city_of_birth') }}" required/>
                                @error('city_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                                </div>
                            </div>
                       
                    <div class="card">
                            <div class="card-header">بيانات الأم</div>
                            <div class="card-body">
                                <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">اسم الأم</label>
                                        <input type="text" class="form-control" name="mother_name" value="{{ old('mother_name') }}" required/>
                                        @error('mother_name')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">جنسية الأم</label>
                                        <select class="form-select" name="mother_nationality" required>
                                            <option value="">Choose a Country</option>
                                            @forelse ($countries as $country)
                                                <option value="{{ $country->id }}" @if(old('mother_nationality')) @selected($country->id == old('mother_nationality')) @else @selected($country->country_code == 'YE') @endif>{{ $country->country_name }}</option>
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
                                <label class="form-label fw-bold" for="photo">صورة شخصية (jpg, png, jpeg) (200x200)</label>
                                <input type="file" class="form-control item-photo" id="imageInput"  accept="image/*" required>
                                @error('croppedPhoto')<span class="text-danger">{{ $message }}</span> @enderror

                                <!-- Cropper Preview Modal -->
                                <div class="d-flex mt-2">
                                    <div style="width: 200px; height: 200px;" id="crop-platform" class="d-none">
                                        <img id="previewImage" style="max-width: 100%;">
                                        <p>Crop Your Photo Here!</p>
                                    </div>
                                    <div>
                                        <button type="button" class=" mx-2 btn btn-info" id="cropButton" style="display: none;">Crop</button>
                                    </div>
                                    <br><br>
                                </div>
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
                            <label class="form-label fw-bold" for="birth_certificate"> شهادة الميلاد (ملف بي دي إف  ,jpg, png, jpeg)</label>
                            <input type="file" class="form-control" name="birth_certificate" required/>
                            @error('birth_certificate') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="marriage_certificate"> نسخة من عقد الزواج(pdf ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="marriage_certificate" required/>
                                @error('marriage_certificate')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>   
                        </div>    
                         <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="father_passport"> جواز سفر الأب (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="father_passport" required/>
                                @error('father_passport')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>  
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="mother_passport"> جواز سفر الأم (ملف بي دي إف  ,jpg, png, jpeg)</label>
                            <input type="file" class="form-control" name="mother_passport" required/>
                            @error('mother_passport') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                              
                        </div>    
                        <div class="row">
                            
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="father_id_card"> بطاقة هوية الأب (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="father_id_card" required/>
                                @error('father_id_card')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>   
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="mother_id_card"> بطاقة هوية الأم (ملف بي دي إف  ,jpg, png, jpeg)</label>
                            <input type="file" class="form-control" name="mother_id_card" required/>
                            @error('mother_id_card') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>   
                        
                    </div>
                </div>
                
                 <div class="card text-start my-2">
                    <div class="card-header">عنوان استلام جواز السفر بعد تجديده</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="address_landmark">معلم بارز</label>
                                <input type="text" class="form-control" name="address_landmark" value="{{ old('address_landmark') }}" required/>
                                @error('address_landmark')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             
                              <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="address_street">الشارع</label>
                                <input type="text" class="form-control" name="address_street" value="{{ old('address_street') }}" required/>
                                @error('address_street') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="address_area">المنطقه</label>
                                <input type="text" class="form-control" name="address_area" value="{{ old('address_area') }}" required/>
                                @error('address_area')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone">المنطقة - الإمارة</label>
                                <input type="text" class="form-control" name="address_emirate" value="{{ old('address_emirate') }}" required/>
                                @error('address_emirate') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="phone">رقم التليفون</label>
                                    <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required/>
                                    @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="phone">رقم الهاتف البديل</label>
                                    <input type="text" class="form-control" name="alt_phone_number" value="{{ old('alt_phone_number') }}" required/>
                                    @error('alt_phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="form-group my-3 text-center">
                <button class="btn buttom-effect" id="submitBtn" disabled>تقديم الطلب</button>
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
            cropPlatform.classList.remove("d-none");
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
            submitBtn.disabled = false;
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



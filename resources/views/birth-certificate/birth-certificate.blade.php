<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h3 class="text-success w-100 text-center" >لإصدار إفادة إثبات ميلاد، يرجى تعبئة جميع الحقول الإلزامية لإتمام الطلب</h3>
    
<div>
    
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
         <form action="{{ route('birth-certificate.store') }}" enctype="multipart/form-data" method="POST" id="renew-passport-above-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                <div class="card text-start my-2">
                     <div class="card-body">
                        <div class="card">
                            <div class="card-header">بيانات جواز السفر</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_arabic">الاسم باللغة العربية بحسب جواز السفر</label>
                                        <input type="text" class="form-control" name="name_arabic" value="{{ old('name_arabic') }}" required/>
                                        @error('name_arabic')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    
                                        <label class="form-label fw-bold"  for="passport_number">رقم جواز السفر</label>
                                        
                                        <input type="text" id="passportInput-" maxlength="8" class="form-control" value="{{ old('passport_number') }}" name="passport_number" required/>
                                        <small id="passportError-" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                        @error('passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">المهنة</label>
                                        <input type="text" class="form-control" name="profession" value="{{ old('profession') }}" required/>
                                        @error('profession')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">تاريخ الميلاد</label>
                                        <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}" required/>
                                        @error('date_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="country_of_birth"> محل الميلاد </label>
                                        <select class="form-select" name="country_of_birth" required>
                                            <option value="">Choose a Country</option>
                                            @forelse ($countries as $country)
                                                <option value="{{ $country->id }}" @selected(old('country_of_birth') == $country->id)>{{ $country->country_name }}</option>
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
                                <div class="row">
                                    
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">الجنس</label>
                                        <select class="form-select" name="gender" required>
                                            <option value="">Choose Gender</option>
                                            <option value="Male" @selected(old('gender') == 'Male')>Male</option>
                                            <option value="Female" @selected(old('gender') == 'Female')>Female</option>
                                        </select>
                                        @error('gender')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="issued_by">جهة إصدار جواز السفر</label>
                                        <select class="form-select" name="passport_center" required>
                                            <option>جهة الإصدار</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}" @selected(old('passport_center') == $center->id)>{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="issued_on">تاريخ إصدار جواز السفر</label>
                                        <input type="date" class="form-control" name="issued_on" value="{{ old('issued_on') }}" required/>
                                        @error('issued_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="expire_on">تاريخ انتهاء جواز السفر</label>
                                        <input type="date" class="form-control" name="expire_on" value="{{ old('expire_on') }}" required/>
                                        @error('expire_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                            </div>
                       
                    <div class="card">
                            <div class="card-header">بيانات الوالدين</div>
                            <div class="card-body">
                                 <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="mother_name">اسم الأب الرباعي</label>
                                        <input type="text" class="form-control" name="mother_name" value="{{ old('mother_name') }}" required/>
                                        @error('mother_name')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">جنسية الأب</label>
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
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="mother_name">اسم الأم الرباعي</label>
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
                            
                              
                </div>
                <div class="card text-start my-2">
                    <div class="card-header">المرفقات</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="passport_attachment"> نسخة من جواز  السفر (pdf ,jpg, png, jpeg)</label>
                            <input type="file" class="form-control" name="passport_attachment" required/>
                            @error('passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="emirate_id_attachment"> نسخة من الهوية الاماراتيه(pdf ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="emirate_id_attachment" required/>
                                @error('emirate_id_attachment')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>   
                        </div>    
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="father_passport_attachment"> جواز سفر الأب(pdf ,jpg, png, jpeg)</label>
                            <input type="file" class="form-control" name="father_passport_attachment" required/>
                            @error('father_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="mother_passport_attachment"> جواز سفر الأم(pdf ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="mother_passport_attachment" required/>
                                @error('mother_passport_attachment')<span class="text-danger">{{ $message }}</span> @enderror
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
                <button class="btn buttom-effect" id="submitBtn">تقديم الطلب</button>
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


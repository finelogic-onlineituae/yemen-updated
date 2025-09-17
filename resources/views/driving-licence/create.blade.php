<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h3 class="text-success w-100 text-center" >لإصدار إفادة تأكيد رخصة قيادة، يرجى تعبئة جميع الحقول الإلزامية لإتمام الطلب</h3>
    
<div>
    
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
         <form action="{{ route('driving-licence.store') }}" enctype="multipart/form-data" method="POST" id="renew-passport-above-form" class="w-100 align-items-center text-center d-flex justify-content-center">
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
                                        <label class="form-label fw-bold" for="issued_by">جهة إصدار جواز السفر</label>
                                        <select class="form-select" name="passport_center" required>
                                            <option>Issuing Authority</option>
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
                    <div class="card text-start my-2">
                     <div class="card-header">
                      	بيانات رخصة القيادة
                    </div>                     
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="driving_licence_number">	رقم رخصة القيادة</label>
                                <input type="text" class="form-control" name="driving_licence_number" value="{{ old('expire_on') }}" />
                                @error('driving_licence_number')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="driving_licence_center">جهة الإصدار</label>
                                <select class="form-select" name="driving_licence_center" value="{{ old('expire_on') }}">
                                    <option>جهة الإصدار</option>
                                    @foreach ($driving_licence_centers as $center)
                                        <option value="{{ $center->id }}" @selected($center->id == old('driving_licence_center'))>{{ $center->center_name }}</option>
                                    @endforeach
                                </select>
                                @error('driving_licence_center')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="dl_issued_on">تاريخ الإصدار</label>
                                <input type="date" class="form-control" name="dl_issued_on" value="{{ old('dl_issued_on') }}" />
                                @error('dl_issued_on')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="dl_expire_on">تاريخ الانتهاء</label>
                                <input type="date" class="form-control" name="dl_expire_on" value="{{ old('dl_expire_on') }}" />
                                @error('dl_expire_on')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="issued_at">	فئة المركبة</label>
                                <select class="form-select" name="vehicle_category">
                                    <option>	فئة المركبة</option>
                                    @foreach ($vehicle_categories as $category)
                                        <option value="{{ $category->id }}" @selected($center->id == old('vehicle_category'))>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle_category')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                        </div>
                    </div>
                </div>
                    
                <div class="card text-start my-2">
                    <div class="card-header">المرفقات</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="passport_attachment">  نسخة من جواز  السفر (pdf ,jpg, png, jpeg)</label>
                            <input type="file" class="form-control" name="passport_attachment" required/>
                            @error('passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="emirate_id_attachment"> نسخة من الهوية الاماراتيه (pdf ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="emirate_id_attachment" required/>
                                @error('emirate_id_attachment')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>   
                        </div>    
                         <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="driving_licence"> نسخة من رخصة القيادة (pdf  ,jpg, png, jpeg)</label>
                            <input type="file" class="form-control" name="driving_licence" required/>
                            @error('driving_licence') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             
                        </div>    
                          
                    </div>
                </div>
                </div>
            </div>
           
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


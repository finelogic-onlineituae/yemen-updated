<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h3 class="text-success w-100 text-center">لإصدار تأشيرة، يرجى تعبئة جميع الحقول الإلزامية لإتمام الطلب</h3>
    <div>
    
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('visa-application.store') }}" enctype="multipart/form-data" method="POST" id="visa-application-form" class="w-100 align-items-center text-center d-flex justify-content-center">
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
                        <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_arabic">الاسم باللغة العربية بحسب جواز السفر</label>
                                        <input type="text" class="form-control" name="name_arabic" value="{{ old('name_arabic') }}" required/>
                                        @error('name_arabic')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_english">الاسم باللغة الانجليزية بحسب جواز السفر</label>
                                        <input type="text" class="form-control" name="name_english" value="{{ old('name_english') }}" required/>
                                        @error('name_english')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                        <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    
                                        <label class="form-label fw-bold"  for="passport_number">رقم جواز السفر</label>
                                        
                                        <input type="text" id="passportInput-" maxlength="8" class="form-control" value="{{ old('passport_number') }}" name="passport_number" required/>
                                        <small id="passportError-" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                        @error('passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                        <label class="form-label fw-bold" for="issued_by">جهة إصدار جواز السفر</label>
                                        <select name="issued_by" class="form-select" required>
                                            <option value="">Choose Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @selected(old('issued_by') == $country->id)>{{ $country->country_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('issued_by') <span class="text-danger">{{ $message }}</span> @enderror
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
                        <div class="row">
                               <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="nationality">الجنسية</label>
                                <select name="nationality" class="form-select">
                                    <option value="">اختر جنسيتك</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" @selected($country->id == old('nationality'))>{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                                @error('nationality') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                         <div class="row">
                               <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">تاريخ الميلاد</label>
                                <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}" required/>
                                @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name">مكان الميلاد</label>
                                <input type="text" class="form-control" name="place_of_birth" value="{{ old('place_of_birth') }}" required/>
                                @error('place_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">المهنة</label>
                                <input type="text" class="form-control" name="proffession" value="{{ old('proffession') }}" required/>
                                @error('proffession') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name">مكان العمل</label>
                                <input type="text" class="form-control" name="place_of_work" value="{{ old('place_of_work') }}" required/>
                                @error('place_of_work') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">العنوان الدائم</label>
                                <textarea type="date" class="form-control" rows="4" name="address" id="address">{{ old('address') }}</textarea>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="address_uae">العنوان في الإمارات العربية المتحدة</label>
                                <textarea type="date" class="form-control" rows="4" name="address_uae" id="address_uae" required> {{ old('address_uae') }}</textarea>
                                @error('address_uae') <span class="text-danger">{{ $message }}</span> @enderror
                                <input type="checkbox" class="form-check-input" name="same_address" onclick="copyAddress()" id="same_address"/>
                                <label for="same_address" class="form-label">نفس العنوان الدائم</label>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">الغرض من السفر إلى الجمهورية اليمنية</label>
                                <input type="text" class="form-control" name="purpose_of_travel" value="{{ old('purpose_of_travel') }}" required/>
                                @error('purpose_of_travel') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <label class="form-label fw-bold" for="name">الفترة المطلوبة </label>
                                <input type="text" class="form-control" id="days" name="period_required" value="1 Month"  max="30" disabled/>
                                @error('period_required') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                          <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">العنوان في الجمهورية اليمنية</label>
                                <textarea class="form-control" name="address_in_roy" required>{{ old('address_in_roy') }}</textarea>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-0">
                            </div>
                        </div>
                          <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">الجهة الداعية في اليمن: الاسم</label>
                                <input type="text" class="form-control" name="sponsor_name" value="{{ old('sponsor_name') }}" required/>
                                @error('sponsor_1_name') <span class="text-danger">{{ $message }}</span> @enderror
                                
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                            <label class="form-label fw-bold" for="name">الجهة الداعية في اليمن: العنوان</label>
                                <textarea class="form-control" rows="4" name="sponsor_address" required> {{ old('sponsor_address') }}</textarea>
                                @error('sponsor_1_address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                          <label class="form-label fw-bold" for="previous_visit_1">تواريخ الزيارة السابقة للجمهورية اليمنية (إن وجدت)</label>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">    
                                <input type="date" class="form-control" name="previous_visit_1" value="{{ old('previous_visit_1') }}" required/>
                                @error('previous_visit_1') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <input type="date" class="form-control" name="previous_visit_2" value="{{ old('previous_visit_2') }}" required/>
                                @error('previous_visit_2') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="passport_attachment">نسخة من جواز السفر<br>(ملف jpg/png/PDF أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="passport_attachment" required/>
                                @error('passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">نسخة من الهوية الاماراتية<br>(ملف PDF/JPG/PNG أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="id_card" required/>
                                @error('id_card') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="sponsor_passport">نسخة من جواز سفر الكفيل<br>(ملف pdf/jpg/png أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="sponsor_passport" required/>
                                @error('sponsor_passport') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name">خطاب عدم ممانعة من الكفيل<br>(ملف PDF/JPG/PNG أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="sponsor_pass" required/>
                                @error('sponsor_pass') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                    </div>
                    <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="photo">صورة شخصية حديثة  (jpg, png, jpeg) (200x200)</label>
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

                </div>
                      <div class="form-group my-3">
                                <input type="checkbox" class="form-check-input" name="has_accompany" wire:model="add_accompany" onclick="hasAccompany(this)" />
                                <label for="add_accompany" class="form-label"> Add Accompanying Person </label>
                        </div>
            <div id="accompany" style="display:none;">
                 <div class="row">
                   <h4>Details of Accompanying Person</h4>
                   <hr>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="acc_name">الاسم باللغة العربية بحسب جواز السفر</label>
                                <input type="text" class="form-control" name="accompany_name" value="{{ old('accompany_name') }}"/>
                                @error('accompany_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                 </div>
                <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="acc_passport_attachment">نسخة من جواز السفر<br>(ملف jpg/png/PDF أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="acc_passport_attachment" wire:model="id_card"/>
                                @error('accompany_passport') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">نسخة من الهوية الاماراتية<br>(ملف PDF/JPG/PNG أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="accompany_id_card"/>
                                @error('accompany_id_card') <span class="text-danger">{{ $message }}</span> @enderror
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
<script>
document.getElementById("days").addEventListener("input", function () {
    if (this.value > 30) {
        this.value = 30; // Force max value
    }
});
function hasAccompany(element)
{
    if(element.checked){
        document.getElementById('accompany').style.display = 'block';
    }
    else{
        document.getElementById('accompany').style.display = 'none';
    }
}
</script>


</x-app-layout>


<script>
    Livewire.on('submitVisaApplicationForm', () => {
        document.getElementById('visa-application-form').submit();
    });
</script>

<script>
// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];
  // Set max attribute to today's date
  document.getElementById('issued_on').setAttribute('max', today);
 // document.getElementById('beneficiary_issued_on').setAttribute('max', today);

</script>
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
  
    const form = document.querySelector('form');

    form.addEventListener('submit', function (e) {
        const croppedImage = croppedImageInput.value;

        if (!croppedImage || !croppedImage.startsWith("data:image")) {
            e.preventDefault(); // prevent form from submitting
            alert("Please crop the image before submitting.");
        }
    });
    function copyAddress()
    {
        console.log('tesdt');
        const address = document.querySelector('#same_address');
       // alert(address.checked);
        if(address.checked){
            document.getElementById("address_uae").value = document.getElementById("address").value;
        }
    }
</script>

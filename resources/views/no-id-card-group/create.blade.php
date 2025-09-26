<x-app-layout>
    <style>
/* Mobile card style */
@media (max-width: 768px) {
  table.table {
    border: 0;
  }
  table.table thead {
    display: none; /* hide table header */
  }
  table.table tr {
    display: block;
    margin-bottom: 1rem;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    padding: 0.75rem;
  }
  table.table td {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    border: none;
    border-bottom: 1px solid #f1f1f1;
  }
  table.table td:last-child {
    border-bottom: none;
  }
  table.table td::before {
    content: attr(data-label);
    font-weight: 600;
    margin-right: 1rem;
    color: #555;
  }
  table.table td[data-label="Sl No"] {
    display: none;
  }
}
</style>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h3 class="text-success w-100 text-center">لإصدار إفادة لمن لا يحمل بطاقة هوية، يرجى تعبئة جميع الحقول الإلزامية لإتمام الطلب</h3>
    
     @if(request()->has('batch'))
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Passport Number</th>
                        <th>Issued On</th>
                        <th>Expire On</th>
                        <th>Issued From</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($application->formable->groupIdCardMembers as $member)
                    <tr>
                        <td data-label="Photo">@if($member->photo) <img src="/storage{{$member->photo}}" width="100"> @else NA  @endif</td>
                        <td data-label="Name">{{ $member->name_arabic }}</td>
                        <td data-label="Passport Number">{{ $member->passport->passport_number }}</td>
                        <td data-label="Issued On">{{ $member->passport->issued_on }}</td>
                        <td data-label="Expire On">{{ $member->passport->expires_on }}</td>
                        <td data-label="Issued From">{{ $member->passport->passportCenter->center_name }}</td>
                        <td data-label="Remove"><a href="{{ route('nic-group.remove',['member' => $member->id, 'application'=> $application->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure want to Remove member ?')">X</a></td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            <div class="w-100 d-flex justify-content-center">
                <form action="{{ route('application.confirm', ['application_id' => $application->id]) }}" method="POST">
                    @csrf
                    <button class="btn btn-success" onclick="return confirm('Are you sure want to submit finally?')">Final Submit</button>
                </form>
            </div>
        @endif
        <div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
       
        <form action="{{ route('no-id-card-group.store') }}" enctype="multipart/form-data" method="POST" id="no-id-card-group-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            @if(request()->has('batch'))
            <input type="hidden" name="batch" value="{{ request('batch') }}">
            @endif
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                
       
                @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
               <div class="card text-start my-2">
                    <div class="card-body">
                        <div class="d-flex form-group rounded w-100 p-2 justify-content-center align-items-center ">
                            <div class="form-check">
                                <input type="radio" name="app_type" value="adult" class="form-check-input" onclick="changeAppType()" checked>
                                <label>Applicant age above 18</label>
                            </div>
                            <div class="form-check mx-2">
                                <input type="radio" name="app_type" value="minor" class="form-check-input" onclick="changeAppType()">
                                <label>Applicant age below 18</label>
                            </div>
                        </div>
                        <div class="card">
                           
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
                                        <label class="form-label fw-bold" for="issued_on">تاريخ الإصدار</label>
                                        <input type="date" class="form-control" name="issued_on" value="{{ old('issued_on') }}" required/>
                                        @error('issued_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="expire_on">تاريخ الانتهاء</label>
                                        <input type="date" class="form-control" name="expire_on" value="{{ old('expire_on') }}"  required/>
                                        @error('expire_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                 <div class="row">
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="passport_center">جهة الإصدار</label>
                                        <select class="form-select" name="passport_center" required>
                                            <option>Issuing Authority</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}" @selected($center->id == old('passport_center'))>{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-check" id="has-wife-block">
                                    <input type="checkbox" class="form-check-input" name="emirati_wife" id="has-wife" onclick="changeAttachments()"> <span class="text-success fw-bold">إذا كانت مقدمة الطلب زوجة مواطن إماراتي</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


              
        <div class="card text-start my-2">
                    <div class="card-header">المرفقات</div>
                    <div class="card-body">
                        <div id="general">
                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="passport_attachment"> نسخة من جواز السفر (pdf ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control general" name="passport_attachment"/>
                                @error('passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="emirate_id_attachment">	نسخة من الهوية الاماراتية (pdf,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control general" name="emirate_id_attachment"/>
                                    @error('emirate_id_attachment')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>    
                            <div id="for-child-only" style="display:none;">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="father_passport"> نسخة من جواز سفر الأب  (pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control child-only" name="father_passport" />
                                    @error('fathers_passport') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="father_emirate_id">نسخة من الهوية الاماراتية للأب (pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control child-only" name="father_emirate_id"/>
                                    @error('father_emirate_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                </div> 
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="mother_passport">نسخة من	جواز سفر الأم (pdf,jpg, png, jpeg)</label>
                                        <input type="file" class="form-control child-only" name="mother_passport"/>
                                        @error('mother_passport')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="mother_emirate_id">نسخة من الهوية الاماراتية للأم (pdf,jpg, png, jpeg)</label>
                                        <input type="file" class="form-control child-only" name="mother_emirate_id"/>
                                        @error('mother_emirate_id')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                </div> 
                               {{--  <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="photo">صورة شخصية (jpg, png, jpeg) (200x200)</label>
                                        <input type="file" class="form-control child-only item-photo" name="photo" id="imageInput"  accept="image/*">
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
                            
                                </div>    --}}    
                                <div class="row">
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="birth_certificate">نسخة من	شهادة ميلاد (pdf,jpg, png, jpeg)</label>
                                        <input type="file" class="form-control child-only" name="birth_certificate"/>
                                        @error('birth_certificate')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div id="yemeni-wife" style="display:none;">
                             <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="husband_passport"> نسخة من جواز سفر - الزوج(pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control yemeni-wife" name="husband_passport"/>
                                    @error('husband_passport') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="wife_passport_attachment"> نسخة من جواز سفر - الزوجة (pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control yemeni-wife" name="wife_passport_attachment"/>
                                    @error('wife_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>    
                            <div class="row">
                                
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="wife_emirate_id_attachment"> نسخة من الهوية الاماراتية - الزوجة(pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control yemeni-wife" name="wife_emirate_id_attachment"/>
                                    @error('wife_emirate_id_attachment')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>   
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="marriage_document"> نسخة من عقد الزواج(pdf  ,jpg, png, jpeg)</label>
                                        <input type="file" class="form-control yemeni-wife" name="marriage_document"/>
                                        @error('marriage_document') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>    
                            
                            </div>       
                        
                        <div class="row" id="photo-section" style="display:none;" class="w-100">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="photo">صورة شخصية (jpg, png, jpeg) (200x200)</label>
                                    <input type="file" class="form-control item-photo yemeni-wife" id="imageInput" name="photo" accept="image/*">
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
                                <div class="mb-3 col-lg-4 col-xl-4 col-md-4 col-sm-12" id="preview-crop" style="display: none;">
                                        <!-- Show Cropped Result -->
                                        <p><strong>Cropped Preview:</strong></p>
                                        <img id="croppedPreview" width="200" height="200" style="border: 1px solid #aaa;">
                                        <br><br>
                                        <input type="hidden" name="cropped_image" id="croppedImage">
                                </div>
                        </div>
                    </div>
                </div>
                <div><button class="btn btn-success">Add Member</button></div>
            
            </div>
        </form>
    </div>
</div>

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

function changeAppType()
{
    const selected = document.querySelector('input[name="app_type"]:checked');
    const elements = document.querySelectorAll(`.child-only`);
    const generalElements = document.querySelectorAll(`.general`);
    const wifeelements = document.querySelectorAll(`.yemeni-wife`);
    generalElements.forEach(element => {
                element.setAttribute('required', 'true');
        });
    if(selected.value == 'adult'){
        elements.forEach(element => {
                element.removeAttribute('required');
        });
        
     document.getElementById('for-child-only').style.display = 'none';
     document.getElementById('photo-section').style.display = 'none';
     document.getElementById('has-wife-block').style.display = 'block';
     document.getElementById('has-wife').checked = false;
    }
    else{
        document.getElementById('general').style.display = 'block';
        document.getElementById('yemeni-wife').style.display = 'none';
        document.getElementById('has-wife-block').style.display = 'none';
        document.getElementById('for-child-only').style.display = 'block';
        document.getElementById('photo-section').style.display = 'block';
        elements.forEach(element => {
                element.setAttribute('required', 'true');
        });
        wifeelements.forEach(element => {
                element.removeAttribute('required');
        });
        
    }
}
function changeAttachments()
{
    hasWife = document.getElementById('has-wife');
    const selected = document.querySelector('input[name="app_type"]:checked');
    const elements = document.querySelectorAll(`.yemeni-wife`);
    const generalElements = document.querySelectorAll(`.general`);
    if(hasWife.checked){
        document.getElementById('general').style.display = 'none';
        document.getElementById('yemeni-wife').style.display = 'block';
        document.getElementById('photo-section').style.display = 'block';
        elements.forEach(element => {
                element.setAttribute('required', 'true');
        });
        generalElements.forEach(element => {
                element.removeAttribute('required');
        });
        
    }
    else{
        elements.forEach(element => {
                element.removeAttribute('required');
        });
        document.getElementById('general').style.display = 'block';
        document.getElementById('yemeni-wife').style.display = 'none';
        document.getElementById('photo-section').style.display = 'none';
    }
}
</script>



</x-app-layout>




<script>
// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];
  // Set max attribute to today's date
 // document.getElementById('wife_issued_on').setAttribute('max', today);

  


  
</script>


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
         <form action="@if(request()->has('edit')) {{ route('marriage-certificate.store', ['application' => $application->id]) }} @else {{ route('application.confirm', ['application_id' => $application->id]) }}  @endif" enctype="multipart/form-data" method="POST" id="renew-passport-above-form" class="w-100 align-items-center text-center d-flex justify-content-center">
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
                            <div class="card-header">بيانات جواز سفر - الزوج</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="husband_name_arabic">الاسم باللغة العربية بحسب جواز السفر</label>
                                        <input type="text" class="form-control" name="husband_name_arabic" value="{{ $application->formable->husband_name_arabic }}" @if(!request('edit')) disabled @endif  required/>
                                        @error('husband_name_arabic')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    
                                        <label class="form-label fw-bold"  for="husband_passport_number">رقم جواز السفر</label>
                                        
                                        <input type="text" id="passportInput-" maxlength="8" class="form-control" value="{{ $application->formable->husband_passport_number }}" @if(!request('edit')) disabled @endif  name="husband_passport_number" required/>
                                        <small id="passportError-" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                        @error('husband_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="husband_passport_issued_on">تاريخ إصدار جواز السفر</label>
                                        <input type="date" class="form-control" name="husband_passport_issued_on" value="{{ $application->formable->husband_passport_issued_on }}" @if(!request('edit')) disabled @endif required/>
                                        @error('husband_passport_issued_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>   
                                </div>
                            </div>
                        </div>
                    <div class="card">
                            <div class="card-header">بيانات جواز السفر - الزوجة</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="wife_name_arabic">الاسم باللغة العربية بحسب جواز السفر</label>
                                        <input type="text" class="form-control" name="wife_name_arabic" value="{{ $application->formable->wife_name_arabic }}" @if(!request('edit')) disabled @endif required/>
                                        @error('wife_name_arabic')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    
                                        <label class="form-label fw-bold"  for="wife_passport_number">رقم جواز السفر</label>
                                        
                                        <input type="text" id="passportInput-" maxlength="8" class="form-control" value="{{ $application->formable->wife_passport_number }}" @if(!request('edit')) disabled @endif name="wife_passport_number" required/>
                                        <small id="passportError-" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                        @error('wife_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="wife_passport_issued_on">تاريخ إصدار جواز السفر</label>
                                        <input type="date" class="form-control" name="wife_passport_issued_on" value="{{ $application->formable->wife_passport_issued_on }}" @if(!request('edit')) disabled @endif required/>
                                        @error('wife_passport_issued_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>   
                                </div>
                            </div>
                        </div>
                    <div class="card text-start my-2">
                    <div class="card-header">
                        بيانات عقد الزواج
                    </div>
                    <div class="card-body">
                        {{-- Agent Passport --}}
    
                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="contract_issued_by">جهة الإصدار</label>
                                    <input type="text" class="form-control" name="contract_issued_by"  value="{{ $application->formable->contract_issued_by }}" @if(!request('edit')) disabled @endif required/>
                                    @error('contract_issued_by')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="registration_number">رقم عقد الزواج</label>
                                    <input  type="text" class="form-control" name="registration_number" value="{{ $application->formable->registration_number }}" @if(!request('edit')) disabled @endif required/>
                                    @error('registration_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                             {{--   <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="contract_issued_on">تاريخ عقد الزواج</label>
                                    <input  type="date" class="form-control" id="contract_issued_on" name="contract_issued_on" value="{{ old('contract_issued_on') }}" required/>
                                    @error('contract_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>    --}} 
                                 <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="date_of_marriage">تاريخ الزواج </label>
                                    <input  type="date" class="form-control" wire:model="date_of_marriage"  name="date_of_marriage" value="{{ $application->formable->date_of_marriage }}" @if(!request('edit')) disabled @endif required/>
                                    @error('date_of_marriage') <span class="text-danger">{{ $message }}</span> @enderror
                                </div> 
                              
                            </div>
                            
                        </div>
                    </div>
                    
                <div class="card text-start my-2">
                    <div class="card-header">المرفقات</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <div @class(["d-none" => !request('edit'), "mb-2"])>
                                    <label class="form-label fw-bold" for="husband_passport_attachment">نسخة من جواز سفر - الزوج(pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" name="husband_passport_attachment"  @if(!request('edit')) disabled @endif/>
                                    @error('husband_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <a onclick="openModal('husband_passport_attachment')" class="btn btn-dark">View Husband Passport</a>
                                    <!-- Modal -->
                                        <div id="husband_passport_attachment" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('husband_passport_attachment')">&times;</span>
                                                @if(Str::of($application->formable->husband_passport_attachment)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                                        <img src="/storage/{{ $application->formable->husband_passport_attachment }}"
                                                            alt="Preview"
                                                            style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                                @else
                                                <iframe id="passport_iframe" src="/storage/{{ $application->formable->husband_passport_attachment }}"></iframe>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                </div>
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <div @class(["d-none" => !request('edit'), "mb-2"])>
                                    <label class="form-label fw-bold" for="husband_emirate_id_attachment"> نسخة من الهوية الاماراتية - الزوج(pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" name="husband_emirate_id_attachment"  @if(!request('edit')) disabled @endif/>
                                    @error('husband_emirate_id_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <a onclick="openModal('husband_emirate_id_attachment')" class="btn btn-dark">View Husband Emirate ID</a>
                                    <!-- Modal -->
                                        <div id="husband_emirate_id_attachment" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('husband_emirate_id_attachment')">&times;</span>
                                                @if(Str::of($application->formable->husband_emirate_id_attachment)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                                        <img src="/storage/{{ $application->formable->husband_emirate_id_attachment }}"
                                                            alt="Preview"
                                                            style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                                @else
                                                <iframe id="passport_iframe" src="/storage/{{ $application->formable->husband_emirate_id_attachment }}"></iframe>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                </div>
                            </div> 
                        </div>    
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <div @class(["d-none" => !request('edit'), "mb-2"])>
                                    <label class="form-label fw-bold" for="wife_passport_attachment"> نسخة من جواز سفر - الزوجة (pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" name="wife_passport_attachment"  @if(!request('edit')) disabled @endif/>
                                    @error('wife_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <a onclick="openModal('wife_passport_attachment')" class="btn btn-dark">View Wife Passport</a>
                                    <!-- Modal -->
                                        <div id="wife_passport_attachment" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('wife_passport_attachment')">&times;</span>
                                                @if(Str::of($application->formable->husband_passport_attachment)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                                        <img src="/storage/{{ $application->formable->wife_passport_attachment }}"
                                                            alt="Preview"
                                                            style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                                @else
                                                <iframe id="passport_iframe" src="/storage/{{ $application->formable->wife_passport_attachment }}"></iframe>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                </div>
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <div @class(["d-none" => !request('edit'), "mb-2"])>
                                    <label class="form-label fw-bold" for="wife_emirate_id_attachment"> نسخة من الهوية الاماراتية - الزوجة(pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" name="wife_emirate_id_attachment"  @if(!request('edit')) disabled @endif/>
                                    @error('wife_emirate_id_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <a onclick="openModal('wife_emirate_id_attachment')" class="btn btn-dark">View Wife Emirate ID</a>
                                    <!-- Modal -->
                                        <div id="wife_emirate_id_attachment" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('wife_emirate_id_attachment')">&times;</span>
                                                @if(Str::of($application->formable->wife_emirate_id_attachment)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                                        <img src="/storage/{{ $application->formable->wife_emirate_id_attachment }}"
                                                            alt="Preview"
                                                            style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                                @else
                                                <iframe id="passport_iframe" src="/storage/{{ $application->formable->wife_emirate_id_attachment }}"></iframe>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                </div>
                            </div> 
                        </div>    
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <div @class(["d-none" => !request('edit'), "mb-2"])>
                                    <label class="form-label fw-bold" for="marriage_document">نسخة من عقد الزواج(pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" name="marriage_document"  @if(!request('edit')) disabled @endif/>
                                    @error('marriage_document') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <a onclick="openModal('marriage_document')" class="btn btn-dark">View Marriage Document</a>
                                    <!-- Modal -->
                                        <div id="marriage_document" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('marriage_document')">&times;</span>
                                                @if(Str::of($application->formable->marriage_document)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                                        <img src="/storage/{{ $application->formable->marriage_document }}"
                                                            alt="Preview"
                                                            style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                                @else
                                                <iframe id="passport_iframe" src="/storage/{{ $application->formable->marriage_document }}"></iframe>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                </div>
                            </div> 
                        </div>
                          
                    </div>
                </div>
                </div>
            </div>
           
             <div class="form-group my-3 text-center">
                @if(request()->has('edit'))
                    <button class="btn buttom-effect" id="submitBtn" >تغييرات التحديث</button>
                @else
                    <button class="btn buttom-effect" id="submitBtn" >تأكيد التطبيق</button>
                @endif
                <a class="btn btn-dark" id="submitBtn" href="{{ route('marriage-certificate.verify', ['application_id' => $application->id, 'edit'=> true]) }}">قم بإجراء التغييرات</a>
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


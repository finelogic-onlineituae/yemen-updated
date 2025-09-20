<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('no-id-card-group.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="no-id-card-group-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                <div><a class="btn btn-info rounded-0">Member 1</a></div>
               <div class="card text-start my-2">
                    <div class="card-body">
                        <div class="d-flex form-group rounded w-100 p-2 justify-content-center align-items-center ">
                            <div class="form-check">
                                <input type="radio" name="app_type" value="1" class="form-check-input" onclick="changeAppType()" checked>
                                <label>Applicant age above 18</label>
                            </div>
                            <div class="form-check mx-2">
                                <input type="radio" name="app_type" value="0" class="form-check-input" onclick="changeAppType()">
                                <label>Applicant age below 18</label>
                            </div>
                        </div>
                        <div class="card">
                           
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_arabic">الاسم باللغة العربية بحسب جواز السفر</label>
                                        <input type="text" class="form-control" name="name_arabic" wire:model="surname_arabic"/>
                                        @error('name_arabic')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    
                                        <label class="form-label fw-bold"  for="passport_number">رقم جواز السفر</label>
                                        
                                        <input type="text" id="passportInput-" maxlength="8" class="form-control" name="passport_number" wire:model="passport_number" />
                                        <small id="passportError-" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                        @error('passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                               
                                <div class="row">
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="issued_on">تاريخ الإصدار</label>
                                        <input type="date" class="form-control" name="issued_on" wire:model="issued_on"/>
                                        @error('issued_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">تاريخ الانتهاء</label>
                                        <input type="date" class="form-control" name="expire_on" wire:model="expire_on"/>
                                        @error('expire_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                 <div class="row">
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="issued_by">جهة الإصدار</label>
                                        <select class="form-select" name="passport_center" wire:model="passport_center">
                                            <option>Issuing Authority</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}">{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-check" id="has-wife-block">
                                    <input type="checkbox" class="form-check-input" name="emirati-wife" id="has-wife" onclick="changeAttachments()"> <span class="text-success fw-bold">إذا كانت مقدمة الطلب زوجة مواطن إماراتي</span>
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
                                <input type="file" class="form-control"name="passport_attachment" required/>
                                @error('passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="licence_attachment">	نسخة من الهوية الاماراتية (pdf,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" name="licence_attachment" wire:model="licence_attachment" required/>
                                    @error('issued_on')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>    
                            <div id="for-child-only" style="display:none;">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="fathers_passport"> نسخة من جواز سفر الأب  (pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" name="father_passport" required/>
                                    @error('fathers_passport') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="father_emirate_id">نسخة من الهوية الاماراتية للأب (pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" wire:model="father_emirate_id" name="father_emirate_id" required/>
                                    @error('father_emirate_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                </div> 
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="mother_passport">نسخة من	جواز سفر الأم (pdf,jpg, png, jpeg)</label>
                                        <input type="file" class="form-control" name="mother_passport" required/>
                                        @error('mother_passport')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="mother_emirate_id">نسخة من الهوية الاماراتية للأم (pdf,jpg, png, jpeg)</label>
                                        <input type="file" class="form-control" name="mother_emirate_id" required/>
                                        @error('mother_emirate_id')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                </div> 
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="photo"> صورة شخصية  (jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" wire:model="photo" name="photo" required/>
                                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="birth_certificate">نسخة من	شهادة ميلاد (pdf,jpg, png, jpeg)</label>
                                        <input type="file" class="form-control" name="birth_certificate" required/>
                                        @error('birth_certificate')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div id="yemeni-wife" style="display:none;">
                             <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="husband_passport"> نسخة من جواز سفر - الزوج(pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" name="husband_passport" required/>
                                    @error('husband_passport') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="passport_attachment"> نسخة من جواز سفر - الزوجة (pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" name="passport_attachment" required/>
                                    @error('passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>    
                            <div class="row">
                                
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="emirate_id_attachment"> نسخة من الهوية الاماراتية - الزوجة(pdf ,jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" name="emirate_id_attachment" required/>
                                    @error('emirate_id_attachment')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>   
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="marriage_document"> نسخة من عقد الزواج(pdf  ,jpg, png, jpeg)</label>
                                        <input type="file" class="form-control" name="marriage_document" required/>
                                        @error('marriage_document') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>    
                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="photo"> صورة شخصية  (jpg, png, jpeg)</label>
                                    <input type="file" class="form-control" wire:model="photo" name="photo" required/>
                                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div><a class="btn btn-success">Add Member</a></div>
            <div class="form-group my-3 text-center">
                <button class="btn buttom-effect">تقديم الطلب</button>
            </div>
            </div>
        </form>
    </div>
</div>
<script>
function changeAppType()
{
    const selected = document.querySelector('input[name="app_type"]:checked');
    if(selected.value == 'adult'){
     document.getElementById('for-child-only').style.display = 'none';
     document.getElementById('has-wife-block').style.display = 'block';
     document.getElementById('has-wife').checked = false;
    }
    else{
        document.getElementById('general').style.display = 'block';
        document.getElementById('yemeni-wife').style.display = 'none';
        document.getElementById('has-wife-block').style.display = 'none';
        document.getElementById('for-child-only').style.display = 'block';
    }
}
function changeAttachments()
{
    hasWife = document.getElementById('has-wife');
    const selected = document.querySelector('input[name="app_type"]:checked');
    if(hasWife.checked){
        document.getElementById('general').style.display = 'none';
        document.getElementById('yemeni-wife').style.display = 'block';
    }
    else{
        document.getElementById('general').style.display = 'block';
        document.getElementById('yemeni-wife').style.display = 'none';
    }
}
</script>

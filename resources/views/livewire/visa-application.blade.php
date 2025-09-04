<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('visa-application.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="visa-application-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                <div class="card text-start my-2">

                    <div class="card-body">
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
                                        <select name="issued_by" wire:model="issued_by" class="form-select">
                                            <option value="">Choose Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->country_code }}">{{ $country->country_name.'('.$country->country_code.')' }}</option>
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
                                <select name="nationality" wire:model="nationality" class="form-select">
                                    <option value="">اختر جنسيتك</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->country_code }}">{{ $country->country_name.'('.$country->country_code.')' }}</option>
                                    @endforeach
                                </select>
                                @error('nationality') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                           {{--  <div class="col-lg-6 col-md-6 col-sm-12 ">
                                <label class="form-label fw-bold" for="name">دِين</label>
                                <input type="text" class="form-control" name="religion" wire:model="religion"/>
                                @error('religion') <span class="text-danger">{{ $message }}</span> @enderror
                            </div> --}}
                        </div>
                         <div class="row">
                               <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">تاريخ الميلاد</label>
                                <input type="date" class="form-control" name="date_of_birth" wire:model="date_of_birth"/>
                                @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name">مكان الميلاد</label>
                                <input type="text" class="form-control" name="place_of_birth" wire:model="place_of_birth"/>
                                @error('place_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">المهنة</label>
                                <input type="text" class="form-control" name="proffession" wire:model="proffession"/>
                                @error('proffession') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name">مكان العمل</label>
                                <input type="text" class="form-control" name="place_of_work" wire:model="place_of_work"/>
                                @error('place_of_work') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">العنوان الدائم</label>
                                <textarea type="date" class="form-control" rows="4" name="address" wire:model="address" wire:change="copyAddress" id="address"></textarea>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="address_uae">العنوان في الإمارات العربية المتحدة</label>
                                <textarea type="date" class="form-control" rows="4" name="address_uae" wire:model="address_uae" id="address_uae" @if($same_address) disabled @endif></textarea>
                                @error('address_uae') <span class="text-danger">{{ $message }}</span> @enderror
                                <input type="checkbox" class="form-check-input" name="same_address" wire:model="same_address" wire:click="copyAddress" id="same_address"/>
                                <label for="same_address" class="form-label">نفس العنوان الدائم</label>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">الغرض من السفر إلى الجمهورية اليمنية</label>
                                <input type="text" class="form-control" name="purpose_of_travel" wire:model="purpose_of_travel"/>
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
                                <textarea class="form-control" name="address_in_roy" wire:model="address_in_roy"></textarea>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-0">
                            </div>
                        </div>
                          <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">الجهة الداعية في اليمن: الاسم</label>
                                <input type="text" class="form-control" name="sponsor_1_name" wire:model="sponsor_1_name"/>
                                @error('sponsor_1_name') <span class="text-danger">{{ $message }}</span> @enderror
                                
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                            <label class="form-label fw-bold" for="name">الجهة الداعية في اليمن: العنوان</label>
                                <textarea class="form-control" rows="4" name="sponsor_1_address" wire:model="sponsor_1_address"></textarea>
                                @error('sponsor_1_address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                          <label class="form-label fw-bold" for="previous_visit_1">تواريخ الزيارة السابقة للجمهورية اليمنية (إن وجدت)</label>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">    
                                <input type="date" class="form-control" name="previous_visit_date_1" wire:model="previous_visit_date_1"/>
                                @error('previous_visit_date_1') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <input type="date" class="form-control" name="previous_visit_date_2" wire:model="previous_visit_date_2"/>
                                @error('previous_visit_date_2') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="passport_attachment">نسخة من جواز السفر<br>(ملف jpg/png/PDF أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="passport_attachment" wire:model="id_card"/>
                                @error('passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">نسخة من الهوية الاماراتية<br>(ملف PDF/JPG/PNG أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="id_card" wire:model="id_card"/>
                                @error('id_card') <span class="text-danger">{{ $message }}</span> @enderror

                                @if($id_card_file && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-id_card_file')">تحميل بطاقة الهوية </a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-id_card_file" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-id_card_file')">&times;</span>
                                                <iframe id="pdfViewer-verify-id_card_file" src="{{ generate_signed_storage_url($id_card_file) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  

                              
                            </div>
                            
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="sponsor_passport">نسخة من جواز سفر الكفيل<br>(ملف pdf/jpg/png أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="sponsor_passport" wire:model="photo"/>
                                @error('sponsor_passport') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name">خطاب عدم ممانعة من الكفيل<br>(ملف PDF/JPG/PNG أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="sponsor_pass" wire:model="sponsor_pass"/>
                                @error('sponsor_pass') <span class="text-danger">{{ $message }}</span> @enderror

                                @if($sponsor_pass_file && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-sponsor_pass_file')">تحميل بطاقة الراعي</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-sponsor_pass_file" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-sponsor_pass_file')">&times;</span>
                                                <iframe id="pdfViewer-verify-sponsor_pass_file" src="{{ generate_signed_storage_url($sponsor_pass_file) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif 
                             
                            </div>
                    </div>
                     <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="photo">صورة شخصية<br>(ملف jpg/png 200x200 أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="photo" wire:model="photo"/>
                                @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                    </div>
                </div>
                      <div class="form-group my-3">
                               
                                <input type="checkbox" class="form-check-input" name="add_accompany" wire:model="add_accompany" onclick="hasAccompany(this)" />
                                <label for="add_accompany" class="form-label"> Add Accompanying Person </label>
                        </div>
            <div id="accompany" style="display:none;">
                 <div class="row">
                   <h4>Details of Accompanying Person</h4>
                   <hr>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="acc_name">الاسم باللغة العربية بحسب جواز السفر</label>
                                <input type="text" class="form-control" name="acc_name" wire:model="acc_name"/>
                                @error('acc_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                 </div>
                <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="acc_passport_attachment">نسخة من جواز السفر<br>(ملف jpg/png/PDF أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="acc_passport_attachment" wire:model="id_card"/>
                                @error('acc_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">نسخة من الهوية الاماراتية<br>(ملف PDF/JPG/PNG أقل من 2 ميجا بايت)</label>
                                <input type="file" class="form-control" name="acc_emirate_id" wire:model="acc_emirate_id"/>
                                @error('acc_emirate_id') <span class="text-danger">{{ $message }}</span> @enderror
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
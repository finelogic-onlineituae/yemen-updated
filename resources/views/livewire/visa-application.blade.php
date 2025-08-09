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
                            <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <label class="form-label fw-bold" for="name">اسم</label>
                                <input type="text" class="form-control" name="name" wire:model="name" />
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                               <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="nationality">جنسية</label>
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
                                <label class="form-label fw-bold" for="name">مهنة</label>
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
                                <label class="form-label fw-bold" for="name">غرض السفر إلى الجمهورية اليمنية</label>
                                <input type="text" class="form-control" name="purpose_of_travel" wire:model="purpose_of_travel"/>
                                @error('purpose_of_travel') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <label class="form-label fw-bold" for="name">الفترة المطلوبة (بالأيام)</label>
                                <input type="number" class="form-control" id="days" name="period_required" wire:model="period_required" max="30"/>
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
                                <label class="form-label fw-bold" for="name">الراعي 1: الاسم</label>
                                <input type="text" class="form-control" name="sponsor_1_name" wire:model="sponsor_1_name"/>
                                @error('sponsor_1_name') <span class="text-danger">{{ $message }}</span> @enderror
                                <label class="form-label fw-bold" for="name">الراعي 1: العنوان</label>
                                <textarea class="form-control" rows="4" name="sponsor_1_address" wire:model="sponsor_1_address"></textarea>
                                @error('sponsor_1_address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="name">الراعي 2: الاسم</label>
                                <input type="text" class="form-control" name="sponsor_2_name" wire:model="sponsor_2_name"/>
                                @error('sponsor_2_name') <span class="text-danger">{{ $message }}</span> @enderror
                                <label class="form-label fw-bold" for="name">الراعي 1: العنوان</label>
                                <textarea class="form-control"  rows="4" name="sponsor_2_address" wire:model="sponsor_2_address"></textarea>
                                @error('sponsor_2_address') <span class="text-danger">{{ $message }}</span> @enderror
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
                                <label class="form-label fw-bold" for="name">تحميل بطاقة الهوية <br>(ملف PDF أقل من 2 ميجا بايت)</label>
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
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name">تحميل بطاقة الراعي<br>(ملف PDF أقل من 2 ميجا بايت)</label>
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
                     
                    </div>
                </div>
            <livewire:passport :is_consular="false" :passport="$passport"/>

              
              
                        <div class="form-group my-3 text-center">
                               
                                <input type="checkbox" class="form-check-input" name="add_accompany" wire:model="add_accompany"  id="add_accompany"/>
                                <label for="add_accompany" class="form-label"> Add Accompany </label>
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
</script>
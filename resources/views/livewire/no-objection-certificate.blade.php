
<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100">
        <form action="{{ route('no-objection-certification.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="no-objection-certification-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                <div class="card text-start my-2">
                    <div class="card-header">
                       معلومات شخصية
                    </div>
                    <div class="card-body">
                        <div class="py-2 text-start">
                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="name">الاسم كما هو مكتوب في جواز السفر</label>
                                    <input type="text" class="form-control" name="name" wire:model="name"/>
                                    @error('name')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold"  for="emirates_id">رقم الهوية الإماراتية</label>
                                    <input type="text" class="form-control" id="emiratesIdInput-"  maxlength="17" name="emirates_id" wire:model="emirates_id"/>
                                    <small id="emiratesIdError-" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                                    @error('emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        <div class="row">

                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone_number">رقم التليفون</label>
                                <input type="text" class="form-control" name="phone_number" wire:model="phone_number"/>
                                @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="birth_certifcate_no">رقم تسجيل شهادة الميلا</label>
                                <input type="text" class="form-control" name="birth_certifcate_no" wire:model="birth_certifcate_no"/>
                                @error('birth_certifcate_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                            <div class="row">
                              
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="birth_certifcate">شهادة الميلاد:(في قوات الدفاع الشعبي)</label>
                                    <input type="file" class="form-control" name="birth_certifcate" wire:model="birth_certifcate" />
                                    @error('birth_certifcate')<span class="text-danger">{{ $message }}</span> @enderror
                                   
                                    @if($existing_birth_certifcate && session()->has('edit_application'))
                                    <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-birth_certifcate')">شهادة الميلاد </a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-verify-birth_certifcate" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-verify-birth_certifcate')">&times;</span>
                                                    <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($existing_birth_certifcate) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                    @endif  
                                    
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="birth_certifcate_issuing_authority">جهة إصدار شهادة الميلاد</label>
                                    <input type="text" class="form-control" name="birth_certifcate_issuing_authority" wire:model="birth_certifcate_issuing_authority"/>
                                    @error('birth_certifcate_issuing_authority') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                    <label class="form-label fw-bold" for="residance_permit">تصريح الإقامة(  ملف بي دي إف )</label>
                                    <input type="file" class="form-control" name="residance_permit" wire:model="residance_permit" />
                                    @error('residance_permit')<span class="text-danger">{{ $message }}</span> @enderror
            
                                    @if($existing_residance_permit && session()->has('edit_application'))
                                    <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-residance-permit')"> عرض تصريح الإقامة </a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-verify-residance-permit" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-verify-residance-permit')">&times;</span>
                                                    <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($existing_residance_permit) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                    @endif  
                                </div>
                            </div>

                                <div class="card text-start">
                                    <div class="card-header">
                                       المعلومات التي تحتاج إلى تعديل
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                                <label class="form-label fw-bold" for="modified_name">الاسم بعد التعديل/التصحيح</label>
                                                <input type="text" class="form-control" name="modified_name" wire:model="modified_name"/>
                                                @error('modified_name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                                <label class="form-label fw-bold" for="modified_issued_by">سلطة الإصدار</label>
                                                <input type="text" class="form-control" name="modified_issued_by" wire:model="modified_issued_by"/>
                                                @error('modified_issued_by') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                                <label class="form-label fw-bold" for="modified_issued_on">تاريخ الإصدار</label>
                                                <input type="date" class="form-control" name="modified_issued_on" id="modified_issued_on" wire:model="modified_issued_on"/>
                                                @error('modified_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                                <label class="form-label fw-bold" for="amendment_or_correction">التعديل/التصحيح(في قوات الدفاع الشعبي)</label>
                                                <input type="file" class="form-control" name="amendment_or_correction" wire:model="amendment_or_correction" />
                                                @error('amendment_or_correction')<span class="text-danger">{{ $message }}</span> @enderror
                        
                                                @if($existing_amendment_or_correction && session()->has('edit_application'))
                                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-amendment-correction')">التعديل/التصحيح</a></span>
                                                        <!-- Modal -->
                                                        <div id="pdfModal-verify-amendment-correction" class="modal">
                                                            <div class="modal-content">
                                                                <span class="close" onclick="closeModal('pdfModal-verify-amendment-correction')">&times;</span>
                                                                <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($existing_amendment_or_correction) }}"></iframe>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal -->
                                                @endif  
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <br>
                           
                            
                        </div>
                     
                    </div>
                </div>
              
            <livewire:passport :is_consular="true" :passport="$passport ? $passport : null"/>
            <div class="form-group my-3 text-center">
                <button class="btn buttom-effect">تقديم الطلب</button>
            </div>
            </div>
        </form>
    </div>
 
</div>

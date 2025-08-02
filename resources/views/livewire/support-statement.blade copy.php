<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('support-statement.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="support-statement-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash">
                <div class="card text-start my-2">

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name">اسم مقدم الطلب</label>
                                <input type="text" class="form-control" name="name" wire:model="name"/>
                                @error('name')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone">رقم الهاتف المحمول</label>
                                <input type="text" class="form-control" name="phone_number" wire:model="phone_number"/>
                                @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="emirates_id">رقم الهوية الإماراتية</label>
                                <input type="text" class="form-control"  id="emiratesIdInput-"  maxlength="17" name="emirates_id" wire:model="emirates_id"/>
                                <small id="emiratesIdError-" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                                @error('emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="relation_to_beneficiary">صلة القرابة بالمستفيد جواز سفر المعيل</label>
                                <input type="text" class="form-control" name="relation_to_beneficiary" wire:model="relation_to_beneficiary"/>
                                @error('relation_to_beneficiary')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="information_provided">الطرف الذي سيتم تزويده بالمعلومات</label>
                                <input type="text" class="form-control" name="information_provided" wire:model="information_provided"/>
                                @error('information_provided') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            {{-- <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="breadwinner_passport">Breadwinner Passport (في قوات الدفاع الشعبي)</label>
                                <input type="file" class="form-control" name="breadwinner_passport" wire:model="breadwinner_passport" />
                                @error('breadwinner_passport')<span class="text-danger">{{ $message }}</span> @enderror

                                @if($existing_breadwinner_passport && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-breadwinner-passport')">View Breadwinner Passport</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-breadwinner-passport" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-breadwinner-passport')">&times;</span>
                                                <iframe id="pdfViewer-verify-breadwinner-passport" src="{{ generate_signed_storage_url($existing_breadwinner_passport) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div> --}}
                              <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="birth_certificate">شهادة الميلاد (في قوات الدفاع الشعبي)</label>
                                <input type="file" class="form-control" name="birth_certificate" wire:model="birth_certificate" />
                                @error('birth_certificate')<span class="text-danger">{{ $message }}</span> @enderror

                                @if($existing_birth_certificate && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-birth_certificate')">شهادة الميلاد </a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-birth_certificate" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-birth_certificate')">&times;</span>
                                                <iframe id="pdfViewer-verify-birth_certificate" src="{{ generate_signed_storage_url($existing_birth_certificate) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="registration_summary">ملخص التسجيل (في قوات الدفاع الشعبي)</label>
                                <input type="file" class="form-control" name="registration_summary" wire:model="registration_summary" />
                                @error('registration_summary')<span class="text-danger">{{ $message }}</span> @enderror

                                @if($existing_registration_summary && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-registration_summary')">ملخص التسجيل  </a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-registration_summary" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-registration_summary')">&times;</span>
                                                <iframe id="pdfViewer-verify-registration_summary" src="{{ generate_signed_storage_url($existing_registration_summary) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div>
                          
                        </div>
                    </div>
                </div>

                <livewire:passport :is_consular="true" :titleRemove="true" :passport="$passport"/>

                <div class="card text-start my-2">

                    <div class="card-header">
                       معلومات المستفيد
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="beneficiary_name">اسم</label>
                                <input type="text" class="form-control" name="beneficiary_name" wire:model="beneficiary_name"/>
                                @error('beneficiary_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="beneficiary_passport_number">رقم جواز سفر </label>
                                <input type="text" class="form-control" id="passportInput-1" maxlength="8" name="beneficiary_passport_number"  wire:model="beneficiary_passport_number"/>
                                <small id="passportError-1" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                @error('beneficiary_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="beneficiary_issued_on">تاريخ الإصدار</label>
                                <input type="date" class="form-control" name="beneficiary_issued_on" id="beneficiary_issued_on"  wire:model="beneficiary_issued_on"/>
                                @error('beneficiary_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="beneficiary_issued_by">صادرة عن</label>
                                  <select class="form-select" name="beneficiary_issued_by"  wire:model="beneficiary_issued_by">
                                            <option>Issued From</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}" @selected($center->id == $beneficiary_issued_by)>{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                               
                                @error('beneficiary_issued_by') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="beneficiary_passport">جواز سفر المستفيد(في قوات الدفاع الشعبي)</label>
                                <input type="file" class="form-control" name="beneficiary_passport" wire:model="beneficiary_passport" />
                                @error('beneficiary_passport')<span class="text-danger">{{ $message }}</span> @enderror
        
                                @if($existing_beneficiary_passport && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-beneficiary_passport')">جواز سفر المستفيد</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-beneficiary_passport" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-beneficiary_passport')">&times;</span>
                                                <iframe id="pdfViewer-verify-beneficiary_passport" src="{{ generate_signed_storage_url($existing_beneficiary_passport) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div>
                        </div>

                      
                    </div>
                </div>
                <br>
              
           

            <div class="form-group my-3 text-center">
                <button class="btn buttom-effect">تقديم الطلب</button>
            </div>
            </div>
        </form>
    </div>
</div>

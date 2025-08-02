<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100">
        <form action="{{ route('marriage-certificate.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="registerApplication" id="marriage-certificate-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                
                <div class="card text-start my-2">
                    <div class="card-header">
                       معلومات الزوج
                    </div>
                    <div class="card-body">
                        <div class="py-2 text-start">
                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="name">اسم الزوج</label>
                                    <input type="text" class="form-control" name="husband_name" wire:model="husband_name"/>
                                    @error('husband_name')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                 <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="phone_number">  رقم الهاتف المحمول </label>
                                    <input type="text" class="form-control" name="phone_number" wire:model="phone_number"/>
                                    @error('phone_number')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone">رقم الهوية الإماراتية</label>
                                <input type="text" class="form-control" id="emiratesIdInput-"  maxlength="17" name="husband_emirates_id" wire:model="husband_emirates_id"/>
                                  <small id="emiratesIdError-" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                                @error('husband_emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="husband_residance_permit">تصريح الإقامة(  ملف بي دي إف )</label>
                                <input type="file" class="form-control" name="husband_residance_permit" wire:model="husband_residance_permit" />
                                @error('husband_residance_permit')<span class="text-danger">{{ $message }}</span> @enderror

                                @if($existing_husband_residance_permit)
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-husband_residance_permit')">تصريح الإقامة</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-husband_residance_permit" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-husband_residance_permit')">&times;</span>
                                                <iframe id="pdfViewer-verify-husband_residance_permit" src="{{ generate_signed_storage_url($existing_husband_residance_permit) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div>
                        </div>
                
                {{-- Client Passport --}}
                    <div class="row">
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="husband_passport_number">رقم جواز السفر</label>
                            <input type="text" class="form-control" id="passportInput-1" maxlength="8" name="husband_passport_number" wire:model="husband_passport_number" />
                            <small id="passportError-1" class="text-danger d-none"> Please enter a valid Passport Number</small>
                            @error('husband_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="husband_issued_by">صادرة عن</label>
                                @if(!true)
                                    <select class="form-select" name="husband_issued_by" wire:model="issued_by">
                                        <option>Issuing Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->country_code }}" @selected($country->country_code == $issued_by)>{{ $country->country_name.'('.$country->country_code.')' }}</option>
                                        @endforeach
                                    </select>   
                                    @error('husband_issued_by') <span class="text-danger">{{ $message }}</span> @enderror
                                @else
                                    <select class="form-select"  name="husband_passport_center" wire:model="husband_passport_center">
                                        <option>Issued From</option>
                                        @foreach ($passport_centers as $center)
                                            <option value="{{ $center->id }}" @selected($center->id == $husband_passport_center)>{{ $center->center_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('husband_passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                                @endif
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="husband_issued_on">صدر بتاريخ</label>
                            <input type="date" class="form-control" wire:model="husband_issued_on" id="husband_issued_on" name="husband_issued_on"/>
                            @error('husband_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="attachment">تحميل جواز السفر</label>
                            <input type="file" class="form-control" wire:model="husband_passport_attachment" name="husband_passport_attachment" />
                            @error('husband_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
        
                              @if($husband_passport_attachment_existing)
                              <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-husband_passport_attachment')">عرض جواز السفر</a></span>
                                    <!-- Modal -->
                                    <div id="pdfModal-verify-husband_passport_attachment" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('pdfModal-verify-husband_passport_attachment')">&times;</span>
                                            <iframe id="pdfViewer-verify-husband_passport_attachment" src="{{ generate_signed_storage_url($husband_passport_attachment_existing) }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                            @endif  
                        </div>
                    </div>
                </div>
            </div>
            <div class="card text-start my-2">
                <div class="card-header">
                  معلومات الزوجة
                </div>
                <div class="card-body">
                    {{-- Agent Passport --}}

                        <div class="row">
                            <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <label class="form-label fw-bold" for="wife_name">اسم الزوجة</label>
                                <input type="text" class="form-control" name="wife_name" wire:model="wife_name"/>
                                @error('wife_name')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="wife_emirates_id">رقم الهوية الإماراتية </label>
                                <input  type="text" class="form-control"  id="emiratesIdInput-1"  maxlength="17" wire:model="wife_emirates_id" id="wife_emirates_id" name="wife_emirates_id"/>
                                <small id="emiratesIdError-1" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                                @error('wife_emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="wife_residance_permit">تصريح الإقامة(  ملف بي دي إف )</label>
                                <input type="file" class="form-control" name="wife_residance_permit" wire:model="wife_residance_permit" />
                                @error('wife_residance_permit')<span class="text-danger">{{ $message }}</span> @enderror

                                @if($existing_wife_residance_permit)
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-wife_residance_permit')">تصريح الإقامة</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-wife_residance_permit" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-wife_residance_permit')">&times;</span>
                                                <iframe id="pdfViewer-verify-wife_residance_permit" src="{{ generate_signed_storage_url($existing_wife_residance_permit) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div>
                        </div>
                         
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="wife_passport_number">رقم جواز السفر</label>
                                <input type="text" class="form-control" id="passportInput-2" maxlength="8" name="wife_passport_number" wire:model="wife_passport_number" />
                                <small id="passportError-2" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                @error('wife_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="wife_passport_center">صادرة عن</label>
                                        <select class="form-select" name="wife_passport_center" wire:model="wife_passport_center">
                                            <option>Issued From</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}" @selected($center->id == $wife_passport_center)>{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('wife_passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        
                          
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="issued_on">صدر بتاريخ</label>
                                <input type="date" class="form-control" wire:model="wife_issued_on" id="wife_issued_on" name="wife_issued_on"/>
                                @error('wife_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="wife_passport_attachment">جواز سفر</label>
                                <input type="file" class="form-control" wire:model="wife_passport_attachment" name="wife_passport_attachment" />
                                @error('wife_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
            
                                  @if($wife_passport_attachment_existing)
                                  <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-wife_passport_attachment')">  جواز سفر</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-wife_passport_attachment" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-wife_passport_attachment')">&times;</span>
                                                <iframe id="pdfViewer-verify-wife_passport_attachment" src="{{ generate_signed_storage_url($wife_passport_attachment_existing) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            
                                
                            </div>
                        

                        </div>
                    </div>
                </div>
       

                <div class="card text-start my-2">
                    <div class="card-header">
                        معلومات عقد الزواج
                    </div>
                    <div class="card-body">
                        {{-- Agent Passport --}}
    
                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="contract_issued_by">سلطة الإصدار</label>
                                    <input type="text" class="form-control" name="contract_issued_by" wire:model="contract_issued_by"/>
                                    @error('contract_issued_by')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="marriage_document"> وثيقة الزواج (في قوات الدفاع الشعبي)</label>
                                    <input type="file" class="form-control" name="marriage_document" wire:model="marriage_document" />
                                    @error('marriage_document')<span class="text-danger">{{ $message }}</span> @enderror
    
                                    @if($existing_marriage_document)
                                    <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-marriage_document')">وثيقة الزواج</a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-marriage_document" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-marriage_document')">&times;</span>
                                                    <iframe id="pdfViewer-verify-marriage_document" src="{{ generate_signed_storage_url($existing_marriage_document) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                    @endif  
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="contract_issued_on">تاريخ الافراج عنه </label>
                                    <input  type="date" class="form-control" wire:model="contract_issued_on" id="contract_issued_on" name="contract_issued_on"/>
                                    @error('contract_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="registration_number">رقم التسجيل </label>
                                    <input  type="text" class="form-control" wire:model="registration_number"  name="registration_number"/>
                                    @error('registration_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                
                            </div>
                             
                            <div class="row">
                             
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="date_of_marriage">تاريخ الزواج </label>
                                    <input  type="date" class="form-control" wire:model="date_of_marriage"  name="date_of_marriage"/>
                                    @error('date_of_marriage') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                              
                            </div>
                            
                        </div>
                    </div>


            <div class="form-group my-3 text-center">
                <button class="btn buttom-effect">تقديم الطلب</button>
            </div>
            </div>
        </form>
    </div>
     {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif  --}}

</div>

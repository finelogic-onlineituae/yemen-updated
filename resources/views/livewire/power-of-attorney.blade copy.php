<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('power-of-attorney.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="registerApplication" id="power-of-attorney-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                
                <div class="card text-start my-2">
                    <div class="card-header">
                       معلومات العميل
                    </div>
                    <div class="card-body">
                        <div class="py-2 text-start">
                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="name">اسم العميل</label>
                                    <input type="text" class="form-control" name="client_name" wire:model="client_name"/>
                                    @error('client_name')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="phone">رقم الهاتف المحمول</label>
                                    <input type="text" class="form-control" name="phone_number" wire:model="phone_number"/>
                                    @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone">رقم الهوية الإماراتية</label>
                                <input type="text" class="form-control"  id="emiratesIdInput-"  maxlength="17" name="emirate_id" wire:model="emirate_id"/>
                                <small id="emiratesIdError-" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                                @error('emirate_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="residance_permit">تحميل تصريح الإقامة(في قوات الدفاع الشعبي)</label>
                                <input type="file" class="form-control" name="residance_permit" wire:model="residance_permit" />
                                @error('residance_permit')<span class="text-danger">{{ $message }}</span> @enderror

                                @if($existing_residance_permit)
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-residance-permit')">تحميل تصريح الإقامة</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-residance-permit" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-residance-permit')">&times;</span>
                                                <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($existing_residance_permit) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div>
                        </div>
                
                {{-- Client Passport --}}
                    <div class="row">
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="client_passport_number">رقم جواز السفر</label>
                            <input type="text" class="form-control" id="passportInput-1" maxlength="8" name="client_passport_number" wire:model="client_passport_number" />
                             <small id="passportError-1" class="text-danger d-none"> Please enter a valid Passport Number</small>
                            @error('client_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="client_issued_by">صادرة عن</label>
                                @if(!true)
                                    <select class="form-select" name="client_issued_by" wire:model="issued_by">
                                        <option>Issuing Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->country_code }}" @selected($country->country_code == $issued_by)>{{ $country->country_name.'('.$country->country_code.')' }}</option>
                                        @endforeach
                                    </select>   
                                    @error('client_issued_by') <span class="text-danger">{{ $message }}</span> @enderror
                                @else
                                    <select class="form-select"  name="client_passport_center" wire:model="client_passport_center">
                                        <option>Issued From</option>
                                        @foreach ($passport_centers as $center)
                                            <option value="{{ $center->id }}" @selected($center->id == $client_passport_center)>{{ $center->center_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('client_passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                                @endif
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="issued_on">صدر بتاريخ</label>
                            <input type="date" class="form-control" wire:model="client_issued_on" id="issued_on" name="client_issued_on"/>
                            @error('client_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="attachment">تحميل جواز السفر</label>
                            <input type="file" class="form-control" wire:model="client_passport_attachment" name="client_passport_attachment" />
                            @error('client_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
        
                              @if($client_passport_attachment_existing)
                              <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-client-passport')">عرض جواز السفر</a></span>
                                    <!-- Modal -->
                                    <div id="pdfModal-verify-client-passport" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('pdfModal-verify-client-passport')">&times;</span>
                                            <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($client_passport_attachment_existing) }}"></iframe>
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
                   	معلومات الوكيل
                </div>
                <div class="card-body">
                    {{-- Agent Passport --}}

                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_name">	اسم الوكيل</label>
                                <input type="text" class="form-control" name="agent_name" wire:model="agent_name"/>
                                @error('agent_name')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_passport_number">رقم جواز السفر</label>
                                <input type="text" id="passportInput-2" maxlength="8" class="form-control" name="agent_passport_number" wire:model="agent_passport_number" />
                                <small id="passportError-2" class="text-danger d-none"> Please enter a valid Passport Number</small>          
                                @error('agent_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                         
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_issued_by">صادرة عن</label>
                                        <select class="form-select" name="agent_passport_center" wire:model="agent_passport_center">
                                            <option>Issued From</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}" @selected($center->id == $agent_passport_center)>{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('agent_passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="issued_on">صدر بتاريخ</label>
                                <input type="date" class="form-control" wire:model="agent_issued_on" id="agent_issued_on" name="agent_issued_on"/>
                                @error('agent_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_expire_on">تنتهي صلاحيته</label>
                                <input  type="date" class="form-control" wire:model="agent_expire_on" id="agent_expire_on" name="agent_expire_on"/>
                                @error('agent_expire_on') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_passport_attachment">تحميل جواز السفر</label>
                                <input type="file" class="form-control" wire:model="agent_passport_attachment" name="agent_passport_attachment" />
                                @error('agent_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
            
                                  @if($agent_passport_attachment_existing)
                                  <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-agent_passport')">عرض جواز السفر</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-agent_passport" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-agent_passport')">&times;</span>
                                                <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($agent_passport_attachment_existing) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            <div class="card text-start my-2">
                
                <div class="card-body">
                    <div class="py-2 text-start">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <label class="form-label fw-bold" for="poa_document">	الغرض من الوكالة</label>
                                <input type="file" class="form-control" name="poa_document" wire:model="poa_document"/>
                                @error('poa_document')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <label class="form-label fw-bold" for="name">غرض الوكالة</label>
                                <textarea class="form-control" name="purpose" wire:model="purpose" rows="4"></textarea>
                                @error('purpose')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group my-3 text-center">
                @if($client_passport_attachment_existing)
                    <button class="btn btn-success rounded-0">Save Changes</button>
                @else
                    <button class="btn buttom-effect">تقديم الطلب</button>
                @endif
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

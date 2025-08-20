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
                       بيانات الموكل
                    </div>
                      <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name_arabic">الاسم الكامل (كما هو مذكور في جواز السفر)</label>
                                        <input type="text" class="form-control" name="name_arabic" wire:model="surname_arabic"/>
                                        @error('name_arabic')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="nationality">الجنسية</label>
                                        <select class="form-select" name="nationality" wire:model="country_of_birth">
                                            <option value="">Choose a Country</option>
                                            @forelse ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                        @error('nationality')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    
                                        <label class="form-label fw-bold"  for="passport_number">رقم جواز السفر</label>
                                        
                                        <input type="text" id="passportInput-" maxlength="8" class="form-control" name="passport_number" wire:model="passport_number" />
                                        <small id="passportError-" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                        @error('passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
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
                                <div class="row">
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="issued_on">تاريخ إصدار جواز السفر</label>
                                        <input type="date" class="form-control" name="issued_on" wire:model="issued_on"/>
                                        @error('issued_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">تاريخ انتهاء جواز السفر</label>
                                        <input type="date" class="form-control" name="expire_on" wire:model="expire_on"/>
                                        @error('expire_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                            
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="poa_document">نسخة من جواز السفر (pdf ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="poa_document" wire:model="poa_document"/>
                                @error('poa_document')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="poa_document">نسخة من الهوية الاماراتيه(pdf ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="poa_document" wire:model="poa_document"/>
                                @error('poa_document')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                                
                            </div>
                        </div>
                
               
               
            <div class="card text-start my-2">
                <div class="card-header">
                   	بيانات الوكيل
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
                                <label class="form-label fw-bold" for="agent_name">رقم البطاقة الشخصية/ رقم جواز السفر</label>
                                <input type="text" class="form-control" name="agent_name" wire:model="agent_name"/>
                                @error('agent_name')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            {{-- <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_name">رقم البطاقة الشخصية / رقم جواز السفر</label>
                              <select name="id_type" class="form-control">
                                <option>رقم البطاقة الشخصية</option>
                                <option>رقم جواز السفر</option>
                              </select>
                            </div> --}}
                        </div>
                        <div class="row">
                            
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_name">	الغرض من الوكالة</label>
                                <input type="text" class="form-control" name="agent_name" wire:model="agent_name"/>
                                @error('agent_name')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                           {{--  <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_passport_number">رقم جواز السفر</label>
                                <input type="text" id="passportInput-2" maxlength="8" class="form-control" name="agent_passport_number" wire:model="agent_passport_number" />
                                <small id="passportError-2" class="text-danger d-none"> Please enter a valid Passport Number</small>          
                                @error('agent_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="poa_document">	يرجى إرفاق صورة من سند الملكية أو أي وثيقة ذات صلة بالوكالة</label>
                                <input type="file" class="form-control" name="poa_document" wire:model="poa_document"/>
                                @error('poa_document')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="poa_document">	تحميل الهوية / جواز السفر</label>
                                <input type="file" class="form-control" name="poa_document" wire:model="poa_document"/>
                                @error('poa_document')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                         
                       {{--  <div class="row">
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
                            
                        </div> --}}
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

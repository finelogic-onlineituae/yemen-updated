<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('visa-application-accompany.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="visa-application-accompany-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
               
                    <input type="hidden" name="visa_application_id" value="{{ $visa_application_id }}">
                    <input type="hidden" name="applicationstore" value="{{ $applicationstore }}">

           

                <div class="card text-start my-2">
                    @foreach ($accompany_members as $index => $member)
                    
                            <div class="card-header">
                                عضو {{ $index + 1 }}
                               
                                @if(count($accompany_members)!=1)
                                <button type="button" wire:click="removeAccompanyMembers({{ $index }})" class="btn btn-danger btn-sm float-end">يزيل</button>
                                @endif
                            </div>
                
                            <div class="card-body">
                                <input type="hidden" name="accompany_members[{{ $index }}][member_index]" value="{{ $index }}">
                                <input type="hidden" name="accompany_members[{{ $index }}][id]" value="{{ $member['id'] ?? '' }}">
                
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> اسم</label>
                                        <input type="text" name="accompany_members[{{ $index }}][member_name]" class="form-control"
                                        wire:model="accompany_members.{{ $index }}.member_name">
                                        @error('accompany_members.' . $index . '.member_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                   <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="emirates_id"> رقم الهوية الإماراتية</label>
                                        <input type="text" id="emiratesIdInput-{{ $index }}" maxlength="21" name="accompany_members[{{ $index }}][member_emirates_id]" class="form-control"
                                        wire:model="accompany_members.{{ $index }}.member_emirates_id">
                                        <small id="emiratesIdError-{{ $index }}" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                                        @error('accompany_members.' . $index . '.member_emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">  رقم جواز سفر </label>
                                        <input type="text" id="passportInput-{{ $index }}"  maxlength="8" name="accompany_members[{{ $index }}][member_passport_number]" class="form-control"
                                           wire:model="accompany_members.{{ $index }}.member_passport_number">
                                        <small id="passportError-{{ $index }}" class="text-danger d-none">
                                            Please enter a valid Passport Number
                                        </small>
                                        @error('accompany_members.' . $index . '.member_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> مركز الجوازات</label>

                                        <select name="accompany_members[{{ $index }}][member_passport_center]" class="form-control"
                                                wire:model="accompany_members.{{ $index }}.member_passport_center">
                                            <option value="">Select</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}">{{ $center->country_name.'('.$center->country_code.')' }}</option>
                                            @endforeach
                                        </select>
                                        @error('accompany_members.' . $index . '.member_passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> صدر بتاريخ</label>
                                        <input type="date" name="accompany_members[{{ $index }}][member_issued_on]" class="form-control"
                                        wire:model="accompany_members.{{ $index }}.member_issued_on">
                                        @error('accompany_members.' . $index . '.member_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="phone">مرفق جواز السفر</label>
                                        <input type="file" name="accompany_members[{{ $index }}][member_passport_attachment]" wire:model="accompany_members.{{ $index }}.member_passport_attachment" class="form-control">
                                        @error('accompany_members.' . $index . '.member_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror

                                        @if (!empty($member['existing_passport_attachment']))
                                            <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-existing_passport_attachment')">مرفق جواز السفر </a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-verify-existing_passport_attachment" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-verify-existing_passport_attachment')">&times;</span>
                                                    <iframe id="pdfViewer-verify-existing_passport_attachment" src="{{ generate_signed_storage_url($member['existing_passport_attachment']) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                            
                                        @endif
                                    </div>
                                </div>
                                  <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">تنتهي صلاحيته</label>
                                        <input type="date" name="accompany_members[{{ $index }}][member_expires_on]" class="form-control"
                                        wire:model="accompany_members.{{ $index }}.member_expires_on">
                                        @error('accompany_members.' . $index . '.member_expires_on') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                
                                </div>

                                {{-- <div class="row">
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">شهادة الميلاد:(  ملف بي دي إف)</label>
                                        <input type="file" name="accompany_members[{{ $index }}][member_birth_certificate]" wire:model="accompany_members.{{ $index }}.member_birth_certificate" class="form-control">
                                        @error('accompany_members.' . $index . '.member_birth_certificate') <span class="text-danger">{{ $message }}</span> @enderror

                                        @if (!empty($member['existing_birth_certificate']))
                                            <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-existing_birth_certificate')">شهادة الميلاد</a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-verify-existing_birth_certificate" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-verify-existing_birth_certificate')">&times;</span>
                                                    <iframe id="pdfViewer-verify-existing_birth_certificate" src="{{ generate_signed_storage_url($member['existing_birth_certificate']) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->

                                          
                                        @endif
                                    </div> 
                                   
                                </div>--}}
                               

                            </div>
                    @endforeach
                   
                    <div class="card-header">
                        <button type="button"  wire:click="addFamilyMember" class="btn btn-primary">إضافة عضو</button>
                    </div>

                </div>
              
    
            <div class="form-group my-3 text-center">
                <button class="btn buttom-effect">تقديم الطلب</button>
            </div>
            </div>
        </form>
    </div>
</div>

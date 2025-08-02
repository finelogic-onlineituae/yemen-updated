<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('family-member.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="family-member-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
              
            <div class="card text-start my-2">
                          <div class="card-header">معلومات الداعم</div>
                            <div class="card-body">
                                 <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="supporter_name">اسم المؤيد</label>
                                        <input type="text" class="form-control" name="supporter_name" wire:model="supporter_name"/>
                                        @error('supporter_name')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="supporter_name">العلاقة بالتبعية</label>
                                        <input type="text" class="form-control" name="supporter_name" wire:model="supporter_name"/>
                                        @error('supporter_name')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                <div class="card text-start my-2">
                    @foreach ($family_members as $index => $member)
                    
                            <div class="card-header">
                                عضو {{ $index + 1 }}
                               
                                @if(count($family_members)!=1)
                                <button type="button" wire:click="removeFamilyMember({{ $index }})" class="btn btn-danger btn-sm float-end">يزيل</button>
                                @endif
                            </div>
                
                            <div class="card-body">
                                <input type="hidden" name="family_members[{{ $index }}][member_index]" value="{{ $index }}">
                                <input type="hidden" name="family_members[{{ $index }}][id]" value="{{ $member['id'] ?? '' }}">
                
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> اسم</label>
                                        <input type="text" name="family_members[{{ $index }}][member_name]" class="form-control"
                                        wire:model="family_members.{{ $index }}.member_name">
                                        @error('family_members.' . $index . '.member_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="member_relation">العلاقة</label>
                                        <select name="family_members[{{ $index }}][member_relation]" class="form-control"
                                                wire:model="family_members.{{ $index }}.member_relation">
                                            <option value="">يختار العلاقة</option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Spouse">Spouse</option>
                                            <option value="Children">Children</option>
                                            <option value="Other">Other</option>

                                            <!-- Add more relations if needed -->
                                        </select>
                                        @error('family_members.' . $index . '.member_relation') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">  رقم جواز سفر </label>
                                        <input type="text"  maxlength="8"  id="passportInput-{{ $index }}"  name="family_members[{{ $index }}][member_passport_number]" class="form-control"
                                           wire:model="family_members.{{ $index }}.member_passport_number">
                                            <small id="passportError-{{ $index }}" class="text-danger d-none">
                                            Please enter a valid Passport Number
                                        </small>
                                        @error('family_members.' . $index . '.member_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> مركز الجوازات</label>

                                        <select name="family_members[{{ $index }}][member_passport_center]" class="form-control"
                                                wire:model="family_members.{{ $index }}.member_passport_center">
                                            <option value="">Select</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}">{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('family_members.' . $index . '.member_passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> صدر بتاريخ</label>
                                        <input type="date" name="family_members[{{ $index }}][member_issued_on]" class="form-control"
                                        wire:model="family_members.{{ $index }}.member_issued_on">
                                        @error('family_members.' . $index . '.member_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="phone">جواز سفر</label>
                                        <input type="file" name="family_members[{{ $index }}][member_passport_attachment]" wire:model="family_members.{{ $index }}.member_passport_attachment" class="form-control">
                                        @error('family_members.' . $index . '.member_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror

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
                               <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="eid"> هوية الإمارات التابعة (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                        <input type="file" class="form-control" wire:model="eid" name="eid" />
                                        @error('eid') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>   
                                    
                                </div>
                               

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

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
                                
                                {{-- <div class="row">
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">تاريخ الميلاد</label>
                                        <input type="date" class="form-control" name="date_of_birth" wire:model="date_of_birth"/>
                                        @error('date_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">جنس</label>
                                        <select class="form-select" name="gender" wire:model="gender">
                                            <option value="">Choose Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        @error('profession')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="country_of_birth">بلد الميلاد</label>
                                        <select class="form-select" name="country_of_birth" wire:model="country_of_birth">
                                            <option value="">Choose a Country</option>
                                            @forelse ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                        @error('country_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="profession">مدينة الميلاد</label>
                                        <input type="text" class="form-control" name="city_of_birth" wire:model="city_of_birth"/>
                                        @error('city_of_birth')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div> --}}
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
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="card text-start my-2">
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
                                        <label class="form-label fw-bold" for="phone_number"> رقم التليفون </label>
                                        <input type="text" name="family_members[{{ $index }}][member_phone_number]" class="form-control"
                                        wire:model="family_members.{{ $index }}.member_phone_number">
                                        @error('family_members.' . $index . '.member_phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="emirates_id"> رقم الهوية الإماراتية</label>
                                        <input type="text" id="emiratesIdInput-{{ $index }}" maxlength="21"
                                            name="family_members[{{ $index }}][member_emirates_id]" class="form-control"
                                            wire:model="family_members.{{ $index }}.member_emirates_id">
                                        <small id="emiratesIdError-{{ $index }}" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                                        @error('family_members.' . $index . '.member_emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> اسم</label>
                                        <input type="text" name="family_members[{{ $index }}][member_name]" class="form-control"
                                        wire:model="family_members.{{ $index }}.member_name">
                                        @error('family_members.' . $index . '.member_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="phone">مرفق جواز السفر</label>
                                        <input type="file" name="family_members[{{ $index }}][member_passport_attachment]" wire:model="family_members.{{ $index }}.member_passport_attachment" class="form-control">
                                        @error('family_members.' . $index . '.member_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror

                                        @if (!empty($member['existing_passport_attachment']))
                                            <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-existing_passport_attachment.{{ $index+2 }}')">مرفق جواز السفر </a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-verify-existing_passport_attachment.{{ $index+2 }}" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-verify-existing_passport_attachment.{{ $index+2 }}')">&times;</span>
                                                    <iframe id="pdfViewer-verify-existing_passport_attachment.{{ $index }}" src="{{ generate_signed_storage_url($member['existing_passport_attachment']) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                            
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">  رقم جواز سفر </label>
                                      <input type="text"
                                            name="family_members[{{ $index }}][member_passport_number]"
                                            id="passportInput-{{ $index }}"  maxlength="8"
                                            class="form-control"
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
                                        <label class="form-label fw-bold" for="phone">تصريح الإقامة (  ملف بي دي إف)</label>
                                        <input type="file" name="family_members[{{ $index }}][member_residance_permit]" wire:model="family_members.{{ $index }}.member_residance_permit" class="form-control">
                                        @error('family_members.' . $index . '.member_residance_permit') <span class="text-danger">{{ $message }}</span> @enderror

                                        @if (!empty($member['existing_residance_permit']))

                                            <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-member_residance_permit.{{ $index+1 }}')">تصريح الإقامة </a></span>
                                            <!-- Modal -->
                                            <div id="pdfModal-verify-member_residance_permit.{{ $index+1 }}" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('pdfModal-verify-member_residance_permit.{{ $index+1 }}')">&times;</span>
                                                    <iframe id="pdfViewer-verify-member_residance_permit.{{ $index+1 }}" src="{{ generate_signed_storage_url($member['existing_residance_permit']) }}"></iframe>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                            
                                        @endif
                                    </div>
                                </div>
                               <div class="row">
                                    <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                        <label class="form-label fw-bold" for="submitted_to">يتم تقديم هذه المعلومات إلى</label>
                                        <input type="text" name="family_members[{{ $index }}][member_submitted_to]" class="form-control"
                                        wire:model="family_members.{{ $index }}.member_submitted_to">
                                        @error('family_members.' . $index . '.member_submitted_to') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                   
                                </div>
                            </div>
                    @endforeach
                   
                    <div class="card-header">
                        <button type="button"  wire:click="addFamilyMember"  class="btn btn-primary">إضافة عضو</button>
                    </div>

                </div> --}}
              
    <div class="card text-start my-2">
                    <div class="card-header">المرفقات</div>
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="attachment"> نسخة من جواز السفر (pdf ,jpg, png, jpeg)</label>
                            <input type="file" class="form-control" wire:model="attachment" name="attachment" />
                            @error('attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="licence_attachment">	نسخة من الهوية الاماراتية (pdf,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="licence_attachment" wire:model="licence_attachment" />
                                @error('issued_on')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>    
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="fathers_passport"> نسخة من جواز سفر الأب  (pdf ,jpg, png, jpeg)</label>
                            <input type="file" class="form-control" wire:model="fathers_passport" name="fathers_passport" />
                            @error('fathers_passport') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="attachment">نسخة من الهوية الاماراتية للأب (pdf ,jpg, png, jpeg)</label>
                            <input type="file" class="form-control" wire:model="fathers_id" name="fathers_id" />
                            @error('fathers_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                        </div> 
                        <div class="row">
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="mothers_passport">نسخة من	جواز سفر الأم (pdf,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="mothers_passport" wire:model="mothers_passport" />
                                @error('mothers_passport')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="mothers_id">نسخة من الهوية الاماراتية للأم (pdf,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="mothers_id" wire:model="mothers_id" />
                                @error('mothers_id')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                        </div> 
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <label class="form-label fw-bold" for="photo"> صورة شخصية  (jpg, png, jpeg)</label>
                            <input type="file" class="form-control" wire:model="photo" name="photo" />
                            @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="birth_certificate">نسخة من	شهادة ميلاد (pdf,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="birth_certificate" wire:model="birth_certificate" />
                                @error('birth_certificate')<span class="text-danger">{{ $message }}</span> @enderror
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

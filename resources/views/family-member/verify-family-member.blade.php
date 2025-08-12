<x-app-layout>
<div>
    
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('family-member.store') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="family-member-form" class="w-100 align-items-center text-center d-flex flex-column justify-content-center">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
              
            <div class="card text-start my-2">
                          <div class="card-header">معلومات الداعم</div>
                            <div class="card-body">
                                 <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="supporter_name">اسم المؤيد</label>
                                        <input type="text" class="form-control" name="supporter_name" value="{{ $application->formable->supporter_name }}" @if(!request('edit')) disabled @endif/>
                                        @error('supporter_name')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="dependancy_relationship">العلاقة بالتبعية</label>
                                        <input type="text" class="form-control" name="dependancy_relationship"  value="{{ $application->formable->dependancy_relationship }}" @if(!request('edit')) disabled @endif/>
                                        @error('dependancy_relationship')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-ash p-2 rounded">أفراد العائلة</div>
                        
                <div class="card text-start my-2" >
                            <div class="card-body">
                                @forelse ($application->formable->familyMembers as $member)
                                   
                                <div class="border p-2 my-2">
                                    @if(count($application->formable->familyMembers) > 1)
                                    <div class="d-flex align-items-end justify-content-end">
                                        <a href="{{ route('family-member.remove', ['application_id' => $application->id, 'member_id' => $member->id]) }}" onclick="return confirm('Are you sure want to remove member {{ strtoupper($member->name) }}?')" class="btn btn-sm btn-danger">X</a>
                                    </div>
                                    @endif
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> اسم</label>
                                        <input type="text" name="member_name[]" class="form-control" value="{{ $member->name }}" @if(!request('edit')) disabled @endif required>
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="member_relation">العلاقة</label>
                                        <select name="member_relation[]" class="form-control" @if(!request('edit')) disabled @endif required>
                                            <option value="">يختار العلاقة</option>
                                            <option value="Father" @selected($member->relationship == 'Father')>Father</option>
                                            <option value="Mother" @selected($member->relationship == 'Mother')>Mother</option>
                                            <option value="Spouse" @selected($member->relationship == 'Spouse')>Spouse</option>
                                            <option value="Children" @selected($member->relationship == 'Children')>Children</option>
                                            <option value="Sibling" @selected($member->relationship == 'Sibling')>Sibling</option>

                                            <!-- Add more relations if needed -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">  رقم جواز سفر </label>
                                        <input type="text"  maxlength="8"  id="passportInput-"  name="member_passport_number[]" class="form-control" value="{{ $member->passport->passport_number }}" @if(!request('edit')) disabled @endif required>
                                            <small id="passportError-" class="text-danger d-none">
                                            Please enter a valid Passport Number
                                        </small>
                                        
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> جهة الإصدار</label>

                                        <select name="member_passport_center[]" class="form-control" @if(!request('edit')) disabled @endif required>                                              
                                            <option value="">Select</option>
                                            @foreach ($passport_centers as $center)
                                                <option @selected($center->id == $member->passport->passport_center_id) value="{{ $center->id }}">{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="member_issued_on"> تاريخ الإصدار</label>
                                        <input type="date" name="member_issued_on[]" class="form-control" value="{{ $member->passport->issued_on }}" @if(!request('edit')) disabled @endif required>
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> تاريخ الانتهاء</label>
                                        <input type="date" name="member_expire_on[]" class="form-control" value="{{ $member->passport->expires_on }}" @if(!request('edit')) disabled @endif required>
                                    </div>
                                </div>
                               <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <div @class(["d-none" => !request('edit'), "mb-2"])>
                                        <label class="form-label fw-bold" for="passport_attachment"> جواز (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                        <input type="file" class="form-control" name="passport_attachment"  @if(!request('edit')) disabled @endif/>
                                        @error('passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                    <a onclick="openModal('passport-{{ $member->id }}')" class="btn btn-dark">View Passport</a>
                                    <!-- Modal -->
                                            <div id="passport-{{ $member->id }}" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" onclick="closeModal('passport-{{ $member->id }}')">&times;</span>
                                                    @if(Str::of($member->passport->attachment)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                                            <img src="/storage/{{ $member->passport->attachment }}"
                                                                alt="Preview"
                                                                style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                                    @else
                                                    <iframe id="passport_iframe" src="/storage/{{ $member->passport->attachment }}"></iframe>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                    </div>
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <div @class(["d-none" => !request('edit'), "mb-2"])>
                                        <label class="form-label fw-bold" for="emirate_id_attachment"> الهوية الإماراتية (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                        <input type="file" class="form-control" name="emirate_id_attachment"  @if(!request('edit')) disabled @endif  />
                                        @error('emirate_id_attachment')<span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <a onclick="openModal('emirate_id-{{ $member->id }}')" class="btn btn-dark">View Emirate ID</a>
                                            <!-- Modal -->
                                                <div id="emirate_id-{{ $member->id }}" class="modal">
                                                    <div class="modal-content">
                                                        <span class="close" onclick="closeModal('emirate_id-{{ $member->id }}')">&times;</span>
                                                        @if(Str::of($member->emirates_id_attachment)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                                                <img src="/storage/{{ $member->emirates_id_attachment }}"
                                                                    alt="Preview"
                                                                    style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                                        @else
                                                        <iframe id="emirate_id_iframe" src="/storage/{{ $member->emirates_id_attachment }}"></iframe>
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                                <!-- End Modal -->
                                        </div>
                                    </div>   
                                </div>    
                            </div>
                        @empty
                        @endforelse
                    
                
            </div>

             </div>  
                
            <div class="form-group my-3 text-center">
                @if(request()->has('edit'))
                    <button class="btn buttom-effect" id="submitBtn" >تغييرات التحديث</button>
                @else
                    <button class="btn buttom-effect" id="submitBtn" >تأكيد التطبيق</button>
                    <a class="btn btn-dark" id="submitBtn" href="{{ route('family-member.verify', ['application_id' => $application->id, 'edit'=> true]) }}">قم بإجراء التغييرات</a>
                @endif
                <a type="button"  onclick="openModal('member-form')" class="btn btn-success mx-2">إضافة عضو</a> 
            </div>
            </div></div>
            </div>
               
        </form>
        <div id="member-form" class="modal">
            <div class="modal-content " style="height:auto !important;">
                <span class="close" onclick="closeModal('member-form')">&times;</span>
            <form action="@if(request()->has('edit')) {{ route('-.store', ['application' => $application->id]) }} @else {{ route('application.confirm', ['application_id' => $application->id]) }}  @endif" enctype="multipart/form-data" method="POST">
                @csrf
                        <div class="card text-start mt-5" >
                            <div class="card-header">إضافة عضو</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> اسم</label>
                                        <input type="text" name="member_name" class="form-control">
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="member_relation">العلاقة</label>
                                        <select name="member_relation" class="form-control">
                                            <option value="">يختار العلاقة</option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Spouse">Spouse</option>
                                            <option value="Children">Children</option>
                                            <option value="Sibling">Sibling</option>

                                            <!-- Add more relations if needed -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">  رقم جواز سفر </label>
                                        <input type="text"  maxlength="8"  id="passportInput-"  name="member_passport_number" class="form-control">
                                            <small id="passportError-" class="text-danger d-none">
                                            Please enter a valid Passport Number
                                        </small>
                                        
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> جهة الإصدار</label>

                                        <select name="member_passport_center" class="form-control">                                              
                                            <option value="">Select</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}">{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="member_issued_on"> تاريخ الإصدار</label>
                                        <input type="date" name="member_issued_on" class="form-control">
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> تاريخ الانتهاء</label>
                                        <input type="date" name="member_expire_on" class="form-control">
                                    </div>
                                </div>
                               <div class="row">
                                 <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="member_passport_attachment">جواز سفر</label>
                                        <input type="file" name="member_passport_attachment" class="form-control">
                                    </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="member_emirates_id_attachment"> هوية الإمارات التابعة (ملف بي دي إف  ,jpg, png, jpeg)</label>
                                        <input type="file" class="form-control" name="member_emirates_id_attachment" />
                                    </div>   
                                    
                                </div>
                                <div class="w-100 text-center">
                                    <button class="btn btn-success">إضافة عضو</button>
                                </div>
                            </div>
                    </div>   
                    
                    </form>
                </div>
    </div>

</div>
<script>
    var memberCount = 1;
    function addMember()
    {
        memberCount++;
        const html = document.getElementById("member-form").innerHTML;
        const newElement = document.createElement('div');
        newElement.className = 'border border-rounded p-2 my-2'
        newElement.id = 'member-'+memberCount;
        newElement.innerHTML = html;
        let closeId = `member-`+memberCount;
        closeButton = document.createElement('div');
        closeButton.className = 'w-100 text-end'
        closeButton.innerHTML = '<a onclick=removeMember("'+newElement.id+'") class="btn btn-danger">x</a>';
        newElement.prepend(closeButton);
        document.getElementById("additonal_members").appendChild(newElement);
    }
    function removeMember(id)
    {
        
       console.log(memberCount);
       el = document.getElementById(id);
       el.remove();
       memberCount--;
      
    }
</script>
</x-app-layout>

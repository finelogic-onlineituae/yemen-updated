<x-app-layout>
<div>
    
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('family-member.store') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="family-member-form" class="w-100 align-items-center text-center d-flex justify-content-center">
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
                    <div class="card text-start my-2" >
                        <div class="card-header">بيانات مقدم الطلب</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">الاسم</label>
                                        <input type="text" name="applicant_name" class="form-control">
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">  رقم جواز السفر</label>
                                        <input type="text"  maxlength="8"  id="passportInput-"  name="applicant_passport_number" class="form-control">
                                            <small id="passportError-" class="text-danger d-none">
                                            Please enter a valid Passport Number
                                        </small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="applicant_issued_on"> تاريخ الإصدار</label>
                                        <input type="date" name="applicant_issued_on" class="form-control">
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> جهة الإصدار</label>
                                        <select name="applicant_passport_center" class="form-control">                                              
                                            <option value="">Select</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}">{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                               
                </div>
            </div>
            
                <div class="card text-start my-2" >
                        <div class="card-header">بيانات المستفيد من الطلب</div>
                        
                            <div class="card-body">
                                <div id="member-form">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">الاسم</label>
                                        <input type="text" name="member_name[]" class="form-control">
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name">  رقم جواز السفر</label>
                                        <input type="text"  maxlength="8"  id="passportInput-"  name="member_passport_number[]" class="form-control">
                                            <small id="passportError-" class="text-danger d-none">
                                            Please enter a valid Passport Number
                                        </small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="member_issued_on"> تاريخ الإصدار</label>
                                        <input type="date" name="member_issued_on[]" class="form-control">
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="name"> جهة الإصدار</label>

                                        <select name="member_passport_center[]" class="form-control">                                              
                                            <option value="">Select</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}">{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="member_relation">صلة القرابة</label>
                                        <input type="text" class="form-control" name="member_relation[]" > 
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="member_passport_attachment">نسخة من جواز السفر (pdf ,jpg, png, jpeg)</label>
                                        <input type="file" name="member_passport_attachment[]" class="form-control">
                                    </div>
                                </div>
                </div>
            </div>
            </div>
              <div id="additonal_members" class="text-start"></div>
                    <div class="card text-start my-2" >
                        <div class="card-header">مستندات مقدم الطلب</div>
                        <div class="card-body">
                            <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                            <label class="form-label fw-bold" for="applicant_passport_attachment">نسخة من جواز السفر (pdf ,jpg, png, jpeg)</label>
                                            <input type="file" name="applicant_passport_attachment" class="form-control">
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                            <label class="form-label fw-bold" for="applicant_emirate_id_attachment"> نسخة من الهوية الاماراتيه (pdf ,jpg, png, jpeg)</label>
                                            <input type="file" class="form-control" name="applicant_emirate_id_attachment" />
                                    </div>   
                            </div>   
                            {{-- <h5>جوازات سفر المستفيدين</h5>
                            <div class="row">
                                    <div id="member-passport">
                                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                                <label class="form-label fw-bold" for="member_passport_attachment[]">نسخة من جواز السفر (pdf ,jpg, png, jpeg)</label>
                                                <input type="file" name="member_passport_attachment[]" class="form-control">
                                        </div>
                                    </div>
                                    <div id="member-passport-container"></div>
                            </div> --}}
                        </div>
                    </div>
    <div class="card-header">
        
                        <a type="button"  onclick="addMember()" class="btn btn-success">إضافة عضو</a>
                       
                    </div>
            <div class="form-group my-3 text-center">
                <button class="btn buttom-effect">تقديم الطلب</button>
            </div>
            </div>
        </form>
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
        closeButton.className = 'w-100 d-flex justify-content-between bg-ash p-2'
        closeButton.innerHTML = '<span>بيانات المستفيد من الطلب </span><a onclick=removeMember("'+newElement.id+'") class="btn"><i class="bi bi-x-square-fill text-danger"></i></a>'
        newElement.prepend(closeButton);
        document.getElementById("additonal_members").appendChild(newElement);

      /*  passportContainer = document.getElementById("member-passport-container");
        newAttachment = document.createElement('div');
        newAttachment.innerHTML = document.getElementById("member-passport").innerHTML;
        passportContainer.appendChild(newAttachment);*/
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

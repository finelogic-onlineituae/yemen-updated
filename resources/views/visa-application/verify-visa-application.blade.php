<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center"> التقدم بطلب للحصول على تأشيرة جديدة</h2>
    <div>
        <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
            <div class="w-100 align-items-center text-center d-flex justify-content-center ">
                @csrf
                <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash " style="width: 100%;">
                    <div class="card my-2">
                        <div class="card-header"> معلومات مقدم الطلب</div>
                        <div class="card-body text-start">
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> اسم</span>
                                    <span>:{{ $application->formable->name }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold"> جنسية</span>
                                    <span>:{{ $application->formable->nationality }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> الديانة</span>
                                    <span>:{{ $application->formable->religion }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold">العنوان الدائم</span>
                                    <span>:{{ $application->formable->permanent_address }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> address_uae</span>
                                    <span>:{{ $application->formable->address_uae }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold"> تاريخ الميلاد</span>
                                    <span>:{{ $application->formable->date_of_birth }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> مكان الميلاد</span>
                                    <span>:{{ $application->formable->place_of_birth }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold"> مهنة</span>
                                    <span>:{{ $application->formable->proffession }}</span>
                                </div>
                            </div>
                              <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> مكان العمل</span>
                                    <span>:{{ $application->formable->place_of_work }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold"> غرض السفر</span>
                                    <span>:{{ $application->formable->purpose_of_travel }}</span>
                                </div>
                            </div>
                             <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> period_required</span>
                                    <span>:{{ $application->formable->period_required }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold"> address_in_roy</span>
                                    <span>:{{ $application->formable->address_in_roy }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> اسم الكفيل ١</span>
                                    <span>:{{ $application->formable->sponsor_1_name }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold"> عنوان الكفيل ١</span>
                                    <span>:{{ $application->formable->sponsor_1_address }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">

                                     <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-id_card')">  بطاقة الهوية</button></span>
                                    <!-- Modal -->
                                    <div id="pdfModal-verify-id_card" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('pdfModal-verify-id_card')">&times;</span>
                                            <iframe id="pdfViewer-verify-id_card" src="{{ generate_signed_storage_url($application->formable->id_card) }}"></iframe>
                                    
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </div>
                                 @if($application->formable->sponsor_2_name)

                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                        <span class="fw-bold"> اسم الكفيل ٢</span>
                                        <span>:{{ $application->formable->sponsor_2_name }}</span>
                                    </div>
                                @endif

                            </div>
                            @if($application->formable->sponsor_2_address)
                             <div class="row">
                                
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold"> عنوان الكفيل ٢</span>
                                    <span>:{{ $application->formable->sponsor_2_address }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">

                                     <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-sponsor_pass')">  عنوان الكفيل ٢</button></span>
                                    <!-- Modal -->
                                    <div id="pdfModal-verify-sponsor_pass" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('pdfModal-verify-sponsor_pass')">&times;</span>
                                            <iframe id="pdfViewer-verify-sponsor_pass" src="{{ generate_signed_storage_url($application->formable->sponsor_pass) }}"></iframe>
                                    
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            @endif
                            @if($application->formable->previous_visit_date_1)
                             <div class="row">
                                
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold"> تاريخ الزيارة السابقة 1</span>
                                    <span>:{{ $application->formable->previous_visit_date_1 }}</span>
                                </div>
                               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold"> تاريخ الزيارة السابقة 2</span>
                                    <span>:{{ $application->formable->previous_visit_date_2 }}</span>
                                </div>
                                
                            </div>
                            @endif
                            <div class="row">
                            
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-passport')">عرض جواز السفر</button></span>
                                    <!-- Modal -->
                                    <div id="pdfModal-verify-passport" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('pdfModal-verify-passport')">&times;</span>
                                            <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($application->formable->passport->attachment) }}"></iframe>
                                    
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold"> صادر عن</span>
                                    <span>:{{ $application->formable->passport->issued_by }}</span>
                                </div>
                            </div>
                        
                        
                            
                        </div>
                    </div>
            @if(count($application->formable->AccompanyMembers)>0)
                    <div class="card my-2 d-none d-sm-block">
                        <div class="card-header"> معلومات الأعضاء</div>
                            <div class="card-body text-start">
                                <div class="row">
                                    <div class="table-responsive" style="overflow-x: auto;">
                                        <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">لا</th>
                                                            <th scope="col">اسم</th>
                                                            <th scope="col">رقم الهوية الإماراتية</th>

                                                            <th scope="col">صدر بتاريخ</th>
                                                            <th scope="col">رقم جواز سفر </th>
                                                            <th scope="col">تنتهي صلاحيته</th>

                                                            <th scope="col">مركز الجوازات</th>
                                                            <th scope="col"> جواز سفر</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($application->formable->AccompanyMembers as $index => $familyMember)
                                                            <tr>
                                                                <th scope="row">{{ $index + 1 }}</th>
                                                                <td>{{ $familyMember->name }}</td>
                                                                <td>{{ $familyMember->emirates_id }}</td>

                                                                <td>{{ $familyMember->passport->issued_on }}</td>

                                                                <td>{{ $familyMember->passport->passport_number }}</td>
                                                                <td>{{ $familyMember->passport->expires_on }}</td>

                                                                <td>{{ $familyMember->passport->Country->country_name }}</td>
                                                                
                                                            

                                                                {{-- Passport --}}
                                                                <td>
                                                                    <button class="btn btn-dark rounded-5"
                                                                            onclick="openModal('passport-{{ $index }}')">
                                                                        جواز سفر
                                                                    </button>
                                                                    <div id="passport-{{ $index }}" class="modal">
                                                                        <div class="modal-content">
                                                                            <span class="close" onclick="closeModal('passport-{{ $index }}')">&times;</span>
                                                                            <iframe src="{{ asset('storage/' . $familyMember->passport->attachment) }}"
                                                                                    width="100%" height="500px"></iframe>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                               
                                                              
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- <a href="#" class="btn btn-dark">Make Changes</a> --}}
                            <a href="{{ route('visa-application-accompany.edit', ['application_id' => encrypt($application->id)]) }}" class="btn btn-dark mb-2">عضو تحرير</a>
                        </div>
                    <div>

                    <div class="card my-2 ">
                                <div class="card-header d-block d-sm-none"> معلومات الأعضاء</div>
                                <div class="d-block d-sm-none">
                                     @foreach ($application->formable->AccompanyMembers as $index => $familyMember)
                                    <div class="card mb-3 w-100">
                                        <div class="card-body">
                                            <h6 class="card-title">اسم : {{ $familyMember->name }}</h6>
                                            <h6 class="card-title">رقم الهوية الإماراتية : {{ $familyMember->emirates_id }}</h6>

                                            <p>	صدر بتاريخ: {{ $familyMember->passport->issued_on }}</p>
                                            <p>تنتهي صلاحيته {{ $familyMember->passport->expires_on }}</p>

                                            <p>رقم جواز سفر : {{ $familyMember->passport->passport_number }}</p>
                                            
                                            <p>مركز الجوازات : {{ $familyMember->passport->Country->country_name }}</p>
                                          
                                            <p>
                                                <button class="btn btn-dark rounded-5"
                                                                            onclick="openModal('passport-{{ $index+11 }}')">
                                                                        جواز سفر
                                                                    </button>
                                                                    <div id="passport-{{ $index+11 }}" class="modal">
                                                                        <div class="modal-content">
                                                                            <span class="close" onclick="closeModal('passport-{{ $index+11 }}')">&times;</span>
                                                                            <iframe src="{{ asset('storage/' . $familyMember->passport->attachment) }}"
                                                                                    width="100%" height="500px"></iframe>
                                                                        </div>
                                                                    </div>
                                            </p>
                                         
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        
            @endif
                    <livewire:signature :application_id="$application->id"/>

                    <div class="form-group gap-2 my-3 text-center d-flex">
                        <form method="POST" action="{{ route('application.confirm', ['application_id' => encrypt($application->id)]) }}">
                            @csrf
                            <button class="btn btn-success" id="final-submit" disabled>تقديم الطلب</button>
                        </form>
                        {{-- <a href="#" class="btn btn-dark">Make Changes</a> --}}
                        <a href="{{ route('visa-application.edit', ['application_id' => encrypt($application->id)]) }}" class="btn btn-dark">إجراء التغييرات</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>
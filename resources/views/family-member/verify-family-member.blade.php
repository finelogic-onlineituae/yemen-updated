<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center">شهادة القرابة </h2>
    <div>
        <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
            <div class="w-100 align-items-center text-center d-flex justify-content-center verfiy-form">
                @csrf
                <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash " >
                    <div class="card my-2">
                        <div class="card-header"> معلومات مقدم الطلب</div>
                        <div class="card-body text-start">
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> اسم</span>
                                    <span>:{{ $application->formable->name }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold">رقم المحمول</span>
                                    <span>:{{ $application->formable->phone_number }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold">رقم الهوية الإماراتية</span>
                                    <span>:{{ $application->formable->emirates_id }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold">الطرف الذي سيتم تزويده بالمعلومات</span>
                                    <span>:{{ $application->formable->information_provided }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold">صادرة عن</span>
                                    <span>:{{ $application->formable->passport->passportCenter->center_name }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold">صدر بتاريخ</span>
                                    <span>:{{ $application->formable->passport->issued_on }}</span>
                                </div>
                            </div>
                            
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
                                    <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-Permit')">عرض تصريح الإقامة </button></span>
                                    <!-- Modal -->
                                    <div id="pdfModal-verify-Permit" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('pdfModal-verify-Permit')">&times;</span>
                                            <iframe id="pdfViewer-verify-Permit" src="{{ generate_signed_storage_url($application->formable->residance_permit ) }}"></iframe>
                                    
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </div>
                            </div>
                        
                        
                            
                        </div>
                    </div>
            
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
                                                            <th scope="col">صدر بتاريخ</th>
                                                            <th scope="col">رقم جواز سفر </th>
                                                            <th scope="col">العلاقة</th>
                                                            <th scope="col">مركز الجوازات</th>
                                                            <th scope="col">عرض تصريح الإقام</th>
                                                            <th scope="col">جواز سفر</th>
                                                            <th scope="col">شهادة الميلاد </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($application->formable->familyMembers as $index => $familyMember)
                                                            <tr>
                                                                <th scope="row">{{ $index + 1 }}</th>
                                                                <td>{{ $familyMember->name }}</td>
                                                                <td>{{ $familyMember->passport->issued_on }}</td>
                                                                <td>{{ $familyMember->passport->passport_number }}</td>
                                                                <td>{{ $familyMember->realtion }}</td>
                                                                <td>{{ $familyMember->passport->passportCenter->center_name }}</td>
                                                                
                                                                {{-- Residence Permit --}}
                                                                <td>
                                                                    <button class="btn btn-dark rounded-5"
                                                                            onclick="openModal('residence-permit-{{ $index }}')">
                                                                        تصريح الإقامة
                                                                    </button>
                                                                    <div id="residence-permit-{{ $index }}" class="modal">
                                                                        <div class="modal-content">
                                                                            <span class="close" onclick="closeModal('residence-permit-{{ $index }}')">&times;</span>
                                                                            <iframe src="{{ generate_signed_storage_url( $familyMember->residance_permit) }}"
                                                                                    width="100%" height="500px"></iframe>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                                {{-- Passport --}}
                                                                <td>
                                                                    <button class="btn btn-dark rounded-5"
                                                                            onclick="openModal('passport-{{ $index }}')">
                                                                        جواز سفر
                                                                    </button>
                                                                    <div id="passport-{{ $index }}" class="modal">
                                                                        <div class="modal-content">
                                                                            <span class="close" onclick="closeModal('passport-{{ $index }}')">&times;</span>
                                                                            <iframe src="{{ generate_signed_storage_url( $familyMember->passport->attachment) }}"
                                                                                    width="100%" height="500px"></iframe>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                                {{-- Birth Certificate --}}
                                                                <td>
                                                                @if($familyMember->birth_certificiate)

                                                                    <button class="btn btn-dark rounded-5"
                                                                            onclick="openModal('birth-certificate-{{ $index }}')">
                                                                        شهادة الميلاد
                                                                    </button>
                                                                    <div id="birth-certificate-{{ $index }}" class="modal">
                                                                        <div class="modal-content">
                                                                            <span class="close" onclick="closeModal('birth-certificate-{{ $index }}')">&times;</span>
                                                                            <iframe src="{{ generate_signed_storage_url( $familyMember->birth_certificiate) }}"
                                                                                    width="100%" height="500px"></iframe>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div>

                    <div class="card my-2 ">
                                <div class="card-header d-block d-sm-none"> معلومات الأعضاء</div>
                                <div class="d-block d-sm-none">
                                    @foreach ($application->formable->familyMembers as $index => $familyMember)
                                        <div class="card mb-3 w-100">
                                            <div class="card-body">
                                                <h6 class="card-title">Name : {{ $familyMember->name }}</h6>
                                                <p>Issued On : {{ $familyMember->passport->issued_on }}</p>
                                                <p>Passport Number : {{ $familyMember->passport->passport_number }}</p>
                                                <p>Relation : {{ $familyMember->realtion}}</p>
                                                <p>Passport Center : {{ $familyMember->passport->passportCenter->center_name }}</p>
                                                <p>
                                                    <button class="btn btn-dark rounded-5"
                                                                                onclick="openModal('residence-permit-{{ $index+10 }}')">
                                                                            Residence Permit
                                                                        </button>
                                                                        <div id="residence-permit-{{ $index+10 }}" class="modal">
                                                                            <div class="modal-content">
                                                                                <span class="close" onclick="closeModal('residence-permit-{{ $index+10 }}')">&times;</span>
                                                                                <iframe src="{{ generate_signed_storage_url( $familyMember->residance_permit) }}"
                                                                                        width="100%" height="500px"></iframe>
                                                                            </div>
                                                                        </div>
                                                </p>
                                                <p>
                                                    <button class="btn btn-dark rounded-5"
                                                                                onclick="openModal('passport-{{ $index+11 }}')">
                                                                            Passport
                                                                        </button>
                                                                        <div id="passport-{{ $index+11 }}" class="modal">
                                                                            <div class="modal-content">
                                                                                <span class="close" onclick="closeModal('passport-{{ $index+11 }}')">&times;</span>
                                                                                <iframe src="{{ generate_signed_storage_url( $familyMember->passport->attachment) }}"
                                                                                        width="100%" height="500px"></iframe>
                                                                            </div>
                                                                        </div>
                                                </p>
                                                @if($familyMember->birth_certificiate)
                                                <p>
                                                                        <button class="btn btn-dark rounded-5"
                                                                                onclick="openModal('birth-certificate-{{ $index+12 }}')">
                                                                            Birth Certificate
                                                                        </button>
                                                                        <div id="birth-certificate-{{ $index+12 }}" class="modal">
                                                                            <div class="modal-content">
                                                                                <span class="close" onclick="closeModal('birth-certificate-{{ $index+12 }}')">&times;</span>
                                                                                <iframe src="{{ generate_signed_storage_url( $familyMember->birth_certificiate) }}"
                                                                                        width="100%" height="500px"></iframe>
                                                                            </div>
                                                                        </div>
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        

                    <livewire:signature :application_id="$application->id"/>

                    <div class="form-group gap-2 my-3 text-center d-flex">
                        <form method="POST" action="{{ route('application.confirm', ['application_id' => encrypt($application->id)]) }}">
                            @csrf
                            <button class="btn btn-success" id="final-submit" disabled>تقديم الطلب</button>
                        </form>
                        {{-- <a href="#" class="btn btn-dark">Make Changes</a> --}}
                        <a href="{{ route('family-member.edit', ['application_id' => encrypt($application->id)]) }}" class="btn btn-dark">إجراء التغييرات</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>
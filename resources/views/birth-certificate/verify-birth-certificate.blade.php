<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center">طلب الحصول على شهادة الميلاد</h2>
    <div>
        <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100">
            <div class="w-100 align-items-center text-center d-flex justify-content-center verfiy-form">
                @csrf
                <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center  bg-ash ">
                    <div class="card my-2">
                        <div class="card-header">معلومات مقدم الطلب</div>
                    <div class="card-body text-start">
                        <div class="row">
                            <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">اسم مقدم الطلب</span>
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
                                <span class="fw-bold">مكان الميلاد</span>
                                <span>:{{ $application->formable->place_of_birth }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">تاريخ الميلاد</span>
                                <span>:{{ $application->formable->date_of_birth }}</span>
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold">الحالة الاجتماعية</span>
                                <span>:{{ $application->formable->marital_status }}</span>
                            </div>
                        </div>
                       
                            <div class=" row">            
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-residance_permit')">تصريح الإقامة(  ملف بي دي إف )</button></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-residance_permit" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-residance_permit')">&times;</span>
                                                <iframe id="pdfViewer-verify-residance_permit" src="{{ generate_signed_storage_url($application->formable->residance_permit) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                </div>
                            </div>

                    </div>
                     <div class="card">
                    <div class="card-header">معلومات جواز السفر</div>
                    <div class="card-body text-start row">
                        <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                            <span class="fw-bold"> رقم جواز السفر</span>
                            <span>:{{ $application->formable->passport->passport_number }}</span>
                        </div>
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <span class="fw-bold">صادرة عن</span>
                            <span>:{{ $application->formable->passport->passportCenter->center_name }}</span>
                        </div>
                    </div>
                    <div class="card-body text-start row">
                        <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                            <span class="fw-bold">صدر بتاريخ</span>
                            <span>:{{ $application->formable->passport->issued_on }}</span>
                        </div>
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
                    </div>
                </div>
                </div>
                <div class="card my-2">
                    <div class="card-header">معلومات الأب</div>
                    <div class="card-body text-start">
                        <div class="row">
                            <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">اسم</span>
                                <span>:{{ $application->formable->fathers_name }}</span>
                            </div>
                            <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">صدر بتاريخ</span>
                                <span>:{{ $application->formable->fathers_issued_on }}</span>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold"> رقم جواز السفر</span>
                                <span>:{{ $application->formable->fathers_passport_number }}</span>
                            </div>
                            <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">الجنسية</span>
                                <span>:{{ $application->formable->fathers_national->country_name }}</span>
                            </div>
                        </div>

                    <div class=" row">
                        
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-fathers_passport')">عرض جواز السفر</button></span>
                            <!-- Modal -->
                            <div id="pdfModal-verify-fathers_passport" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal('pdfModal-verify-fathers_passport')">&times;</span>
                                    <iframe id="pdfViewer-verify-fathers_passport" src="{{ generate_signed_storage_url($application->formable->fathers_passport) }}"></iframe>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </div>
                    </div>
                </div>
              
                </div>
                <div class="card my-2">
                    <div class="card-header">معلومات الأم</div>
                    <div class="card-body text-start">
                        <div class="row">
                            <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">اسم</span>
                                <span>:{{ $application->formable->mothers_name }}</span>
                            </div>
                            <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">تاريخ الإصدار</span>
                                <span>:{{ $application->formable->mothers_issued_on }}</span>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">رقم جواز سفر </span>
                                <span>:{{ $application->formable->mothers_passport_number }}</span>
                            </div>
                            <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">الجنسية</span>
                                <span>:{{ $application->formable->mothers_national->country_name }}</span>
                            </div>
                        </div>

                    <div class=" row">
                        
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-mothers_passport')">عرض جواز السفر</button></span>
                            <!-- Modal -->
                            <div id="pdfModal-verify-mothers_passport" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal('pdfModal-verify-mothers_passport')">&times;</span>
                                    <iframe id="pdfViewer-verify-mothers_passport" src="{{ generate_signed_storage_url($application->formable->mothers_passport) }}"></iframe>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </div>
                    </div>
                </div>
            </div>

               
                    <div>
                    <livewire:signature :application_id="$application->id"/>

                <div class="form-group gap-2 my-3 text-center d-flex">
                    <form method="POST" action="{{ route('application.confirm', ['application_id' => encrypt($application->id)]) }}">
                        @csrf
                        <button class="btn btn-success" id="final-submit" disabled>تقديم الطلب</button>
                    </form>
                    {{-- <a href="#" class="btn btn-dark">Make Changes</a> --}}
                     <a href="{{ route('birth-certificate.edit', ['application_id' => encrypt($application->id)]) }}" class="btn btn-dark">إجراء التغييرات</a>
                </div>
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>
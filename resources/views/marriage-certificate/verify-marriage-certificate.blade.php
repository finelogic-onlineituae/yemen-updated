<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center">شهادة الزواج</h2>
    <div>
        <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
            <div class="w-100 align-items-center text-center d-flex justify-content-center verfiy-form">
                @csrf
                <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                   
               
            

               
                    <div class="card">
                        <div class="card-header">معلومات الزوج</div>
                        <div class="card-body text-start">
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> اسم</span>
                                    <span>:{{ $application->formable->husband_name }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold">رقم الهوية الإماراتية</span>
                                    <span>:{{ $application->formable->husband_emirates_id }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold">رقم جواز سفر </span>
                                    <span>:{{ $application->formable->husbandPassport->passport_number }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold">صادرة عن</span>
                                    <span>:{{ $application->formable->husbandPassport->passportCenter->center_name }}</span>
                                </div>
                            </div>
                        
                    
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold">صدر بتاريخ</span>
                                    <span>:{{ $application->formable->husbandPassport->issued_on }}</span>
                                </div>
                                 <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> رقم جواز سفر </span>
                                    <span>:{{ $application->formable->phone_number }}</span>
                                </div>
                            </div>
                            <div class="row">
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-husbandPassport')">عرض جواز السفر</button></span>
                                    <!-- Modal -->
                                    <div id="pdfModal-verify-husbandPassport" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('pdfModal-verify-husbandPassport')">&times;</span>
                                            <iframe id="pdfViewer-verify-husbandPassport" src="{{ generate_signed_storage_url($application->formable->husbandPassport->attachment) }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-husband_residance_permit')">تصريح الإقامة</button></span>
                                    <!-- Modal -->
                                    <div id="pdfModal-verify-husband_residance_permit" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('pdfModal-verify-husband_residance_permit')">&times;</span>
                                            <iframe id="pdfViewer-verify-husband_residance_permit" src="{{ generate_signed_storage_url($application->formable->husband_residance_permit) }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">معلومات الزوجة</div>
                        <div class="card-body text-start">
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> اسم</span>
                                    <span>:{{ $application->formable->wife_name }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold">رقم الهوية الإماراتية</span>
                                    <span>:{{ $application->formable->wife_emirates_id }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> رقم جواز سفر </span>
                                    <span>:{{ $application->formable->wifePassport->passport_number }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold">صادرة عن</span>
                                    <span>:{{ $application->formable->wifePassport->passportCenter->center_name }}</span>
                                </div>
                            </div>
                        
                    
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold">صدر بتاريخ</span>
                                    <span>:{{ $application->formable->wifePassport->issued_on }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-wifePassport')">عرض جواز السفر</button></span>
                                    <!-- Modal -->
                                    <div id="pdfModal-verify-wifePassport" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('pdfModal-verify-wifePassport')">&times;</span>
                                            <iframe id="pdfViewer-verify-wifePassport" src="{{ generate_signed_storage_url($application->formable->wifePassport->attachment) }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </div>
                            </div>
                            <div class="row">
                            
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-husband_residance_permit')">عرض تصريح الإقامة </button></span>
                                    <!-- Modal -->
                                    <div id="pdfModal-verify-husband_residance_permit" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('pdfModal-verify-husband_residance_permit')">&times;</span>
                                            <iframe id="pdfViewer-verify-husband_residance_permit" src="{{ generate_signed_storage_url($application->formable->husband_residance_permit) }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">معلومات عقد الزواج</div>
                        <div class="card-body text-start"> 
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <span class="fw-bold"> رقم التسجيل</span>
                                    <span>:{{ $application->formable->registration_number }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold">العقد الصادر من</span>
                                    <span>:{{ $application->formable->contract_issued_by }}</span>
                                </div>
                               
                            </div>
                             <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold">تم إصدار العقد في</span>
                                    <span>:{{ $application->formable->contract_issued_on }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold">تاريخ الزواج</span>
                                    <span>:{{ $application->formable->date_of_marriage }}</span>
                                </div>
                            </div>
                    
                            <div class="row">
                              
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-marriage_document')"> وثيقة الزواج </button></span>
                                    <!-- Modal -->
                                    <div id="pdfModal-verify-marriage_document" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('pdfModal-verify-marriage_document')">&times;</span>
                                            <iframe id="pdfViewer-verify-marriage_document" src="{{ generate_signed_storage_url($application->formable->marriage_document) }}"></iframe>
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
                     <a href="{{ route('marriage-certificate.edit', ['application_id' => encrypt($application->id)]) }}" class="btn btn-dark">إجراء التغييرات</a>
                </div>
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>
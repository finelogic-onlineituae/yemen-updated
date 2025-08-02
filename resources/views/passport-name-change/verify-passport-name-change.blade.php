<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center">تغيير اسم جواز السفر</h2>
    <div>
        <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 border-top">
            <div class="w-100 align-items-center text-center d-flex justify-content-center ">
                @csrf
                <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash shadow">
                    <div class="card my-2">
                        <div class="card-header">معلومات مقدم الطلب</div>
                    <div class="card-body text-start">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold">الاسم القديم </span>
                                <span>:{{ $application->formable->old_name }}</span>
                            </div>
                          
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold">رقم المحمول</span>
                                <span>:{{ $application->formable->phone_number }}</span>
                            </div>
                            <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">رقم الهوية الإماراتية</span>
                                <span>:{{ $application->formable->emirates_id }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold"> اسم</span>
                                <span>:{{ $application->formable->name }}</span>
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold">	حامل جواز السفر للوالد الحالي</span>
                                <span>:{{ $application->formable->present_passholder }}</span>
                            </div>
                        </div>
                        <div class="row">
                           
                        
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-supporting_document')">المستندات الداعمة </button></span>
                                <!-- Modal -->
                                <div id="pdfModal-verify-supporting_document" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal('pdfModal-verify-supporting_document')">&times;</span>
                                        <iframe id="pdfViewer-verify-supporting_document" src="{{ generate_signed_storage_url($application->formable->supporting_document) }}"></iframe>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </div>
                              <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-left_thumb')">إصبع الإبهام الأيسر  </button></span>
                                <!-- Modal -->
                                <div id="pdfModal-verify-left_thumb" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal('pdfModal-verify-left_thumb')">&times;</span>
                                        <iframe id="pdfViewer-verify-left_thumb" src="{{ generate_signed_storage_url($application->formable->left_thumb) }}"></iframe>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </div>
                        </div>
                       
                        <div class="row">
                           
                           
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold">صورة</span>
                                <div class="form-group mb-2 mt-2">
                                    <img src="{{ generate_signed_storage_url($application->formable->photo) }}" width="150px" height="150px" class="border border-2 img-fluid rounded"/>
                                </div>
                            </div>
                        </div>
    
                           
                    </div>
                </div>
            
              
           
                <div class="card">
                    <div class="card-header">معلومات جواز السفر</div>
                    <div class="card-body text-start row">
                        <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                            <span class="fw-bold">رقم جواز سفر </span>
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
                    <div>
                    <livewire:signature :application_id="$application->id"/>

                <div class="form-group gap-2 my-3 text-center d-flex">
                    <form method="POST" action="{{ route('application.confirm', ['application_id' => encrypt($application->id)]) }}">
                        @csrf
                        <button class="btn btn-success" id="final-submit" disabled>تقديم الطلب</button>
                    </form>
                    {{-- <a href="#" class="btn btn-dark">Make Changes</a> --}}
                     <a href="{{ route('passport-name-change.edit', ['application_id' => encrypt($application->id)]) }}" class="btn btn-dark">إجراء التغييرات</a>
                </div>
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>
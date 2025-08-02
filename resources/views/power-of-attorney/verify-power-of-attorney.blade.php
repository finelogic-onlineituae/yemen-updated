<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h3 class="text-success w-100 text-center">	توكيل </h3>

    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 ">
        <div class="w-100 align-items-center text-center d-flex justify-content-center verfiy-form">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                
                <div class="card text-start my-2">
                    <div class="card-header">
                       معلومات العميل
                    </div>
                    <div class="card-body">
                        <div class="py-2 text-start">
                            <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <label class="form-label fw-bold" for="client_name">اسم العميل</label>
                                    <span>:{{ $application->formable->client_name }}</span>
                                </div>
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                    <label class="form-label fw-bold" for="phone">رقم الهاتف المحمول</label>
                                    <span>:{{ $application->formable->phone_number }}</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <label class="form-label fw-bold" for="emirate_id">رقم الهوية الإماراتية</label>
                                <span>:{{ $application->formable->phone_number }}</span>
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-residance-permit')">تحميل تصريح الإقامة</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-residance-permit" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-residance-permit')">&times;</span>
                                                <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($application->formable->residance_permit) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                
                            </div>
                        </div>
                
                {{-- Client Passport --}}
                    <div class="row">
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                            <label class="form-label fw-bold" for="client_passport_number">رقم جواز السفر</label>
                            <span>:{{$application->formable->clientPassport->passport_number}}</span>
                        </div>
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                            <label class="form-label fw-bold" for="client_issued_by">صادرة عن</label>
                                
                            <span>:{{$application->formable->clientPassport->passportCenter->center_name}}</span>
                               
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                            <label class="form-label fw-bold" for="client_issued_on">صدر بتاريخ</label>
                            <span>:{{$application->formable->clientPassport->issued_on}}</span>
                        </div>
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                              <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-client-passport')">عرض جواز السفر</a></span>
                                    <!-- Modal -->
                                    <div id="pdfModal-verify-client-passport" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal('pdfModal-verify-client-passport')">&times;</span>
                                            <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($application->formable->clientPassport->attachment) }}"></iframe>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card text-start my-2">
                <div class="card-header">
                   	معلومات الوكيل
                </div>
                <div class="card-body">
                    {{-- Agent Passport --}}

                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_name">	اسم الوكيل</label>
                                <span>:{{$application->formable->agent_name}}</span>    
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_passport_number">رقم جواز السفر</label>
                                <span>:{{$application->formable->agentPassport->passport_number}}</span>
                            </div>
                        </div>
                         
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_issued_by">صادرة عن</label>
                                <span>:{{$application->formable->agentPassport->passportCenter->center_name}}</span>

                            </div>
                        
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="issued_on">صدر بتاريخ</label>
                                <span>:{{$application->formable->agentPassport->issued_on}}</span>    
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_expire_on">تنتهي صلاحيته</label>
                                <span>:{{$application->formable->agentPassport->expires_on}}</span>    
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">

                                  <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-agent_passport')">عرض جواز السفر</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-agent_passport" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-agent_passport')">&times;</span>
                                                <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($application->formable->agentPassport->attachment) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->     
                            </div>
                            
                        </div>
                         <div class="row">
                           
                            <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-power-of-attorney')">	الغرض من الوكالة</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-power-of-attorney" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-power-of-attorney')">&times;</span>
                                                <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($application->formable->poa_document) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal --> 
                            </div>
                              <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <label class="form-label fw-bold" for="name">غرض الوكالة</label>
                                <p>{{ $application->formable->purpose }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- <div class="card text-start my-2">
                
                    <div class="card-body">
                        <div class="row">
                          
                        </div>
                        <div class="row">
                          
                        </div>
                    </div>
                </div> --}}
           
            <livewire:signature :application_id="$application->id"/>

            <div class="form-group gap-2 my-3 text-center d-flex">
                <form method="POST" action="{{ route('application.confirm', ['application_id' => encrypt($application->id)]) }}">
                    @csrf
                    <button class="btn btn-success" id="final-submit" disabled>تقديم الطلب</button>
                </form>
                {{-- <a href="#" class="btn btn-dark">Make Changes</a> --}}
                 <a href="{{ route('power-of-attorney.edit', ['application_id' => encrypt($application->id)]) }}" class="btn btn-dark">Make Changes</a>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
</x-app-layout>

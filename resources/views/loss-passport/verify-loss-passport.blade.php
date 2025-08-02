<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center">فقدان جواز السفر</h2>
    <div>
        <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
            <div class="w-100 align-items-center text-center d-flex justify-content-center verfiy-form">
                @csrf
                <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                    <div class="card my-2">
                        <div class="card-header">معلومات مقدم الطلب</div>
                    <div class="card-body text-start">
                         <div class="row">
                            <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold"> الاسم الكامل باللغة الإنجليزية </span>
                                <span>:{{ $application->formable->name }}</span>
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold">  الاسم الكامل باللغة العربية  </span>
                                <span>:{{ $application->formable->name_arabic }}</span>
                            </div>
                          
                        </div>
                        <div class="row">
                            {{-- <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">رقم الهوية الإماراتية</span>
                                <span>:{{ $application->formable->emirates_id }}</span>
                            </div> --}}
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold">  مكان الميلاد </span>
                                <span>:{{ $application->formable->date_of_birth }}</span>
                            </div>
                             <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">مهنة </span>
                                <span>:{{ $application->formable->profession }}</span>
                            </div>
                            {{-- <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold">حامل جواز السفر للوالد الحالي</span>
                                <span>:{{ $application->formable->present_passholder }}</span>
                            </div> --}}
                        </div>
                        <div class="row">
                           
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold">  مكان الميلاد </span>
                                <span>:{{ $application->formable->place_of_birth }}</span>
                            </div>
                           <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">القريب في الإمارات العربية المتحدة </span>
                                <span>:{{ $application->formable->relative_in_uae }}</span>
                            </div>
                        </div>
                         <div class="row">
                           
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold"> رقم هاتف أحد الأقارب في الإمارات العربية المتحدة</span>
                                <span>:{{ $application->formable->relative_in_uae_number }}</span>
                            </div>
                           <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                                <span class="fw-bold">القريب في اليمن </span>
                                <span>:{{ $application->formable->relative_in_yemen }}</span>
                            </div>
                        </div>
                        <div class="row">
                           
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold"> رقم هاتف أحد الأقارب في اليمن</span>
                                <span>:{{ $application->formable->relative_in_yemen_number }}</span>
                            </div>
                           <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-left_thumb')">إصبع الإبهام الأيسر </button></span>
                                <!-- Modal -->
                                <div id="pdfModal-verify-left_thumb" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal('pdfModal-verify-left_thumb')">&times;</span>
                                        @if(Str::of($application->formable->left_thumb)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                            <img src="{{ generate_signed_storage_url($application->formable->left_thumb) }}"
                                                        alt="Preview"
                                                        style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                        @else
                                        <iframe id="pdfViewer-verify-left_thumb" src="{{ generate_signed_storage_url($application->formable->left_thumb) }}"></iframe>
                                        @endif
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
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-notice_in_newpaper')">اشعار في الصحيفة الرسمية  </button></span>
                                <!-- Modal -->
                                <div id="pdfModal-verify-notice_in_newpaper" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal('pdfModal-verify-notice_in_newpaper')">&times;</span>
                                        @if(Str::of($application->formable->notice_in_newpaper)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                            <img src="{{ generate_signed_storage_url($application->formable->notice_in_newpaper) }}"
                                                        alt="Preview"
                                                        style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                        @else
                                        <iframe id="pdfViewer-verify-notice_in_newpaper" src="{{ generate_signed_storage_url($application->formable->notice_in_newpaper) }}"></iframe>
                                        @endif
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </div>
                        </div>
                       
                        <div class="row">
                           
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-police_reporting_letter')">خطاب بلاغ للشرطة </button></span>
                                <!-- Modal -->
                                <div id="pdfModal-verify-police_reporting_letter" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal('pdfModal-verify-police_reporting_letter')">&times;</span>
                                        @if(Str::of($application->formable->police_reporting_letter)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                            <img src="{{ generate_signed_storage_url($application->formable->police_reporting_letter) }}"
                                                        alt="Preview"
                                                        style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                        @else
                                        <iframe id="pdfViewer-verify-police_reporting_letter" src="{{ generate_signed_storage_url($application->formable->police_reporting_letter) }}"></iframe>
                                        @endif
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </div>
                              <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-emigration_letter')">رسالة الهجرة  </button></span>
                                <!-- Modal -->
                                <div id="pdfModal-verify-emigration_letter" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal('pdfModal-verify-emigration_letter')">&times;</span>
                                        @if(Str::of($application->formable->emigration_letter)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                                    <img src="{{ generate_signed_storage_url($application->formable->emigration_letter) }}"
                                                        alt="Preview"
                                                        style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                        @else
                                        <iframe id="pdfViewer-verify-emigration_letter" src="{{ generate_signed_storage_url($application->formable->emigration_letter) }}"></iframe>
                                        @endif
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </div>
                          
                        </div>
                   
                            
                           
                           
                             

                              {{-- <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-emirates_id_copy')">نسخة من الهوية الإماراتية </button></span>
                                <!-- Modal -->
                                <div id="pdfModal-verify-emirates_id_copy" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal('pdfModal-verify-emirates_id_copy')">&times;</span>
                                         @if(Str::of($application->formable->emirates_id_copy)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                                    <img src="{{ generate_signed_storage_url($application->formable->emirates_id_copy) }}"
                                                        alt="Preview"
                                                        style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                        @else
                                        <iframe id="pdfViewer-verify-emirates_id_copy" src="{{ generate_signed_storage_url($application->formable->emirates_id_copy) }}"></iframe>
                                        @endif
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </div> --}}
                
                        {{-- <div class="row">
                           
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-id_card')">بطاقة الهوية  </button></span>
                                <!-- Modal -->
                                <div id="pdfModal-verify-id_card" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal('pdfModal-verify-id_card')">&times;</span>
                                        <iframe id="pdfViewer-verify-id_card" src="{{ generate_signed_storage_url($application->formable->id_card) }}"></iframe>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </div>
                          
                          
                        </div> --}}
    
                            <div class="row">
                                  <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <span class="fw-bold">رقم المحمول</span>
                                    <span>:{{ $application->formable->phone_number }}</span>
                                </div>
                                  <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <span class="fw-bold">Address</span>
                                <span>:{{ $application->formable->land_mark.','.$application->formable->street.','.$application->formable->area.','.$application->formable->emirate }}</span>
                            </div>
                            </div>
                    </div>
                </div>
            
              
           
                 <div class="card">
                    <div class="card-header">معلومات جواز السفر</div>
                    <div class="card-body text-start">
                    <div class="  row">
                        <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                            <span class="fw-bold">رقم جواز سفر </span>
                            <span>:{{ $application->formable->passport->passport_number }}</span>
                        </div>
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <span class="fw-bold">صادرة عن</span>
                            <span>:{{ $application->formable->passport->issued_by }}</span>
                        </div>
                    </div>
                    <div class="  row">
                        <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                            <span class="fw-bold">صدر بتاريخ</span>
                            <span>:{{ $application->formable->passport->issued_on }}</span>
                        </div>
                        <div class="mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12 d-flex">
                            <span class="fw-bold">Expired On</span>
                            <span>:{{ $application->formable->passport->expires_on }}</span>
                        </div>
                        
                    </div>
                    <div class="  row">
                        <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                            <span><button class="btn btn-dark me-2 rounded-5" onclick="openModal('pdfModal-verify-passport')">عرض جواز السفر</button></span>
                            <!-- Modal -->
                            <div id="pdfModal-verify-passport" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal('pdfModal-verify-passport')">&times;</span>
                                    @if(Str::of($application->formable->passport->attachment)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                                    <img src="{{ generate_signed_storage_url($application->formable->passport->attachment) }}"
                                                        alt="Preview"
                                                        style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                    @else
                                    <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($application->formable->passport->attachment) }}"></iframe>
                                    @endif
                                </div>
                            </div>
                            <!-- End Modal -->
                        </div>
                    </div>
                </div>

                </div>
                    
                    <livewire:signature :application_id="$application->id"/>

                <div class="form-group gap-2 my-3 text-center d-flex">
                    <form method="POST" action="{{ route('application.confirm', ['application_id' => encrypt($application->id)]) }}">
                        @csrf
                        <button class="btn btn-success" id="final-submit" disabled>تقديم الطلب</button>
                    </form>
                    {{-- <a href="#" class="btn btn-dark">Make Changes</a> --}}
                     <a href="{{ route('loss-passport.edit', ['application_id' => encrypt($application->id)]) }}" class="btn btn-dark">إجراء التغييرات</a>
                </div>
                </div>
            </div>
        </div>
    </div>
    


</x-app-layout>
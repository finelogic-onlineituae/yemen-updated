<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    
        <div class="d-flex form-group rounded w-100 p-2 justify-content-center align-items-center ">
            <div class="form-check">
                <input type="radio" name="attestation" value="school" class="form-check-input" onclick="showForm()">
                <label>School Certificate</label>
            </div>
            <div class="form-check mx-2">
                <input type="radio" name="attestation" value="college" class="form-check-input" onclick="showForm()">
                <label>University Certificate</label>
            </div>
            <div class="form-check">
                <input type="radio" name="attestation" value="other" class="form-check-input" onclick="showForm()">
                <label>Other Certificate</label>
            </div>
    </div>
    <div class="text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100">

        <div id="school" style="display: none;">
<form action="{{ route('school-certificate.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="school-certificate-form" class="w-100 align-items-center text-center d-flex justify-content-center">
   @csrf
   <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center bg-ash  border">
      <div class="card text-start my-2">
         <div class="card-body">
            <div class="py-2 text-start">
               <div class="row">
                  <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                     <label class="form-label fw-bold" for="name">اسم مقدم الطلب</label>
                     <input type="text" class="form-control" name="name" wire:model="name"/>
                     @error('name')<span class="text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="phone">رقم الهاتف المحمول</label>
                  <input type="text" class="form-control" name="phone_number" wire:model="phone_number"/>
                  @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
               </div>
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="phone"> رقم الهوية الإماراتية</label>
                  <input type="text" id="emiratesIdInput-"  maxlength="17" class="form-control" name="emirates_id" wire:model="emirates_id"/>
                  <small id="emiratesIdError-" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                  @error('emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
               </div>
            </div>
            <div class="row">
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="phone"> طلب للحصول على</label>
                  <input type="text" class="form-control" name="supporting_reason" wire:model="supporting_reason"/>
                  @error('supporting_reason') <span class="text-danger">{{ $message }}</span> @enderror
               </div>
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="supporting_document"> وثيقة داعمة</label>
                  <input type="file" class="form-control" name="supporting_document" wire:model="supporting_document" />
                  @error('supporting_document')<span class="text-danger">{{ $message }}</span> @enderror
                  @if($existing_supporting_document) 
                  <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-supporting_document')"> وثيقة داعمة </a></span>
                  <!-- Modal -->
                  <div id="pdfModal-supporting_document" class="modal">
                     <div class="modal-content">
                        <span class="close" onclick="closeModal('pdfModal-supporting_document')">&times;</span>
                        <iframe id="pdfViewer-verify-supporting_document" src="{{ generate_signed_storage_url($existing_supporting_document) }}"></iframe>
                     </div>
                  </div>
                  <!-- End Modal -->
                  @endif  
               </div>
            </div>
         </div>
      </div>
      <livewire:passport :is_consular="true" :passport="$passport ? $passport : null"/>
      <div class="card text-start my-2">
         <div class="card-header">
            معلومات الوصي
         </div>
         <div class="card-body">
            {{-- Agent Passport --}}
            <div class="row">
               <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                  <label class="form-label fw-bold" for="guardian_name"> اسم الوصي</label>
                  <input type="text" class="form-control" name="guardian_name" wire:model="guardian_name"/>
                  @error('guardian_name')<span class="text-danger">{{ $message }}</span> @enderror
               </div>
            </div>
            <div class="row">
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="guardian_emirates_id">رقم الهوية الإماراتية </label>
                  <input  type="text" class="form-control"  id="emiratesIdInput-1"  maxlength="17" wire:model="guardian_emirates_id" id="guardian_emirates_id" name="guardian_emirates_id"/>
                  <small id="emiratesIdError-1" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                  @error('guardian_emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
               </div>
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="guardian_id_card">بطاقة الهوية(  ملف بي دي إف )</label>
                  <input type="file" class="form-control" name="guardian_id_card" wire:model="guardian_id_card" />
                  @error('guardian_id_card')<span class="text-danger">{{ $message }}</span> @enderror
                  @if($existing_guardian_id_card) 
                  <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-guardian_id_card')"> بطاقة الهوية</a></span>
                  <!-- Modal -->
                  <div id="pdfModal-guardian_id_card" class="modal">
                     <div class="modal-content">
                        <span class="close" onclick="closeModal('pdfModal-guardian_id_card')">&times;</span>
                        <iframe id="pdfViewer-verify-guardian_id_card" src="{{ generate_signed_storage_url($existing_guardian_id_card) }}"></iframe>
                     </div>
                  </div>
                  <!-- End Modal -->
                  @endif  
               </div>
            </div>
            <div class="row">
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="guardian_passport_number">رقم جواز السفر</label>
                  <input type="text" class="form-control" id="passportInput-2" maxlength="8" name="guardian_passport_number" wire:model="guardian_passport_number" />
                  <small id="passportError-2" class="text-danger d-none"> Please enter a valid Passport Number</small>
                  @error('guardian_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
               </div>
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="guardian_passport_center">صادرة عن</label>
                  <select class="form-select" name="guardian_passport_center" wire:model="guardian_passport_center">
                     <option>Issued From</option>
                     @foreach ($passport_centers as $center)
                     <option value="{{ $center->id }}" @selected($center->id == $guardian_passport_center)>{{ $center->center_name }}</option>
                     @endforeach
                  </select>
                  @error('guardian_passport_center') <span class="text-danger">{{ $message }}</span> @enderror
               </div>
            </div>
            <div class="row">
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="issued_on">صدر بتاريخ</label>
                  <input type="date" class="form-control" wire:model="guardian_issued_on" id="guardian_issued_on" name="guardian_issued_on"/>
                  @error('guardian_issued_on') <span class="text-danger">{{ $message }}</span> @enderror
               </div>
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="guardian_passport_attachment">جواز سفر</label>
                  <input type="file" class="form-control" wire:model="guardian_passport_attachment" name="guardian_passport_attachment" />
                  @error('guardian_passport_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                  @if($guardian_passport_attachment_existing)
                  <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-guardian_passport_attachment')">  جواز سفر</a></span>
                  <!-- Modal -->
                  <div id="pdfModal-verify-guardian_passport_attachment" class="modal">
                     <div class="modal-content">
                        <span class="close" onclick="closeModal('pdfModal-verify-guardian_passport_attachment')">&times;</span>
                        <iframe id="pdfViewer-verify-guardian_passport_attachment" src="{{ generate_signed_storage_url($guardian_passport_attachment_existing) }}"></iframe>
                     </div>
                  </div>
                  <!-- End Modal -->
                  @endif  
               </div>
            </div>
         </div>
      </div>
      <div class="form-group my-3 text-center">
         <button class="btn buttom-effect">تقديم الطلب</button>
      </div>
   </div>
   
</form>
    </div>
     <div id="college" style="display: none;">
        <form action="{{ route('university-certificate.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="univercitycertificate-form" class="w-100 align-items-center text-center d-flex justify-content-center">
   @csrf
   <div class="manage-width-75 w-75 border manage-width bg-ash">
      <div class="card text-start my-2">
         <div class="card-body">
            <div class="row">
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="name">اسم مقدم الطلب</label>
                  <input type="text" class="form-control" name="name" wire:model="name"/>
                  @error('name')<span class="text-danger">{{ $message }}</span> @enderror
               </div>
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="phone">رقم الهاتف المحمول</label>
                  <input type="text" class="form-control" name="phone_number" wire:model="phone_number"/>
                  @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
               </div>
            </div>
            <div class="row">
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="phone"> رقم الهوية الإماراتية</label>
                  <input type="text" id="emiratesIdInput-"  maxlength="17" class="form-control" name="emirates_id" wire:model="emirates_id"/>
                  <small id="emiratesIdError-" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                  @error('emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
               </div>
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="id_card"> بطاقة الهوية(  ملف بي دي إف )</label>
                  <input type="file" class="form-control" name="id_card" wire:model="id_card" />
                  @error('id_card')<span class="text-danger">{{ $message }}</span> @enderror
                  {{-- @if($existing_id_card && session()->has('edit_application'))
                  <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-id_card')"> بطاقة الهوية </a></span>
                  <!-- Modal -->
                  <div id="pdfModal-verify-id_card" class="modal">
                     <div class="modal-content">
                        <span class="close" onclick="closeModal('pdfModal-verify-id_card')">&times;</span>
                        <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($existing_id_card) }}"></iframe>
                     </div>
                  </div>
                  <!-- End Modal -->
                  @endif  
               </div>
               --}}
            </div>
            <div class="row">
               <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  <label class="form-label fw-bold" for="grade_statements"> بيان الصف(  ملف بي دي إف )</label>
                  <input type="file" class="form-control" name="grade_statements" wire:model="grade_statements" />
                  @error('grade_statements')<span class="text-danger">{{ $message }}</span> @enderror
                  {{-- @if($existing_grade_statements && session()->has('edit_application'))
                  <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-grade_statements')">بيان الصف </a></span>
                  <!-- Modal -->
                  <div id="pdfModal-verify-grade_statements" class="modal">
                     <div class="modal-content">
                        <span class="close" onclick="closeModal('pdfModal-verify-grade_statements')">&times;</span>
                        <iframe id="pdfViewer-verify-grade_statements" src="{{ generate_signed_storage_url($existing_grade_statements) }}"></iframe>
                     </div>
                  </div>
                  <!-- End Modal -->
                  @endif   --}}
               </div>
            </div>
         </div>
      </div>
      <livewire:passport :is_consular="true" :passport="$passport"/>
      <div class="form-group my-3 text-center">
         <button class="btn buttom-effect ">تقديم الطلب</button>
      </div>
   </div>
   </div>
</form>
    </div>

     <div id="other" style="display: none;">

         <form action="{{ route('other-certificate.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="othercertificate-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width bg-ash border">
                <div class="card text-start my-2">

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name">اسم مقدم الطلب</label>
                                <input type="text" class="form-control" name="name" wire:model="name"/>
                                @error('name')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone">رقم الهاتف المحمول</label>
                                <input type="text" class="form-control" name="phone_number" wire:model="phone_number"/>
                                @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone"> رقم الهوية الإماراتية</label>
                                <input type="text" id="emiratesIdInput-"  maxlength="17" class="form-control" name="emirates_id" wire:model="emirates_id"/>
                                 <small id="emiratesIdError-" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                                @error('emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="id_card"> بطاقة الهوية(  ملف بي دي إف )</label>
                                <input type="file" class="form-control" name="id_card" wire:model="id_card" />
                                @error('id_card')<span class="text-danger">{{ $message }}</span> @enderror

                                {{-- @if($existing_id_card && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-id_card')">بطاقة الهوية </a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-id_card" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-id_card')">&times;</span>
                                                <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($existing_id_card) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif   --}}
                            </div>
                        </div>
                        
                         <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    <label class="form-label fw-bold" for="phone">   طلب للحصول على </label>
                                    <input type="text" class="form-control" name="supporting_reason" wire:model="supporting_reason"/>
                                    @error('supporting_reason') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="supporting_document"> وثيقة داعمة</label>
                                <input type="file" class="form-control" name="supporting_document" wire:model="supporting_document" />
                                @error('supporting_document')<span class="text-danger">{{ $message }}</span> @enderror

                                @if($existing_supporting_document) 
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-supporting_document')">وثيقة داعمة</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-supporting_document" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-supporting_document')">&times;</span>
                                                <iframe id="pdfViewer-verify-supporting_document" src="{{ generate_signed_storage_url($existing_supporting_document) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div>
                        </div>
                    </div>
                </div>
                <livewire:passport :is_consular="true" :passport="$passport"/>
            <div class="form-group my-3 text-center">
                <button class="btn buttom-effect ">تقديم الطلب</button>
            </div>
            </div>
        </form>
    </div>
    </div>
</div>
<script>
    function showForm()
    {
        const radios = document.getElementsByName("attestation");
        //console.log(radios);
        for (const radio of radios) {
            if (radio.checked) {
               
                if(radio.value == "school")
                {
                    document.getElementById("school").style.display = 'block';
                    document.getElementById("college").style.display = 'none';
                    document.getElementById("other").style.display = 'none';
                    break;
                }
                if(radio.value == "college")
                {
                    document.getElementById("school").style.display = 'none';
                    document.getElementById("college").style.display = 'block';
                    document.getElementById("other").style.display = 'none';
                    break;
                }
                if(radio.value == "other")
                {
                    document.getElementById("school").style.display = 'none';
                    document.getElementById("college").style.display = 'none';
                    document.getElementById("other").style.display = 'block';
                    break;
                }
            
            }
        }
    }
</script>
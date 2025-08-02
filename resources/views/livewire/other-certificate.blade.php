<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="form-div align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('other-certificate.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="othercertificate-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width  bg-ash">
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

                                @if($existing_id_card && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-id_card')">بطاقة الهوية </a></span>
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

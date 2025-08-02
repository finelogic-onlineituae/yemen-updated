<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 border-top">
        <form action="{{ route('passport-name-change.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="passport-name-change-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash shadow">
                <div class="card text-start my-2">

                    <div class="card-body">
                         <div class="row">
                            <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <label class="form-label fw-bold" for="old_name"> </label>
                                <input type="text" class="form-control" name="old_name" wire:model="old_name"/>
                                @error('old_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone">رقم الهاتف المحمول</label>
                                <input type="text" class="form-control" name="phone_number" wire:model="phone_number"/>
                                @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="emirates_id">رقم الهوية الإماراتيةr</label>
                                 <input type="text" class="form-control" id="emiratesIdInput-"  maxlength="17" name="emirates_id" wire:model="emirates_id"/>
                                    <small id="emiratesIdError-" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                                @error('emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="name"> اسم</label>
                                <input type="text" class="form-control" name="name" wire:model="name"/>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="present_passholder">	حامل جواز السفر للوالد الحالي</label>
                                <input type="text" class="form-control" name="present_passholder" wire:model="present_passholder"/>
                                @error('present_passholder') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>                
                        </div>
                        <div class="row">
                             <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="supporting_document">المستندات الداعمة (ملف بي دي إف )</label>
                                <input type="file" class="form-control" name="supporting_document" wire:model="supporting_document" />
                                @error('supporting_document')<span class="text-danger">{{ $message }}</span> @enderror

                                @if($existing_supporting_document && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-supporting_document')">المستندات الداعمة </a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-supporting_document" class="modal">
                                
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-supporting_document')">&times;</span>
                                                <iframe id="pdfViewer-verify-supporting_document" src="{{ generate_signed_storage_url($existing_supporting_document) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div>
                              <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="left_thumb">إصبع الإبهام الأيسر  (ملف بي دي إف )</label>
                                <input type="file" class="form-control" name="left_thumb" wire:model="left_thumb" />
                                @error('left_thumb')<span class="text-danger">{{ $message }}</span> @enderror

                                @if($existing_left_thumb && session()->has('edit_application'))
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-left_thumb')">إصبع الإبهام الأيسر </a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-verify-left_thumb" class="modal">
                                
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-verify-left_thumb')">&times;</span>
                                                <iframe id="pdfViewer-verify-left_thumb" src="{{ generate_signed_storage_url($existing_left_thumb) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div> 
                         
                           
                        </div>
                        <div class="row">
                                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="photo">صورة (jpg,png,jpeg) (200*200)</label>
                                <input type="file" class="form-control" name="photo" wire:model="photo" accept="image/*"/>
                                @error('photo')<span class="text-danger">{{ $message }}</span> @enderror
                                @if ($photo)
                                    @if (in_array($photo->getMimeType(), ['image/jpeg', 'image/png', 'image/jpg']))
                                        <img src="{{ $photo->temporaryUrl() }}" width="150" height="150" class="w-32 h-32 object-cover" />
                                    @else
                                        <p class="text-red-500" style="color:red">Preview not available for this file type.</p>
                                    @endif
                         
                                @elseif ($existing_photo && session()->has('edit_application'))
                                    <!-- Show previously uploaded image if available in session (optional) -->
                                    <div class="form-group mb-2 mt-2">
                                        <img src="{{ generate_signed_storage_url($existing_photo) }}" width="150" height="150" class="border border-2 img-fluid rounded"/>
                                    </div>
                                @endif
                            </div>                        
                        </div>
                    </div>
                </div>


        
              
           

            <livewire:passport :is_consular="true" :passport="$passport"/>
            <div class="form-group my-3 text-center">
                <button class="btn btn-success rounded-0">تقديم الطلب</button>
            </div>
            </div>
        </form>
    </div>
</div>

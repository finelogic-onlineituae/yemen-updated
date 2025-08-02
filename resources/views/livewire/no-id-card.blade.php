<div>
    <div wire:loading style="z-index:1500; position:fixed; top:50%; left:50%;"> 
        <img src="{{ asset('assets/images/loading-2.gif') }}" width="250"/>
    </div>
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('no-id-card.store', $application ? ['application' => $application->id] : '') }}" enctype="multipart/form-data" method="POST" wire:submit.prevent="verifyApplication" id="no-id-card-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center  bg-ash ">
                
                <div class="card text-start my-2">
                    <div class="card-header">
                       المعلومات الشخصية
                    </div>
                    <div class="card-body">
                        <div class="py-2 text-start">
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
                            
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="phone">رقم الهوية الإماراتية</label>
                                <input type="text" class="form-control"  id="emiratesIdInput-"  maxlength="17" name="emirates_id" wire:model="emirates_id"/>
                                  <small id="emiratesIdError-" class="text-danger d-none">Please enter a valid Emirates ID.</small>
                                @error('emirates_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="residance_permit">تصريح الإقامة(  ملف بي دي إف )</label>
                                <input type="file" class="form-control" name="residance_permit" wire:model="residance_permit" />
                                @error('residance_permit')<span class="text-danger">{{ $message }}</span> @enderror

                                @if($existing_residance_permit)
                                <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-residance-permit')">تصريح الإقامة</a></span>
                                        <!-- Modal -->
                                        <div id="pdfModal-residance-permit" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal('pdfModal-residance-permit')">&times;</span>
                                                <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($existing_residance_permit) }}"></iframe>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                @endif  
                            </div>
                        </div>
                    </div>
                </div>
            <livewire:passport :is_consular="true" :passport="$passport"/>
            <div class="card text-start my-2">
                
                <div class="card-body">
                    <div class="py-2 text-start">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <label class="form-label fw-bold" for="name">	يتم تقديم هذه المعلومات إلى</label>
                                <input type="text" class="form-control" name="submitted_to" wire:model="submitted_to"/>
                                @error('submitted_to')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group my-3 text-center">
                @if($passport)
                    <button class="btn buttom-effect">حفظ التغييرات</button>
                @else
                    <button class="btn buttom-effect">تقديم الطلب</button>
                @endif
            </div>
            </div>
        </form>
    </div>
     {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif  --}}
</div>

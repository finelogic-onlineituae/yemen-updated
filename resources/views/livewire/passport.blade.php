<div>
    <div class="card text-start">
        <div class="card-header">
           @if(!$titleRemove)
            معلومات جواز السفر
           @endif
        </div>

        <div class="card-body">
            <div class="row">
                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                  
                    <label class="form-label fw-bold"  for="passport_number">رقم جواز السفر</label>
                    
                    <input @if($useExistingPassport) disabled @endif type="text" id="passportInput-" maxlength="8" class="form-control" name="passport_number" wire:model="passport_number" />
                      <small id="passportError-" class="text-danger d-none"> Please enter a valid Passport Number</small>
                    @error('passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                    <label class="form-label fw-bold" for="issued_by">سلطة الإصدار</label>
                        @if(!$is_consular)
                            <select class="form-select" @if($useExistingPassport) disabled @endif name="issued_by" wire:model="issued_by">
                                <option>Issuing Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->country_code }}" @selected($country->country_code == $issued_by)>{{ $country->country_name.'('.$country->country_code.')' }}</option>
                                @endforeach
                            </select>   
                            @error('issued_by') <span class="text-danger">{{ $message }}</span> @enderror
                        @else
                            <select class="form-select" @if($useExistingPassport) disabled @endif name="passport_center" wire:model="passport_center">
                                <option>Issuing Authority</option>
                                @foreach ($passport_centers as $center)
                                    <option value="{{ $center->id }}" @selected($center->id == $passport_center)>{{ $center->center_name }}</option>
                                @endforeach
                            </select>
                            @error('passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                        @endif
                </div>
            </div>

            <div class="row">
                <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                    <label class="form-label fw-bold" for="issued_on">تاريخ الإصدار</label>
                    <input @if($useExistingPassport) disabled @endif type="date" class="form-control" wire:model="issued_on" id="issued_on" name="issued_on"/>
                    @error('issued_on') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                 
                {{-- <div class="row"> --}}
                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                        <label class="form-label fw-bold" for="expires_on">تاريخ انتهاء الصلاحية</label>
                        <input @if($useExistingPassport) disabled @endif type="date" class="form-control" wire:model="expires_on" id="expires_on" name="expires_on"/>
                        @error('expires_on') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                {{-- </div> --}}
                
                {{-- <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                    <label class="form-label fw-bold" for="attachment"> جواز (ملف بي دي إف  ,jpg, png, jpeg)</label>
                    <input type="file" class="form-control" wire:model="attachment" name="attachment" />
                    @error('attachment') <span class="text-danger">{{ $message }}</span> @enderror

                      @if($existing_attachment)
                      <span><a class="btn btn-dark me-2 rounded-5 mt-3" onclick="openModal('pdfModal-verify-passport')">عرض جواز السفر</a></span>
                            <!-- Modal -->
                            <div id="pdfModal-verify-passport" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal('pdfModal-verify-passport')">&times;</span>
                                     @if(Str::of($existing_attachment)->lower()->endsWith(['.jpg', '.jpeg', '.png', '.webp']))
                                                    <img src="{{ generate_signed_storage_url($existing_attachment) }}"
                                                        alt="Preview"
                                                        style="max-width: 100%;aspect-ratio: 1 / 1;object-fit: cover; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                                @else
                                    <iframe id="pdfViewer-verify-passport" src="{{ generate_signed_storage_url($existing_attachment) }}"></iframe>
                                    @endif
                                </div>
                            </div>
                            <!-- End Modal -->
                    @endif  
                </div> --}}
               
            </div>
           {{--     <div class="form-group mb-3 text-center">
                    <!-- Trigger Button -->
                    <button class="btn btn-dark rounded-0" onclick="event.preventDefault();openModal('pdfModal-existing-passport')">عرض جواز السفر</button>
    
                    <!-- Modal -->
                    <div id="pdfModal-existing-passport" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal('pdfModal-existing-passport')">&times;</span>
                        <iframe id="pdfViewer-existing-passport" src="{{ generate_signed_storage_url($existingPassport) }}"></iframe>
                    </div>
                    </div>
                </div>
              --}}
        </div>

    </div>
</div>
    

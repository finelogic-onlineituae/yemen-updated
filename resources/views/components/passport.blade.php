<div>
    <h5 class="text-light bg-primary p-2 ">معلومات جواز السفر</h5>
                 
    <div class="py-2 text-start">
        @if($existingPassport)
        <div class="form-group mb-3">
            <input class="form-check-input" type="checkbox" name="useExistingPassport" wire:click="togglePassportUsage" id="useExistingPassport" @if($useExistingPassport) checked @endif/>
            <label class="form-label" for="useExistingPassport">استخدم جواز سفري المحفوظ</label>    
        </div>
        @endif
        <div class="form-group mb-3">
            <label class="form-label fw-bold" for="passport_number">رقم جواز السفر</label>
            <input @if($useExistingPassport) disabled @endif type="text" class="form-control" name="passport_number" wire:model="passport_number" value="112763987212" />
            @error('passport_number') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group mb-3">
            <label class="form-label fw-bold" for="issued_by">صادرة عن</label>
            @error('issued_by') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="form-check">
                <input @if($useExistingPassport) disabled @endif class="form-check-input" type="radio" wire:model="issued_by" onclick="toggleTextBox()" name="issued_by" value="The Republic of Yemen" id="issued_by_roy" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                    الجمهورية اليمنية
                </label>
            </div>
            <div class="form-check">
                <input @if($useExistingPassport) disabled @endif class="form-check-input" type="radio" wire:model="issued_by" onclick="toggleTextBox()" name="issued_by" value="United Arab Emirates" id="issued_by_uae">
                <label class="form-check-label" for="flexRadioDefault2">
                    الإمارات العربية المتحدة
                </label>
            </div>
            <div class="form-check">
                <input @if($useExistingPassport) disabled @endif class="form-check-input" type="radio" wire:model="issued_by" onclick="toggleTextBox()" name="issued_by" value="other" id="issued_by_other">
                <label class="form-check-label" for="flexRadioDefault2">
                    آخر
                </label>
                <input @if($useExistingPassport) disabled @endif type="text" class="form-control" wire:model="issued_by_other" name="issued_by_other" id="other_text" value="" required @if($issued_by !== 'other') disabled @endif/>
            </div>
        </div>

        <div class="form-group mb-3">
            <label class="form-label fw-bold" for="issued_on">صدر بتاريخ</label>
            <input @if($useExistingPassport) disabled @endif type="date" class="form-control" wire:model="issued_on" id="issued_on" name="issued_on"/>
            @error('issued_on') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        @if($useExistingPassport)
            
            <div class="form-group mb-3">
                <!-- Trigger Button -->
                <button class="btn btn-dark" onclick="event.preventDefault();openModal('pdfModal-existing-passport')">عرض جواز السفر</button>

                <!-- Modal -->
                <div id="pdfModal-existing-passport" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('pdfModal-existing-passport')">&times;</span>
                    <iframe id="pdfViewer-existing-passport" src="{{ asset('storage/'.$existingPassport) }}"></iframe>
                </div>
                </div>
            </div>
        @else
        <div class="form-group mb-3">
            <label class="form-label fw-bold" for="attachment">تحميل جواز السفر</label>
            <input type="file" class="form-control" wire:model="attachment" name="attachment" />
            @error('attachment') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        @endif
        <div class="form-group mb-3 text-center">
            <button class="btn btn-success">@if(!$useExistingPassport) حفظ جواز السفر & @endif التالي</button>
        </div>
    </div>
</div>
</div>
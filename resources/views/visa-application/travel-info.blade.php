<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center"> التقدم بطلب للحصول على تأشيرة جديدة</h2>
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="travel_document_number">رقم وثيقة السفر</label>
                                <input type="text" name="travel_document_number" required>
                                @error('travel_document_number') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="travel_document_attachment">رقم وثيقة السفر</label>
                                <input type="file" name="travel_document_attachment" required>
                                @error('travel_document_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0 mb-md-0">
                                <label class="form-label fw-bold" for="coming_from">الحالة الاجتماعية</label>
                                <select name="coming_from" wire:model="coming_from" class="form-select">
                                    <option value="">الحالة الاجتماعية</option>
                                    <option value="married">Married</option>
                                    <option value="single">Single</option>
                                    <option value="divorced">Divorced</option>
                                </select>
                                @error('coming_from') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
        </div>
    </div>
            <div class="form-group my-3 text-center">
                 <a class="btn buttom-effect" href="{{ route('visa-application.travel') }}">تقديم الطلب</a>
            </div> 
            </div>
        </form>
    </div>
</div>



</x-app-layout>


<script>
    Livewire.on('submitVisaApplicationForm', () => {
        document.getElementById('visa-application-form').submit();
    });
</script>

<script>
// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];
  // Set max attribute to today's date
  document.getElementById('issued_on').setAttribute('max', today);
 // document.getElementById('beneficiary_issued_on').setAttribute('max', today);


  
</script>


<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h3 class="text-success w-100 text-center">إصدار إفادة إعالة، يرجى تعبئة جميع الحقول الإلزامية لإتمام الطلب</h3>
    <div>
    
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form mh-100 h-100 ">
        <form action="{{ route('power-of-attorney.store') }}" enctype="multipart/form-data" method="POST" id="power-of-attorney-form" class="w-100 align-items-center text-center d-flex justify-content-center">
            @csrf
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                
                <div class="card text-start my-2">
                    <div class="card-header">
                       بيانات الموكل
                    </div>
                      <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="client_name">الاسم الكامل (كما هو مذكور في جواز السفر)</label>
                                        <input type="text" class="form-control" name="client_name"/>
                                        @error('client_name')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="nationality">الجنسية</label>
                                        <select class="form-select" name="nationality">
                                            <option value="">Choose a Country</option>
                                            @forelse ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                        @error('nationality')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                    
                                        <label class="form-label fw-bold"  for="passport_number">رقم جواز السفر</label>
                                        
                                        <input type="text" id="passportInput-" maxlength="8" class="form-control" name="passport_number" />
                                        <small id="passportError-" class="text-danger d-none"> Please enter a valid Passport Number</small>
                                        @error('passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="passport_center">جهة الإصدار</label>
                                        <select class="form-select" name="passport_center">
                                            <option>Issuing Authority</option>
                                            @foreach ($passport_centers as $center)
                                                <option value="{{ $center->id }}">{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('passport_center') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="issued_on">تاريخ إصدار جواز السفر</label>
                                        <input type="date" min="1900-01-01" max="2099-12-31" class="form-control" name="issued_on"/>
                                        @error('issued_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                        <label class="form-label fw-bold" for="expire_on">تاريخ انتهاء جواز السفر</label>
                                        <input type="date" min="1900-01-01" max="2099-12-31" class="form-control" id="expire_on" name="expire_on"/>
                                        @error('expire_on')<span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                            
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="passport_attachment">نسخة من جواز السفر (pdf ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="passport_attachment"/>
                                @error('passport_attachment')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="emirate_id_attachment">نسخة من الهوية الاماراتيه(pdf ,jpg, png, jpeg)</label>
                                <input type="file" class="form-control" name="emirate_id_attachment"/>
                                @error('emirate_id_attachment')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                                
                            </div>
                        </div>
                
               
               
            <div class="card text-start my-2">
                <div class="card-header">
                   	بيانات الوكيل
                </div>
                <div class="card-body">
                    {{-- Agent Passport --}}

                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_name">	اسم الوكيل</label>
                                <input type="text" class="form-control" name="agent_name" required/>
                                @error('agent_name')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_id_number">رقم البطاقة الشخصية/ رقم جواز السفر</label>
                                <input type="text" class="form-control" name="agent_id_number"required/>
                                @error('agent_id_number')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                           
                        </div>
                        <div class="row">
                            
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="purpose">	الغرض من الوكالة</label>
                                <input type="text" class="form-control" name="purpose" required/>
                                @error('purpose')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="poa_document">	يرجى إرفاق صورة من سند الملكية أو أي وثيقة ذات صلة بالوكالة</label>
                                <input type="file" class="form-control" name="poa_document" required/>
                                @error('poa_document')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-6 col-xl-6 col-md-6 col-sm-12">
                                <label class="form-label fw-bold" for="agent_id_attachment">	تحميل الهوية / جواز السفر</label>
                                <input type="file" class="form-control" name="agent_id_attachment" required/>
                                @error('agent_id_attachment')<span class="text-danger">{{ $message }}</span> @enderror
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

</div>



</x-app-layout>




<script>
// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];
  // Set max attribute to today's date
  document.getElementById('issued_on').setAttribute('max', today);
</script>


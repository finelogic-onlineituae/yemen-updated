<x-app-layout>
    <x-slot name="header">
        <div class="w-100 text-center">
        <h2 class="">
            {{ __('طلب الحصول على شهادة الميلاد') }}
        </h2>
        <p>( على أساس جواز السفر )</p>
    </div>
    </x-slot>
    <h2 class="text-success w-100 text-center" >الشهادات</h2>
<div>
    
    <div class="align-items-center text-center d-flex justify-content-center w-100 p-2 bg-form ">
         
           
            <div class="manage-width-75 manage-width p-3 mx-2 rounded  align-items-center text-center form-scroll bg-ash ">
                <div class="card text-start my-2">
                    <div class="card-body">
                        <div class="row g-3 justify-content-center">
                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="{{ route('attestation.create') }}" class="att-card d-block text-decoration-none border rounded  text-center">
                                    <div><img src="{{ asset('assets/images/icons/Authentication-of-academic-certificates.png') }}" width="50"></div>
                                    <div>تصديق الشهادات الدراسية</div>
                                </a>
                            </div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="{{ route('attestation.create') }}" class="att-card d-block text-decoration-none border rounded  text-center">
                                    <div><img src="{{ asset('assets/images/icons/Marriage-contract-certification.png') }}" width="50"></div>
                                    <div>تصديق عقد الزواج</div>
                                </a>
                            </div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="{{ route('attestation.create') }}" class="att-card d-block text-decoration-none border rounded  text-center">
                                    <div><img src="{{ asset('assets/images/icons/birth-certificates.png') }}" width="50"></div>
                                    <div>شهادات الميلاد</div>
                                </a>
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center my-2">
                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="{{ route('attestation.create') }}" class="att-card d-block text-decoration-none border rounded  text-center">
                                    <div><img src="{{ asset('assets/images/icons/Medical-examination-results-certification.png') }}" width="50"></div>
                                    <div>تصديق نتيجة الفحص الطبي</div>
                                </a>
                            </div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="{{ route('attestation.create') }}" class="att-card d-block text-decoration-none border rounded  text-center">
                                    <div><img src="{{ asset('assets/images/icons/Certificate-of-good-conduct-certification.png') }}" width="50"></div>
                                    <div>تصديق شهادة حسن السيرة والسلوك</div>
                                </a>
                            </div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="{{ route('attestation.create') }}" class="att-card d-block text-decoration-none border rounded  text-center">
                                    <div><img src="{{ asset('assets/images/icons/Authentication-of-legal-and-legitimate-agencies.png') }}" width="50"></div>
                                    <div>تصديق الوكالات الشرعية والقانونية</div>
                                </a>
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center my-2">
                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="{{ route('attestation.create') }}" class="att-card d-block text-decoration-none border rounded text-center">
                                    <div><img src="{{ asset('assets/images/icons/Authentication-of-judicial-rulings.png') }}" width="50"></div>
                                    <div>تصديق الأحكام القضائية</div>
                                </a>
                            </div>

                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="{{ route('attestation.create') }}" class="att-card d-block text-decoration-none border rounded text-center">
                                    <div><img src="{{ asset('assets/images/icons/Authentication-of-other-documents.png') }}" width="50"></div>
                                    <div>تصديق الوثائق الأخرى</div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        
    </div>
</div>
<script>
function enableSubmit()
{
    document.getElementById("submit-btn").disabled = false;
    }
</script>
</x-app-layout>
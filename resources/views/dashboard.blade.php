<x-app-layout>
    <x-slot name="header">
        <h2 class="w-100 text-center">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>      
    <div class="d-flex flex-column justify-content-start justify-content-sm-center w-100 mt-3">
        <h5 class="w-100 d-flex px-2 text-primary bg-ash mb-0 py-2">الخدمات القنصلية</h5>

        <div class="d-flex flex-column align-items-lg-start flex-md-row flex-md-lg flex-md-xl w-100">
            <div class="card service-card mx-2 my-2  p-2 ">
                <img class="card-image img-fluid rounded-top " src="{{ asset('assets/images/visa.webp') }}" alt="Card image cap">
                {{--                 <div class="display-1 text-danger w-100 text-center"><i class="bi bi-person-check"></i></div> --}}
                                    <a data-bs-toggle="collapse" onclick="toggleCollapseButton(this)" href="#visa-services-dashboard" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="card-header fw-bold d-flex justify-content-between">
                                            خدمات التأشيرات
                                        
                                                <i class="bi bi-plus-circle-fill" ></i>
                                        </div>
                                    </a>

                                <div class="collapse" id="visa-services-dashboard">
                                    <ul class="list-group list-group-flush">
                                   <li class="list-group-item"><a href="/applications/visa-application" class="text-decoration-none">	التقدم بطلب للحصول على تأشيرة جديدة</a></li>
                                        {{-- <li class="list-group-item"><a href="#" class="text-decoration-none">	قواعد ولوائح التأشيرة</a></li> --}}
                                    </ul>
                                </div>
            </div>
            <div class="card service-card  mx-2 my-2  p-2 ">
                <img class="card-image img-fluid rounded-top" src="{{ asset('assets/images/passport.jpeg') }}" alt="Card image cap">
                    <a data-bs-toggle="collapse" onclick="toggleCollapseButton(this)" href="#passport-services-dashboard" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="card-header fw-bold d-flex justify-content-between ">
                        خدمات الجوازات
                                <i class="bi bi-plus-circle-fill" ></i>
                        </div> 
                    </a>

                <div class="collapse" id="passport-services-dashboard">
                    <ul class="list-group list-group-flush">
                     <li class="list-group-item"><a href="/applications/renew-passport-above" class="text-decoration-none">تجديد جواز السفر لمن هم فوق سن 18 عامًا</a></li>
                    <li class="list-group-item"><a href="/applications/renew-passport-below" class="text-decoration-none">	تجديد جواز السفر (أقل من 18 عامًا)</a></li>
                    <li class="list-group-item"><a href="/applications/new-passport" class="text-decoration-none">جواز سفر جديد</a></li>
                    <li class="list-group-item"><a href="/applications/damaged-passport" class="text-decoration-none">جواز السفر التالف</a></li>
                    <li class="list-group-item"><a href="/applications/loss-passport" class="text-decoration-none">فقدان جواز السفر</a></li>
                     <li class="list-group-item"><a href="/applications/no-objection-certification" class="text-decoration-none">شهادة عدم ممانعة </a></li>
                    {{-- <li class="list-group-item"><a href="/applications/passport-name-change" class="text-decoration-none">تغيير الاسم في جواز السفر</a></li> --}}
                    </ul>
                </div>
            </div>
           

        

        </div>
        <div class="d-flex flex-column align-items-lg-start flex-md-row flex-md-lg flex-md-xl w-100">
            
            <div class="card service-card  mx-2 my-2  p-2 ">
                              <img class="card-image img-fluid rounded-top" src="{{ asset('assets/images/relation.webp') }}" alt="Card image cap">
                                <a data-bs-toggle="collapse" onclick="toggleCollapseButton(this)" href="#relationship-documents-dashboard" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <div class="card-header fw-bold d-flex justify-content-between ">
                                        الشهادات
                                            <i class="bi bi-plus-circle-fill" ></i>
                                    </div>
                                </a>

                                <div class="collapse" id="relationship-documents-dashboard">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a href="/applications/birth-certificate" class="text-decoration-none">شهادة إثبات الولادة</a></li>
                                        <li class="list-group-item"><a href="/applications/driving-licence" class="text-decoration-none">تأكيد رخصة القيادة</a></li>
                                        <li class="list-group-item"><a href="/applications/no-id-card" class="text-decoration-none">شهادة عدم وجود بطاقة هوية</a></li>
                                       
                                        <li class="list-group-item"><a href="/applications/support-statement" class="text-decoration-none">شهادة التبعية </a></li>
                                        {{-- <li class="list-group-item"><a href="/applications/family-member" class="text-decoration-none">طلب لأفراد العائلة (بدون هوية)</a></li> --}}

                                        {{-- <li class="list-group-item"><a href="#" class="text-decoration-none">لشهادة عدم وجود بطاقة هوية للمجموعة</a></li> --}}
                                    <li class="list-group-item"><a href="/applications/marriage-certificate" class="text-decoration-none">شهادة الزواج</a></li>
                                    {{-- <li class="list-group-item"><a href="#" class="text-decoration-none">Dependancy Certificate</a></li> --}}
                                    <li class="list-group-item"><a href="/applications/family-member" class="text-decoration-none">شهادة القرابة</a></li>
                            <li class="list-group-item"><a href="/applications/no-id-card-group" class="text-decoration-none"> شهادة عدم وجود بطاقة هوية(مجموعة)</a></li>


                                    {{-- <li class="list-group-item"><a href="#" class="text-decoration-none">شهادة القرابة</a></li>
                                    <li class="list-group-item"><a href="#" class="text-decoration-none">شهادة قرابة لمجموعة</a></li> --}}
                                    </ul>
                                </div>
            </div>
                <div class="card service-card  mx-2 my-2  p-2 ">
                    <img class="card-image img-fluid rounded-top" src="{{ asset('assets/images/others.webp') }}" alt="Card image cap">
                    {{--                 <div class="display-1 text-danger w-100 text-center"><i class="bi bi-person-check"></i></div> --}}
                                    <a data-bs-toggle="collapse" href="#other-documents-dashboard" onclick="toggleCollapseButton(this)" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="card-header fw-bold d-flex justify-content-between ">
                                            توكيل
                                            
                                                <i class="bi bi-plus-circle-fill" ></i>
                                        </div>
                                    </a>

                                    <div class="collapse" id="other-documents-dashboard">
                                        <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a href="/applications/power-of-attorney" class="text-decoration-none">	توكيل </a></li>
                                        {{-- <li class="list-group-item"><a href="#" class="text-decoration-none">لا شهادة مدرسية</a></li> --}}
                                        </ul>
                                    </div>
                </div>

        </div>
        <div class="d-flex flex-column align-items-center flex-md-row flex-md-lg flex-md-xl w-100">
            <div class="card service-card  mx-2 my-2  p-2 ">
                    <img class="card-image img-fluid rounded-top" src="{{ asset('assets/images/attachements.webp') }}" alt="Card image cap">
                    {{--                 <div class="display-1 text-danger w-100 text-center"><i class="bi bi-person-check"></i></div> --}}
                                    <a data-bs-toggle="collapse" href="#attachements-documents-dashboard" onclick="toggleCollapseButton(this)" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="card-header fw-bold d-flex justify-content-between ">
                                            تصديق
                                            
                                                <i class="bi bi-plus-circle-fill" ></i>
                                        </div>
                                    </a>

                                    <div class="collapse" id="attachements-documents-dashboard">
                                        <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a href="/applications/school-certificate" class="text-decoration-none">	شهادة مدرسية </a></li>
                              <li class="list-group-item"><a href="/applications/university-certificate" class="text-decoration-none"> شهادة جامعية</a></li>
                              <li class="list-group-item"><a href="/applications/other-certificate" class="text-decoration-none"> شهادة أخرى</a></li>


                                        {{-- <li class="list-group-item"><a href="#" class="text-decoration-none">لا شهادة مدرسية</a></li> --}}
                                        </ul>
                                    </div>
            </div>
        </div>

</div>
</x-app-layout>

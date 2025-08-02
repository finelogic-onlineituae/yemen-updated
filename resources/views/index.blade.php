@extends('layouts.home-app')
@section('content')
    <x-slot name="header">
        <h2 class="w-100 text-center">
            {{-- {{ __('Home Page') }} --}}
        </h2>
    </x-slot>
        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="image-overlay-wrapper position-relative">
                        <img src="{{ asset('assets/images/header.webp') }}" class="img-fluid image-fade-top-bottom bg-image" />
                        <div class="top-image d-flex flex-column justify-content-center ">
                            {{-- <img src="{{ asset('assets/images/logo.png') }}" class="h-25" /> --}}
                            <div class="banner-text1">
                                <h4>بوابتك الرسمية إلى</h4>
                                <h5>لخدمات السفارة اليمنية </h5>
                                <h4>في الإمارات العربية المتحدة</h4>
                                <p class="text-p">تقدم بطلبك عبر الإنترنت للحصول على جوازات السفر والتأشيرات والشهادات وغيرها </p>
                                <p> - خدمة آمنة وسريعة، بدعم حكومي في متناول يدك.</p>
                            </div>
                {{--                 <a href="#" class="p-1 rounded rounded-4 text-decoration-none bg-golden text-white fs-">Learn More</a> --}}

                        </div>
                    </div>
            
                </div>
                <div class="carousel-item">
                    <div class="image-overlay-wrapper position-relative">
                        <img src="{{ asset('assets/images/header2.webp') }}" class="img-fluid image-fade-top-bottom bg-image" />
                        <div class="top-image d-flex flex-column justify-content-center ">
                            {{-- <img src="{{ asset('assets/images/logo.png') }}" class="h-25" /> --}}

                              <div class="banner-text2">
                                <h4>تسهيل</h4>
                                <h5>خدمات السفارة اليمنية</h5>
                                <h4>للمواطنين والزوار</h4>
                                <p class="text-p">سجّل الآن واحصل على خدمات جوازات السفر  الرسمية والتأشيرات </p>
                                <p>والشهادات  - كل ذلك عبر بوابة إلكترونية واحدة موثوقة</p>
                            </div>
                {{--                 <a href="#" class="p-1 rounded rounded-4 text-decoration-none bg-golden text-white fs-">Learn More</a> --}}

                        </div>
                    </div>
            
                </div>
            
            </div>
            <div class="banner-button">
                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div> 

        </div> 


<div class="home-content container">
<div class="home-content1">
    <div class="mt-0 p-0">
        <h3 class="w-100 text-success">	خدمات</h3>
        <p >هذه هي البوابة الرسمية لدعوة طلبات  إلى سفارة الجمهورية اليمنية،في دولة الإمارات العربية المتحدة.فيما يلي الخدمات المتاحة عبر الإنترنت للمواطنين اليمنيين في الإمارات العربية المتحدة,والمواطنين الأجانب في السفارة اليمنية في ،الإمارات العربية المتحدة.يمكنك التقدم بطلب للحصول على أي من الخدمات التالية بعد التسجيل في هذه البوابة.</p>  
    </div>
</div>

    <div class="d-flex flex-column justify-content-center  align-items-center justify-content-sm-center w-100 mt-3">
        
            <div class="d-flex flex-column justify-content-center align-items-lg-start align-items-center flex-md-row flex-md-lg flex-md-xl w-100">
                
                <div class="card service-card  mx-2 my-2  p-2 ">
                    <div class="img-section">
                        <img class="card-image img-fluid rounded-top" src="{{ asset('assets/images/passport.jpeg') }}" alt="Card image cap">
                    </div>
                        <a data-bs-toggle="collapse" href="#passport-services-dashboard" onclick="toggleCollapseButton(this)" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <div dir="rtl" class="card-header fw-bold d-flex justify-content-between ">
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
                    <div class="card service-card mx-2 my-2  p-2 ">
                        <div class="img-section">
                            <img class="card-image img-fluid rounded-top " src="{{ asset('assets/images/visa.webp') }}" alt="Card image cap">
                        </div>
                        {{--                 <div class="display-1 text-danger w-100 text-center"><i class="bi bi-person-check"></i></div> --}}
                                        <a data-bs-toggle="collapse" href="#visa-services-dashboard" onclick="toggleCollapseButton(this)" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <div dir="rtl" class="card-header fw-bold d-flex justify-content-between ">
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
                </div>
            

            </div>
            <div class="d-flex flex-column align-items-center align-items-lg-start justify-content-center flex-md-row flex-md-lg flex-md-xl w-100">
                <div class="card service-card  mx-2 my-2  p-2 ">
                    <div class="img-section">
                        <img class="card-image img-fluid rounded-top" src="{{ asset('assets/images/others.webp') }}" alt="Card image cap">
                    </div>
                    {{--                 <div class="display-1 text-danger w-100 text-center"><i class="bi bi-person-check"></i></div> --}}
                                    <a data-bs-toggle="collapse" href="#other-documents-dashboard" onclick="toggleCollapseButton(this)" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div dir="rtl" class="card-header fw-bold d-flex justify-content-between ">
                                        توكيل
                                            
                                                <i class="bi bi-plus-circle-fill" ></i>
                                        </div>
                                    </a>

                                    <div class="collapse" id="other-documents-dashboard">
                                        <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a href="/applications/power-of-attorney" class="text-decoration-none">	توكيل </a></li>
                                        {{-- <li class="list-group-item"><a href="#" class="text-decoration-none">	لا شهادة مدرسية</a></li> --}}
                                        </ul>
                                    </div>
                </div>
                <div class="card service-card  mx-2 my-2  p-2 ">
                    <div class="img-section">
                        <img class="card-image img-fluid rounded-top" src="{{ asset('assets/images/relation.webp') }}" alt="Card image cap">
                    </div>
                    <a data-bs-toggle="collapse" href="#relationship-documents-dashboard" onclick="toggleCollapseButton(this)" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div dir="rtl" class="card-header fw-bold d-flex justify-content-between  ">
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
              
            </div>
        
            <div class="d-flex flex-column align-items-center align-items-lg-start justify-content-center flex-md-row flex-md-lg flex-md-xl w-100">


                <div class="card service-card  mx-2 my-2  p-2 ">
                    <div class="img-section">
                        <img class="card-image img-fluid rounded-top" src="{{ asset('assets/images/attachements.webp') }}" alt="Card image cap">
                    </div>
                    <a data-bs-toggle="collapse" href="#attachment-documents-dashboard" onclick="toggleCollapseButton(this)" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div dir="rtl" class="card-header fw-bold d-flex justify-content-between  ">
                          تصديق
                        <i class="bi bi-plus-circle-fill" ></i>
                          
                              
                      </div>
                          </a>

                      <div class="collapse" id="attachment-documents-dashboard">
                          <ul class="list-group list-group-flush">
                              <li class="list-group-item"><a href="/applications/school-certificate" class="text-decoration-none"> شهادة مدرسية</a></li>
                              <li class="list-group-item"><a href="/applications/university-certificate" class="text-decoration-none"> شهادة جامعية</a></li>
                              <li class="list-group-item"><a href="/applications/other-certificate" class="text-decoration-none"> شهادة أخرى</a></li>


                             
                          </ul>
                      </div>
                </div>
            </div>

        <div class="mx-2 w-100">
            <div class="my-2 border border-2 rounded-3 d-flex flex-column flex-lg-row fles-md-row flex-xl-row bg-golden">
                <div class="">
                    <img src="{{ asset('assets/images/phone.jpg') }}" class="img-fluid" style="height:100px;"   />
                </div>                
                <div class="text-white d-flex justify-content-center flex-column flex-lg-row flex-md-row align-items-start w-100 pt-2">
                    <div class="px-3 px-sm-2  align-items-center"><h1>	هل تحتاج مساعدة؟</h1>	إذا كنت بحاجة إلى مساعدة، يرجى الاتصال</div>
                    <div class="px-2 px-sm-2 align-items-center d-flex justify-content-center"><button class="btn bg-white text-dark fw-bold m-3">	تواصل معنا</button></div>
                </div>
                    
            </div>
        </div>
    </div>
    {{-- <div>
        <section id="call-to-action">
        <div class="container text-center" data-aos="zoom-in">
            <h3>	هل تحتاج مساعدة؟</h3>
            <p>	إذا كنت بحاجة إلى مساعدة، يرجى الاتصال</p>
            <a class="cta-btn" href="#">	تواصل معنا</a>
        </div>
        </section>
    </div> --}}

</div>
 
@endsection

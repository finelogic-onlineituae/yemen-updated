<!DOCTYPE html>
<html @auth  lang="ar" dir="rtl" @else lang="en" dir="ltr"  @endauth>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        
{{--         <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/newstyle.css') }}" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <link href="{{ asset('assets/css/modal.css') }}" rel="stylesheet" />
        
 
       
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-...your-integrity..." crossorigin="anonymous" referrerpolicy="no-referrer" />


        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Croppie JS & CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>


    </head>
    <body>

    {{-- Add this if you're going to use @push('scripts') in child views --}}

        <div class="container-fluid p-0">        
            <div class="header-container d-flex align-items-center justify-content-center">
                <div class="header-content">
                @include('layouts.app-navigation')
                </div>
            </div>

            <div class="content-container">
              
            
                
                    <!-- Main Content -->
                    <div class="main-content   rounded pb-0 mx-2 mb-2">
{{--                         {{ $header ? $header : '' }} --}}
                        @yield('content')
                    </div>
            </div>
        </div>
            <div class="footer-container d-flex justify-content-center align-items-center container-fluid p-0 m-0">
                <footer class="container-fluid p-0 m-0">
                <div class="footer">
 
                        <div class=" footer-section-div row align-items-center text-center top-bar p-2">
                            <!-- Menu Button (hidden on large screens) -->
                            <div class="col-lg-6 col-md-6 col-sm-6 d-flex flex-sm-row flex-md-row flex-lg-row flex-xl-row align-items-center justify-content-center">
                              <img src="{{ asset('assets/images/logo.png') }}" class=" footer-logo img-fluid" />
                              @auth
                              <div class="border-start ps-2   border-2 border-sm-0 pe-2 fw-bold border-sm-0 text-start">سفارة <br>الجمهورية اليمنية<br> في الإمارات العربية المتحدة</div>
                                @else
                                
                                <div class="border-end pe-2  border-2 border-sm-0 pe-2 fw-bold border-sm-0 text-end">سفارة <br>الجمهورية اليمنية<br> في الإمارات العربية المتحدة</div>
                              @endauth

                            </div>
                              
                          {{--     <button class="btn toggle-btn" id="menuToggle">☰</button> --}}
                          <div class="col-lg-6 col-md-6 col-sm-12 d-flex gap-4 flex-column flex-lg-row flex-xl-row justify-content-start pt-5">
                            <div>
                                <ul class="list-unstyled text-end align-items-center">
                                    <li><h4>	المعلومات القانونية</h4></li>
                                    <li><a href="#" class="text-decoration-none text-white">	الشروط والأحكام</a></li>
                                    <li><a href="#" class="text-decoration-none text-white">	سياسة الخصوصية</a></li>
                                </ul>    
                            </div>
                            <div>
                                <ul class="list-unstyled text-end align-items-center">
                                  @auth
                                    <li  style="text-align:right"><h4>	تواصل معنا</h4></li>
                                    @else
                                    <li><h4>	تواصل معنا</h4></li>
                                    @endauth

                                    <li class="d-flex"><span class="text-success px-1"><i class="bi bi-telephone-fill"></i> </span><span>+971 - 999999999</span></li>
                                    <hr>
                                    <li class="d-flex"><span class="text-success px-1"><i class="bi bi-geo-alt-fill"></i> </span><span>شارع الشيخ راشد بن سعيد<br>حي السفارات _ابوظبي <br>الإمارات العربية المتحدة</span></li>
                                    <hr>
                                </ul>    
                            </div>
                          </div>
                          </div>
                          <div class="text-center">
                            <p>حقوق الطبع والنشر © 2025 سفارة اليمن لدى الإمارات العربية المتحدة</p>
                            <p class="mb-0 pb-2">جميع الحقوق محفوظة</p>
                        </div>
                    </div>
                </footer>
            </div>
       

       @stack('scripts')
    </body>

   <script src="{{ asset('assets/js/custom.js') }}"></script>
   <script src="{{ asset('assets/js/modal.js') }}"></script>
        <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>







</html>

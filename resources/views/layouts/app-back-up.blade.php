<!DOCTYPE html>
<html @auth lang="ar" dir="rtl" @else lang="en" dir="ltr"  @endauth>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        
{{--         <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <link href="{{ asset('assets/css/modal.css') }}" rel="stylesheet" />
 
        @livewireStyles
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        @livewireScripts

    </head>
    <body class="mb-2">
        
{{--         <div class="w-75 mx-auto">
            @include('layouts.navigation')

            <!-- Page Heading -->
            


                    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-right" style="width:200px;right:0;" id="mySidebar">
                        <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
                        <ul class="list-unstyled application-menu ">

                            <li><a href="{{ route('visa.create') }}" class="text-light text-decoration-none">Visa Application</a></li>
                            <li><a href="#" class="text-decoration-none">Relationship Certificate</a></li>
                            <li><a href="#" class="text-light text-decoration-none">No Id Holding Certificate</a></li>
                            <li><a href="{{ route('birth-certificate.create') }}" class="text-light text-decoration-none">Birth Certificate</a></li>
                            <li><a href="#" class="text-light text-decoration-none">شهادة أخرى</a></li>
                            <li><a href="{{ route('applications.index') }}" class="text-light text-decoration-none">Your Applications</a></li>
                            <li><a href="#" class="text-light text-decoration-none">Your Passport</a></li>
                        </ul>
                      </div>
                        
                    
                 
                  
                  
                
 
            <div class="w3-main" style="margin-right:200px; height: 600px; overflow-y: scroll">
                <div class="w3-teal">
                  <button class="w3-button w3-teal w3-xlarge w3-right w3-hide-large" onclick="w3_open()">&#9776;</button>
                  <div class="w3-container">
                    <h1>My Page</h1>
                  </div>
                </div>

                </div>
            --}} 
            <div class="header-container">
                @include('layouts.app-navigation')
            </div>

            <div class="content-container">
                @auth
                <!-- Sidebar (inside container with margin on large screens) -->
                
                    <div class="sidebar" id="sidebar">
                        <button class="close-btn" id="closeSidebar">✖</button>
                        <a href="/applications/birth-certificate">شهادة إثبات الولادة</a>
                        <a href="{{ route('visa.create') }}">طلب التأشيرة</a>
                        <a href="#">شهادة الزواج</a>
                        <a href="#">تأكيد رخصة القيادة</a>
                        <a href="#">شهادة التبعية</a>
                        <a href="#">إثبات القضية</a>
                        <a href="#">إثبات القرابة</a>
                        <a href="#">شهادة لتأكيد نفس الشخص</a>
                        <a href="#">لا يوجد بطاقة هوية (متعددة)</a>

                        
                        {{-- <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    
                                </li>

                            </ul>
                        </li>
                    </ul> --}}
                        
                    </div>

            @endauth
            
                
                    <!-- Main Content -->
                    <div class="main-content">
{{--                         {{ $header ? $header : '' }} --}}
                        {{$slot}}
                    </div>
                </div>
            
    </body>
    <script>
const sidebar = document.getElementById('sidebar');
    const menuToggle = document.getElementById('menuToggle');
    const closeSidebar = document.getElementById('closeSidebar');

    menuToggle.addEventListener('click', () => {
        sidebar.classList.add('active');
    });

    closeSidebar.addEventListener('click', () => {
        sidebar.classList.remove('active');
    });
    </script>
    
</html>

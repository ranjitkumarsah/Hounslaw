<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('public/js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/login_page.css') }}" rel="stylesheet">



    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('public/logo/logo.png')}}" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        
        <footer class="footer pt-0 px-3 pb-3 justify-content-between">
            <div class="row pt-3  justify-content-center footer-one-section text-white">
                <div class="col-sm-6 col-lg-3 col-md-6">
                    <div class="row my-3 profile">
                        <div class="col-4 text-right  border-right border-secondary">
                            <img src="{{asset('public/images/profile_img.png')}}" alt="" class="rounded-circle" width="75px" height="75px">
                        </div>
                        <div class="col-8 pr-0">
                            <p class="text-left">
                                Hello everyone! <br> I wanted to take a moment to introduce myself. My name is Adam, and I'm the CEO of this company. please email me directly if you have any question. <br> Thank you
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 col-md-6 location">
                    <div class="row my-3 ">
                        <div class="col-4 pl-0 text-right  border-right border-secondary">
                            <i class="fa-solid fa-location-dot" aria-hidden="true" style="font-size: 2em;"></i>
                        </div>
                        <div class="col-8 ">
                            <div class="location-header ">
                                
                                <h5 class="text-white fw-bold">OFFICE LOACTION</h5>
                                <p class="text-left">Digital Passport Photo For Online Application UK 756F bath Rd Cranford Middlesex TW5 9TY</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 col-md-6">
                    <div class="row my-3 ">
                        <div class="col-4 text-right  border-right border-secondary">
                            <i class="fa-solid fa-earth-asia" aria-hidden="true" style="font-size: 2em;"></i>
                        </div>
                        <div class="col-8 ">
                            <div class="contact-us ">
                                
                                <h5 class="text-white fw-bold">CONTACT US</h5>
                                <a href="mailto:contact@hounslowpassportphotoshop.co.uk" class="text-break text-white mr-2 mt-1"><i class="fa fa-envelope" aria-hidden="true" style="float: left; margin-right: 6px; margin-top: 6px;"></i> contact@hounslowpassportphotoshop.co.uk</a><br>
                                <a href="tel:07553949353" class="text-white"><i class="fa fa-phone" aria-hidden="true"></i> 07553949353</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 col-md-6">
                    <div class="row my-3  ">
                        <div class="col-4 text-right  border-right border-secondary">
                            <i class="fa-solid fa-calendar-days" aria-hidden="true" style="font-size: 2em;"></i>
                        </div>
                        <div class="col-8 ">
                            <div class="timing-calendar  ">
                                
                                <h5 class="text-white fw-bold">OPENING TIMES</h5>
                                <p class="text-left">
                                    <span class="d-block">Monday 10.00-7:30pm</span>
                                    <span class="d-block">Tuesday 10:00-7:30pm</span>
                                    <span class="d-block">Wednesday 10:00-7:30pm</span>
                                    <span class="d-block">Thursday 10:00-7:30pm</span>
                                    <span class="d-block">Friday 10:00-7:30pm</span>
                                    <span class="d-block">Saturday 10:00-7:30pm</span>
                                    <span class="d-block">Sunday 10.00-7:30pm</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="row pt-3">
                <div class=" col-sm-6 col-md-6">
                    <span class="text-white">Copyright © 2022-2023 All Rights Reserved by HOUNSLOW.</span>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="lg-footer-right">
                        <span class="text-white">Powered by</span>
                        <a href="https://protolabzit.com/" class="text-primary" target="_blank">Protolabz eServices</a>
                    </div>
                    
                </div>
            </div>
            
        </footer>
    </div>
    <!-- <script src="https://unpkg.com/dropzone"></script> -->
    <script src="https://unpkg.com/cropperjs"></script>
</body>
</html>

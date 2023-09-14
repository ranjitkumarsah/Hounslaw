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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
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
                    {{--        
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
                    --}}
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')

            
                   
            <!-- Email Functionality -->
            <button class="btn btn-success support_btn" data-bs-toggle="modal" data-bs-target="#emailModal" data-bs-whatever="@getbootstrap"><i class="fa fa-envelope" aria-hidden="true"></i> Need Help?</button>

            <form id="sendEmail">
                @csrf
                <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="emailModalLabel">Send Query</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Your Name </label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="name" name="name">
                                            <span class="text-danger error-span name-error"  style=" font-size: 14px;"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="email" class="col-form-label">Your Email </label><span class="text-danger">*</span>
                                            <input type="email" class="form-control" id="email" name="email">
                                            <span class="text-danger error-span email-error"  style=" font-size: 14px;"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="subject" class="col-form-label">Subject </label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="subject" name="subject">
                                    <span class="text-danger error-span subject-error"  style=" font-size: 14px;"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="col-form-label">Message </label><span class="text-danger">*</span>
                                    <textarea class="form-control" id="message" name="message"></textarea>
                                    <span class="text-danger error-span message-error" style=" font-size: 14px;"></span>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                <button type="submit" class="btn btn-primary btn-email"><span class="send-mail-btn">Send Email</span></button>
                            </div>
                            <style>
                                .spinner-border {
                                    width: 1rem;
                                    height: 1rem;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </form>
           
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- <script src="https://unpkg.com/dropzone"></script> -->
    <script src="https://unpkg.com/cropperjs"></script>
    <script>
        $('#sendEmail').submit(function (e) { 
            e.preventDefault();
            
            var formData = $(this).serialize();
            // console.log(formData);

            $('.error-span').text('');
            $('.btn-email').attr('disabled', true);
            $('.send-mail-btn').html(`Sending
            <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
                </div>`
            );

            $.ajax({
                type: 'POST',
                url: 'sendEmail',
                data: formData,
                success: function(response) {
                    
                    if(response.code == 200) {
                        $('.send-mail-btn').html(`Sent`);
                        toastr.success('Mail send successfully!', 'Success', { timeOut: 3000 });
                        $('#emailModal').modal('hide');
                    } else if(response.code == 500) {
                        $('.send-mail-btn').html(`Failed`);
                        toastr.error('Failed to send email', 'Error', { timeOut: 3000 });
                        $('.btn-email').removeAttr('disabled');
                    }

                },
                error: function(xhr, status, error) {
                    
                    console.error('Error:', status, error);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errorMessages = xhr.responseJSON.errors;

                        if (errorMessages.hasOwnProperty('email')) {
                            $('.email-error').text(errorMessages['email'][0]);
                        }
                        if (errorMessages.hasOwnProperty('name')) {
                            $('.name-error').text(errorMessages['name'][0]);
                        }
                        if (errorMessages.hasOwnProperty('message')) {
                            $('.message-error').text(errorMessages['message'][0]);
                        }
                        if (errorMessages.hasOwnProperty('subject')) {
                            $('.subject-error').text(errorMessages['subject'][0]);
                        }
                    }
                    toastr.error('Failed to send email', 'Error', { timeOut: 3000 });
                    $('.send-mail-btn').html(`Send Email`);
                    $('.btn-email').removeAttr('disabled');
                }
            });
        });

        $('#emailModal').on('hidden.bs.modal', function () {
            $('#sendEmail').trigger('reset'); 
            $('.error-span').text('');
            $('.send-mail-btn').html(`Send Email`);
            $('.btn-email').removeAttr('disabled');
           
        });
    </script>
</body>
</html>

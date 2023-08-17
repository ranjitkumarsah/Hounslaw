@extends('layouts.app')

<style>
    nav,main,footer {
        display: none !important;
    }
</style>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-4">
                <a href="{{ url('/') }}">
                    <img src="{{asset('public/logo/logo.png')}}" alt="logo" style="width: 45%;"> 
                </a> 
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                        <div class="text w-100">
                            <h3>Welcome to Hounslaw</h3>
                            <p>Don't have an account?</p>
                            <a href="{{route('register')}}" class="btn btn-white btn-outline-white">Register</a>
                        </div>
                    </div>
                    <div class="login-wrap p-4 p-lg-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Sign In</h3>
                            </div>
                        </div>
                        <form class="signin-form" method="POST" action="{{ route('login') }}">
                        
                            @csrf
                            <div class="form-group mb-3">
                                <label class="label" for="name">Email</label>
                                 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="Enter Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="Enter Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <!-- <div class="w-50 text-left">
                                    <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                        <input type="checkbox" >
                                        <span class="checkmark"></span>
                                    </label>
                                </div> -->
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <!-- <span class="checkmark"></span> -->

                                    <label class="form-check-label checkbox-primary" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link reset-password" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password?') }}
                                        </a> 
                                    @endif
                                </div>
                                
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
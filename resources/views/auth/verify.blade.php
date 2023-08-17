@extends('layouts.app')
<style>
    nav,main,footer {
        display: none !important;
    }
    .text-wrap, .login-wrap {
        width: 100% !important;
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
            <div class="col-md-6 col-lg-6">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                    
                <div class="wrap d-md-flex">
                
                    <div class="login-wrap p-4 p-lg-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4 text-center">Verify Your Email Address</h3>
                                <p>Before proceeding, please check your email for a verification link. If you did not receive the email,</p>
                            </div>
                        </div>
                        <form class="signin-form" method="POST" action="{{ route('verification.resend') }}">

                            @csrf

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Click here to request another</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
                <div class="wrap d-md-flex">
                    <div class="login-wrap p-4 p-lg-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4 text-center">Reset Password</h3>
                            </div>
                        </div>
                        <form class="signin-form" method="POST" action="{{ route('password.update') }}">

                            @csrf

                            <input type="hidden" name="token" value="{{ @$token }}">
                            <div class="form-group mb-3">
                                <label class="label" for="name">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}"  autocomplete="email" autofocus placeholder="Enter Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">New Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Enter New Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password_confirmation">Confirm New Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" placeholder="Confirm New Password">
                            
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
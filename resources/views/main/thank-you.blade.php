@extends('layouts.app')

@section('content')
<div class="container thank-you mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-sm-8">
            <div class="border border border-success"></div>
            <div class="card  bg-white shadow p-4">
                <div class="mb-3 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                        fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                    </svg>
                </div>
                <div class="text-center">
                    <h3>Thank You !</h3>
                    <p>Thank you for your payment, it’s processing </p>
                    <p> Your order id is: {{@$transactionId}}</p>
                    <p>You will receive an order confirmation email with details of your order and a link to track your process.</p>

                    <a href="{{URL('/')}}" class="btn form-control btn-primary w-30">Back Home</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
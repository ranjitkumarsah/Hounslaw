@extends('layouts.app')

@section('content')
<div class="container thank-you mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-sm-8">
            <h3 class="text-center mb-4 fw-bold">Choose payment methods</h4>
            <div class="card bg-white shadow payment-card">
                <div class="row ">
                    <div class="col-6 pr-0">
                        <div class="payments  stripe-payment d-flex justify-content-center border-bottom">
                            <button class="btn stripe-btn toggle-btn text-center w-100 active-btn">Credit/Debit Cards</button>
                        </div>
                       
                    </div>
                    <div class="col-6 pl-0">
                        <div class="payments border-bottom  paypal-payment  d-flex justify-content-center">
                            <button class="btn text-center toggle-btn paypal-btn w-100 ">Paypal</button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row stripe-card-form">
                        <div class="col-sm-6 form-group">
                            <label for="card_name">Name on card</label>
                            <span class="text-danger">*</span>
                            <input type="text" name="card_name" id="card_name" class="form-control" placeholder="John Doe">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="card_number">Card Number</label>
                            <span class="text-danger">*</span> &emsp;
                            <img src="{{asset('public/images/cards.png')}}" class="float-end" alt="cards" style="width:40%">
                            <input type="text" name="card_number" id="card_number" class="form-control" placeholder="1234 1234 1234 1234" maxlength="16">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="card_expiry_month">Expiry Month</label>
                            <span class="text-danger">*</span>
                            <input type="text" name="card_expiry_month" id="card_expiry_month" class="form-control" placeholder="MM" maxlength="2">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="card_expiry_year">Expiry Year</label>
                            <span class="text-danger">*</span>
                            <input type="text" name="card_expiry_year" id="card_expiry_year" class="form-control" placeholder="YYYY" maxlength="4">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="card_cvv">CVV</label>
                            <span class="text-danger">*</span>
                            <input type="text" name="card_cvv" id="card_cvv" class="form-control" placeholder="123" maxlength="3">
                        </div>
                        <div class="row my-5 justify-content-center">
                            <a href="#" class="btn form-control btn-primary w-30">Proceed to Pay {{@$userDetails['payment_value']}}</a>
                        </div>
                    </div>
                    <div class="row paypal-card-form justify-content-center align-items-center" style="display:none;">
                        <div class="col-sm-12 form-group text-center">
                           <img src="{{asset('public/images/paypal.png')}}" alt="paypal" class="w-50 mt-5">
                        </div>
                        <div class="row my-5 justify-content-center">
                            <a href="#" class="btn form-control btn-primary w-30">Proceed to Pay {{@$userDetails['payment_value']}}</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.toggle-btn').click(function(e){
            e.preventDefault();

            if ($(this).hasClass('stripe-btn')) {
                $('.stripe-card-form').show();
                $('.paypal-card-form').hide();
            } else {
                $('.stripe-card-form').hide();
                $('.paypal-card-form').show();
            }
            $('.toggle-btn').removeClass('active-btn');
            $(this).addClass('active-btn');
        });

        $('#card_name').on('input', function() {
            var inputValue = $(this).val();
            var englishPattern = /^[A-Za-z ]*$/;
            if (!englishPattern.test(inputValue)) {
                $(this).val(inputValue.replace(/[^A-Za-z ]/g, ''));
            }
        });

        $('#card_number, #card_expiry_year, #card_cvv').on('input', function() {
            var inputValue = $(this).val();
            inputValue = inputValue.replace(/\D/g, '');
            $(this).val(inputValue);
        });

        $('#card_expiry_month').on('input',function () {

            var inputValue = $(this).val();
            inputValue = inputValue.replace(/\D/g, '');
            var numericValue = parseInt(inputValue, 10);
            if (isNaN(numericValue) || numericValue < 1 || numericValue > 12) {
                numericValue = ''; 
            }
            $(this).val(numericValue);
        });
       
    });
    
</script>
@endsection
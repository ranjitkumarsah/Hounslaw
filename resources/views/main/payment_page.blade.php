@extends('layouts.app')

@section('content')
<div class="container thank-you mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <h3 class="text-center mb-4 fw-bold">Choose payment methods</h4>
            <div class="card bg-white shadow payment-card w-100">
                <div class="row ">
                    <div class="col-sm-12">
                        <div class="payments  stripe-payment d-flex justify-content-center border-bottom">
                            <button class="btn stripe-btn toggle-btn text-center w-100 active-btn">Credit/Debit Cards</button>
                        </div>
                       
                    </div>
                    <!-- <div class="col-6 pl-0">
                        <div class="payments border-bottom  paypal-payment  d-flex justify-content-center">
                            <button class="btn text-center toggle-btn paypal-btn w-100 ">Paypal</button>
                        </div>
                    </div> -->
                </div>
               
                <div class="card-body">
                    <form id="stripe-pay" action="{{route('stripePay')}}" method="POST">
                    @csrf
                        <div class="row stripe-card-form">
                            <!-- <div class="col-sm-6 form-group">
                                <label for="name">Name on card</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="name" id="name" class="form-control" placeholder="John Doe">
                                <span class="text-danger error-span name-error" style="font-size:13px;"></span>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="card_number">Card Number</label>
                                <span class="text-danger">*</span> &emsp;
                                <img src="{{asset('public/images/cards.png')}}" class="float-end" alt="cards" style="width:40%">
                                <input type="text" name="card_number" id="card_number" class="form-control" placeholder="1234 1234 1234 1234" maxlength="16">
                                <span class="text-danger error-span card-error" style="font-size:13px;"></span>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label for="expiry_month">Expiry Month</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="expiry_month" id="expiry_month" class="form-control" placeholder="MM" maxlength="2">
                                <span class="text-danger error-span month-error" style="font-size:13px;"></span>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label for="expiry_year">Expiry Year</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="expiry_year" id="expiry_year" class="form-control" placeholder="YYYY" maxlength="4">
                                <span class="text-danger error-span year-error" style="font-size:13px;"></span>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label for="cvv">CVV</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="cvv" id="cvv" class="form-control" placeholder="123" maxlength="4">
                                <span class="text-danger error-span cvv-error" style="font-size:13px;"></span>
                            </div> -->
                            <div class="row mt-5 justify-content-center">
                                <div class="col-md-7">
                                    <img  src="{{asset('public/images/cards.png')}}" alt="" class="w-100 cards-image">

                                </div>
                                
                            </div>
                            <div class="row mt-4 justify-content-center">
                                <div class="col-md-7">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="send_to_email" checked>
                                        <label class="form-check-label" for="send_to_email">
                                            Send photo to my email address.
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row mb-5 mt-4 justify-content-center">
                                <!-- <a href="#" class="btn form-control btn-primary w-30">Proceed to Pay {{@$userDetails['payment_value']}}</a> -->
                                <button class="btn btn-primary stripe-pay-btn" style="max-width: fit-content;" type="submit">Proceed to Pay {{@$userDetails['payment_value']}}</button>
                            </div>
                        </div>
                    </form>
                    <div class="row paypal-card-form justify-content-center align-items-center" style="display:none;">
                        <div class="col-sm-12 form-group text-center">
                        <img src="{{asset('public/images/paypal.png')}}" alt="paypal" class="w-50 mt-5">
                        </div>
                        <form id="paypal-pay">
                            <div class="row my-5 justify-content-center">
                                <!-- <a href="" class="btn form-control btn-primary w-30">Proceed to Pay {{@$userDetails['payment_value']}}</a> -->
                                <button class="btn btn-primary paypal-pay-btn" style="max-width: fit-content;" type="submit">Proceed to Pay {{@$userDetails['payment_value']}}</button>
                            </div>
                        </form>
                        
                    </div>   
                </div>      
            </div>
        </div>
    </div>
</div>
<style>
    .cards-image {
        border: 2.5px solid #bbb;
        padding: 10px;
        border-radius: 4px
    }
</style>
<script src="https://js.stripe.com/v3/"></script>
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

        $('#name').on('input', function() {
            var inputValue = $(this).val();
            var englishPattern = /^[A-Za-z ]*$/;
            if (!englishPattern.test(inputValue)) {
                $(this).val(inputValue.replace(/[^A-Za-z ]/g, ''));
            }
        });

        $('#expiry_year, #cvv').on('input', function() {
            var inputValue = $(this).val();
            inputValue = inputValue.replace(/\D/g, '');
            $(this).val(inputValue);
        });

        $('#card_number').on('input paste', function(e) {
            var inputValue;

            if (e.type === 'paste') {
                var clipboardData = e.originalEvent.clipboardData || window.clipboardData;
                inputValue = clipboardData.getData('text');
            } else {
                inputValue = $(this).val();
            }

            // Remove non-digits from the input
            var numericValue = inputValue.replace(/\D/g, '');

            // Limit to 16 digits
            numericValue = numericValue.substring(0, 16);

            // Insert space after every fourth digit
            var formattedValue = numericValue.replace(/(\d{4})(?=\d)/g, '$1 ');

            $(this).val(formattedValue);
            $(this).attr('maxlength', 19); // Adjust maxlength for spaces
        });


        $('#expiry_month').on('input', function () {
            var inputValue = $(this).val();
            inputValue = inputValue.replace(/\D/g, '');

            if (inputValue > 12) {
                inputValue = '';
            }

            $(this).val(inputValue);
        });


        // $('#stripe-pay').submit(function (e) { 
        //     e.preventDefault();
            
        //     var formData = $(this).serialize();
           
        //     $('.error-span').text('');
        //     // $('.stripe-pay-btn').attr('disabled', true);
        //     // $('.stripe-pay-btn').html(`Paying
        //     // <div class="spinner-border text-light" role="status">
        //     // <span class="visually-hidden">Loading...</span>
        //     //     </div>`
        //     // );

        //     $.ajax({
        //         type: 'POST',
        //         url: 'stripePay',
        //         data: formData,
        //         success: function(response) {
                    
        //             if(response.status == 200) {
        //                 $('.stripe-pay-btn').html(`Paid`);
        //                 toastr.success('Payment done successfully!', 'Success', { timeOut: 3000 });

        //             } else if(response.status == 500) {
        //                 $('.stripe-pay-btn').html(`Failed`);
        //                 toastr.error('Payment Failed', 'Error', { timeOut: 3000 });
        //                 $('.stripe-pay-btn').removeAttr('disabled');
        //             }

        //         },
        //         error: function(xhr, status, error) {
                    
        //             console.error('Error:', status, error);
        //             if (xhr.responseJSON && xhr.responseJSON.errors) {
        //                 var errorMessages = xhr.responseJSON.errors;

        //                 if (errorMessages.hasOwnProperty('name')) {
        //                     $('.name-error').text(errorMessages['name'][0]);
        //                 }
        //                 if (errorMessages.hasOwnProperty('card_number')) {
        //                     $('.card-error').text(errorMessages['card_number'][0]);
        //                 }
        //                 if (errorMessages.hasOwnProperty('expiry_month')) {
        //                     $('.month-error').text(errorMessages['expiry_month'][0]);
        //                 }
        //                 if (errorMessages.hasOwnProperty('expiry_year')) {
        //                     $('.year-error').text(errorMessages['expiry_year'][0]);
        //                 }
        //                 if (errorMessages.hasOwnProperty('cvv')) {
        //                     $('.cvv-error').text(errorMessages['cvv'][0]);
        //                 }

        //                 $('.stripe-pay-btn').html(`Proceed to Pay`);
        //                 $('.stripe-pay-btn').removeAttr('disabled');
        //             }
        //         }
        //     });
        // });
       
    });
    
</script>
@endsection
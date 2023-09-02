@extends('layouts.app')

@section('content')

<section class="banner-section">
    <img src="{{asset('public/images/banner2.png')}}" class="w-100" height="150px" alt="banner">
</section>
<div class="container mt-5">
    
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-sm-12">
                    <div class="row personal_details">
                        <h4 class="text-center fw-bold">Personal Details</h4>
                        <div class="col-sm-12">
                            <label><b>Country:</b> <span>{{@$data['country_text']}}</span></label>
                           
                        </div>
                        <div class="col-sm-12">
                            <label><b>Document Type:</b> <span>{{@$data['document_type_text']}}</span></label>
                        </div>
                        
                        <div class="col-sm-12">
                            <label><b>Name:</b> <span>{{@$data['name']}}</span></label>

                        </div>
                        <div class="col-sm-12">
                            <label><b>Email:</b> <span>{{@$data['email']}}</span></label>
                            
                        </div>
                        <!-- <div class="col-sm-12">
                            <label><b>Address:</b> <span>{{@$data['address']}}</span></label>
                        </div>
                        <div class="col-sm-12">
                            <label><b>Town/City:</b> <span>{{@$data['city']}}</span></label>
                        </div>
                        <div class="col-sm-12">
                            <label><b>PostCode:</b> <span>{{@$data['post_code']}}</span></label>
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <hr>
                </div>
                <div class="col-sm-12">
                    <div class="row justify-content-center image-edit-row">
                        <h4 class="text-center fw-bold">Edit Image</h4>
                        <div class="col-sm-6">
                            <!-- <div class="row mt-5 image-background-change align-items-center">
                                <h6 class="fw-bold">Background</h6>
                                <hr>
                                <div class="col-sm-6 form-group">
                                    <div class="row">
                                        <div class="col-12 form-group position-relative">
                                            <input type="text" class="hex-value" id="hex-val-ref">
                                            <button class="color-code-copy" data-id="rgb-val-ref">
                                                <i class="fa-regular fa-copy"></i>
                                            </button>
                                        </div>
                                        <div class="col-12 form-group position-relative">
                                            <input type="text" class="rgb-value"id="rgb-val-ref">
                                            <button class="color-code-copy" data-id="rgb-val-ref">
                                                <i class="fa-regular fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group text-center">
                                    <input type="color" name="image-bg-color" id="image-bg-color" value="#14C4FF">
                                </div>
                            </div> -->
                            <div class="row mt-3">
                                <h6 class="fw-bold">Filters</h6>
                                <hr>
                                <div class="col-6 form-group">
                                    <button class="btn btn-secondary text-center w-100 filter_buttons active" id="brightness">Brightness</button>
                                </div>
                                <div class="col-6 form-group">
                                    <button class="btn btn-secondary text-center w-100 filter_buttons" id="contrast">Contrast</button>
                                </div>
                                <!-- <div class="col-6 form-group">
                                    <button class="btn btn-secondary text-center w-100 filter_buttons" id="sharpness">Sharpness</button>
                                </div> -->
                                <div class="col-6 form-group">
                                    <button class="btn btn-secondary text-center w-100 filter_buttons" id="saturation">Saturatoin</button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12 brightness_range_section range_section">
                                    <p class="brightness_range_label d-inline">Brightness</p>
                                    <p id="brightness_range_value" class="brightness_range_value float-end mb-1">100%</p>
                                    <input type="range" name="brightness_range" id="brightness_range" class="w-100" value="100" min="0" max="200" style="accent-color:#84C261;">
                                </div>
                                <div class="col-sm-12 contrast_range_section range_section d-none">
                                    <p class="contrast_range_label d-inline">Contrast</p>
                                    <p id="contrast_range_value" class="contrast_range_value float-end mb-1">100%</p>
                                    <input type="range" name="contrast_range" id="contrast_range" class="w-100" value="100" min="0" max="200" style="accent-color:#84C261;">
                                </div>
                                <!-- <div class="col-sm-12 sharpness_range_section range_section d-none">
                                    <p class="sharpness_range_label d-inline">Sharpness</p>
                                    <p id="sharpness_range_value" class="sharpness_range_value float-end mb-1">100%</p>
                                    <input type="range" name="sharpness_range" id="sharpness_range" class="w-100" value="100" min="0" max="200" style="accent-color:#84C261;">
                                </div> -->
                                <div class="col-sm-12 saturation_range_section range_section d-none">
                                    <p class="saturation_range_label d-inline">Saturation</p>
                                    <p id="saturation_range_value" class="saturation_range_value float-end mb-1">100%</p>
                                    <input type="range" name="saturation_range" id="saturation_range" class="w-100" value="100" min="0" max="200" style="accent-color:#84C261;">
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                           
                            <div class=" image-edit-card px-5 pt-2">
                                <div class="card-body image-edit-card-body p-0">
                                    <img id="previewImg" src="{{@$data['image_url']}}" class="w-100" alt="image">
                                </div>
                            </div>
                            <div class="row mt-2 justify-content-center">
                                <div class="col-6">
                                    <button class="btn btn-success form-control text-center" id="save_img"><i class="fa fa-arrow-down"></i> Download Image</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <form action="" id="details_form">
                <!-- <div class="row ">
                    <h4 class="text-center fw-bold mt-3 mb-4">Delivery option</h4>
                    <div class="col-sm-12 form-group">
                        <label for="document_delivery_option">Please select your document delivery option </label><span class="text-danger">*</span>
                        <select name="document_delivery_option" id="document_delivery_option">
                            <option></option>
                            <option value="1">The photo will be sent to your email in digital format only - £5.99</option>
                            <option value="2">Digital photo sent via email with 6 printed copies to your home - £7.50</option>
                            <option value="3">UK passport photo code for your online passport application, sent via email - £5.99</option>
                        </select>
                        <span id="delivery_option_error" class="text-danger d-none">Please select any one delivery option from above dropdown.</span>
                    </div>
                   
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Important Notes</h5>
                            <ol>
                                <li>
                                    <h6>Our objective is to deliver your digital photo or UK passport photo code within five hours, which will be sent to your email.</h6>
                                </li>
                                <li>
                                    <h6>Additionally, You can expect to receive a physical copy of the photo at your home address within 2 to 3 days.
                                    </h6>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div> -->
                <div class="row mt-5  mb-4 justify-content-center">

                    <button type="submit" class="form-control btn btn-primary submit px-3 " style="width:200px;">Proceed</button>
                    
                </div>
            </form>
            <!-- <div class="row justify-content-center">
                <a href="{{route('thank-you')}}" class="form-control btn btn-primary text-center submit px-3 " style="width:200px;">Proceed</a>
            </div> -->
           
        </div>
    </div>
</div>


@endsection
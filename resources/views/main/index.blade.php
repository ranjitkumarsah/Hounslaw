@extends('layouts.app')

@section('content')

    <style>
        .spinner-border {
            width: 1rem;
            height: 1rem;
        }
    </style>
    <div id="carouselHome" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
            <li data-target="#carouselHome" data-slide-to="1"></li>
            <li data-target="#carouselHome" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{asset('public/images/banner2.png')}}" data-color="lightblue" alt="First Image">

            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{asset('public/images/banner2.png')}}" data-color="firebrick" alt="Second Image">
            
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{asset('public/images/banner2.png')}}" data-color="violet" alt="Third Image">
                
            </div>
        </div>
        <!-- Controls -->
        <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <h2 class="text-center">Important Instrusctions <i class="fa fa-question-circle" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#instructionModal" style="cursor:pointer;" title="Show Instructions"></i></h2>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="instructionModal" tabindex="-1" aria-labelledby="instructionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Instructions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ol>
                            
                            <h3><li>Select country </li></h3>
                            <p>Please select your country for to get list document types of your country.</p>
                        
                            <h3><li>Select document type as per your choice country</li></h3>
                            <p>Please select any one document type from given list of document types as per your country selection.</p>
                        
                            <h3><li>Fill personal details</li></h3>
                            <p>Please fill personal details</p>

                            <h3><li>Upload Image</li></h3>
                            <div class="do-section">
                                <h4 class="text-dark">Do's</h4>
                                <div class="row">
                                    <div class="col-sm-3 form-group position-relative">
                                        <img src="https://www.passport.service.gov.uk/photo/public/images/adult-photo-background-light-plain.jpg" alt="do-image" class="w-100" height="250px">
                                        <p class="text-dark">Plain light-coloured background</p>
                                        <i class="fa fa-check position-absolute" style="color: #84C261;top: 2%;right: 9%;font-size: 50px;" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-sm-3 form-group position-relative">
                                        <img src="https://www.passport.service.gov.uk/photo/public/images/adult-photo-shadow-none.jpg" alt="do-image" class="w-100" height="250px">
                                        <p class="text-dark">No lighting and no shadow</p>
                                        <i class="fa fa-check position-absolute" style="color: #84C261;top: 2%;right: 9%;font-size: 50px;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="dont-section">
                                <h4 class="text-dark">Dont's</h4>
                                <div class="row">
                                    <div class="col-sm-3 form-group position-relative">
                                        <img src="https://www.passport.service.gov.uk/photo/public/images/adult-photo-background-object.jpg" alt="dont-image" class="w-100" height="250px">
                                        <p class="text-dark">Object in background</p>
                                        <i class="fa fa-close position-absolute" style="color:red ;top: 2%;right: 9%;font-size: 50px;" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-sm-3 form-group position-relative">
                                        <img src="https://www.passport.service.gov.uk/photo/public/images/adult-photo-shadow-behind.jpg" alt="dont-image" class="w-100" height="250px">
                                        <p class="text-dark">Shadow behind head</p>
                                        <i class="fa fa-close position-absolute" style="color:red ;top: 2%;right: 9%;font-size: 50px;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </ol>
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- Form  -->
        <form class="form" id="" method="POST" action="{{route('details')}}" enctype="multipart/form-data">
            @csrf
            <div class="card form-submit-card mt-4">
                <div class="row card-body">
                    <div class="col-sm-6 form-first-half">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="country">Select Country</label><span class="text-danger">*</span>
                                    <select name="country" id="country" class="form-control country @error('country') is-invalid @enderror">
                                        <option></option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->code}}" @if(old('country') == $country->code) selected @endif>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="country_text" id="country_text">
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="document_type">Select Document</label><span class="text-danger">*</span>
                                    <input type="hidden" id="input_doc_type_val" value="{{old('document_type')}}">
                                    <select name="document_type" id="document_type" class="form-control document_type @error('document_type') is-invalid @enderror">
                                        <option value=""></option>
                                        
                                       
                                    </select>
                                    <input type="hidden" name="document_type_text" id="document_type_text">
                                    @error('document_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Name</label><span class="text-danger">*</span>
                                   <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" placeholder="Enter name">
                                   @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="email">Email</label><span class="text-danger">*</span>
                                   <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" placeholder="Enter email">
                                   @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="address">Address</label><span class="text-danger">*</span>
                                   <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Address">{{ old('address') }}</textarea>
                                   @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="city">Town/City</label><span class="text-danger">*</span>
                                    <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" placeholder="Enter city">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="post_code">Postcode</label><span class="text-danger">*</span>
                                    <input type="text" name="post_code" id="post_code" class="form-control @error('post_code') is-invalid @enderror"  value="{{ old('post_code') }}" placeholder="Enter postal code">
                                    @error('post_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class=" post-input-err invalid-feedback" style="display:none;" role="alert">Please enter numeric values only.</span>
                               
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row justify-content-center">
                            <div class="col-sm-12">
                                <div class="form-group justify-content-center">
                                    <h4 class="text-center"> Upload Photo</h4>
                                    <div class="card text-center upload-image-preview">
                                        <div class="card-body @error('image') is-invalid @enderror">
                                           <img src="{{asset('public/images/blankimg.png')}}" alt="blankImg" class="preview-image w-100" id="preview-image" srcset="" >
                                        </div>
                                    </div>
                                    @error('image')
                                        <span class="d-block invalid-feedback text-center" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="row mt-4">
                                        <div class="col-sm-12 text-center proccessing-text">
                                            <span class="text-secondary face_p_text d-none">Detecting face
                                                <div class="spinner-border text-info" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                
                                            </span><br>
                                            <span class="text-secondary remove_bg_text d-none">Removing Background
                                                <div class="spinner-border text-info" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </span>
                                        </div>
                                       
                                    </div>
                                    <div class="img-upload mt-4">
                                        <label for="image_upload" id="image_upload_btn">Choose Image</label>
                                        <input type="file" name="image_upload" id="image_upload" class="form-control"  accept="image/jpg,image/jpeg" value="{{ old('image') }}" disabled> 
                                        <input type="hidden" name="image" id="image">
                                    </div>
                                    <div class="img-upload-instructions mt-4 " style="display:none;">
                                        <h6 class="fw-bold">Your photo must be:</h6>
                                        <ol>
                                            <li>Photo should be coloured with light background.
                                            </li>
                                            <li>Use simple photo don't use any filter.</li>
                                            <li>Only jpg or jpeg file is allowed.</li>
                                            <li>Minimum 50KB and maximum 10MB files size is allowed.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3  mb-5 justify-content-center">
                    <button type="submit" class="form-control btn btn-primary submit px-3 " style="width:200px;">Proceed</button>
                    <!-- <a href="{{route('details')}}" class="form-control btn btn-primary submit px-3 " style="width:200px;">Proceed</a> -->
                </div>
            </div>

        </form>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            
 
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crop Image Before Upload</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img class="w-100" src="" id="sample_image" />
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="crop" class="btn btn-primary">Crop</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
                
        </div>
    </div>

    <script>

        $('.submit').attr('disabled',true);


        const apiKey = "dHCTsJXFN8io6XMbVTUaL54N"; 
        const removeBgEndpoint = "https://api.remove.bg/v1.0/removebg"; 

        var originalImage = null;
        var $modal = $('#modal');
        var image = document.getElementById('sample_image');
        var cropper;

        function removeBg(resizedImageData){
            
            $('.remove_bg_text').removeClass('d-none');
            // $('#image_upload_btn').text('Removing Background...');
            // $('#image_upload_btn').css('opacity',0.7);
            // const fileInput = document.getElementById('image_upload');
            
            // const image = fileInput.files[0];

            // Convert resizedImageData to Blob
            var byteCharacters = atob(resizedImageData.split(',')[1]);
            var byteNumbers = new Array(byteCharacters.length);
            for (var i = 0; i < byteCharacters.length; i++) {
                byteNumbers[i] = byteCharacters.charCodeAt(i);
            }
            var byteArray = new Uint8Array(byteNumbers);
            var blobImage = new Blob([byteArray], { type: 'image/jpeg' });

            const formData = new FormData();
            formData.append('image_file', blobImage);
            formData.append('size', 'auto');
            formData.append('type', 'image/jpeg');
            

            fetch(removeBgEndpoint,{
                method:'POST',
                headers: {
                    'X-Api-Key': apiKey
                },
                body: formData
            })
            .then(function(reponse){
                return reponse.blob()
            })
            .then(function(blob){
                
                const url = URL.createObjectURL(blob);
                imageURL = url;
                const img = document.getElementById('preview-image');
                img.src = url;
                $('.remove_bg_text').html(`Background removed <i class="fa fa-check text-success"></i>`);
                // $('#image_upload_btn').re('Upload Image');
                $('#image_upload_btn').css({ 'opacity': 1, 'background': '#84C261' });
               
                const reader = new FileReader();
                reader.onloadend = function() {
                    const imageData = reader.result.split(',')[1];
                    document.getElementById('image').value = imageData;
                };
                reader.readAsDataURL(blob)
            })
            .catch(error => {
                console.error('Error:', error);
                $('.remove_bg_text').html(`Background not removed <i class="fa fa-close text-danger"></i>`);
            });
        }


        function detectFaces(resizedImage) {

            $('.face_p_text').removeClass('d-none');

            var subscriptionKey = "30c22bd1c4644d9f886ab0ffff7a717f";
            var region = "eastus";
            var endpoint = `https://${region}.api.cognitive.microsoft.com/face/v1.0/detect`;

            // Convert data URL to Blob
            var byteString = atob(resizedImage.split(',')[1]);
            var mimeString = resizedImage.split(',')[0].split(':')[1].split(';')[0];
            var ab = new ArrayBuffer(byteString.length);
            var ia = new Uint8Array(ab);
            for (var i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            var blobImage = new Blob([ab], { type: mimeString });


            $.ajax({
                url: `${endpoint}?returnFaceAttributes=headPose&returnFaceLandmarks=true`,
               
                type: "POST",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Ocp-Apim-Subscription-Key", subscriptionKey);
                },
                data:blobImage,
                contentType: "application/octet-stream",
                processData: false,
                success: function (data) {
                    console.log(data);
                    if (data.length == 1) {

                        $('.face_p_text').html(`Face detected <i class="fa fa-check text-success"></i>`);

                        var faceRectangle = data[0].faceRectangle;
                        var originalImage = document.getElementById("preview-image");
                        originalImage.src = resizedImage; 

                        var faceAttributes = data[0].faceAttributes;
                        var headPose = faceAttributes.headPose;

                        var yawAngle = headPose.yaw;
                        var yawThreshold = 15; 

                        if (Math.abs(yawAngle) <= yawThreshold) {
                            
                            console.log('Face is looking directly at the camera.');
                            
                            // Crop and ResizeImage
                            var canvas = document.createElement('canvas');
                            var ctx = canvas.getContext('2d');

                            var headAndShouldersWidth = faceRectangle.width * 2;
                            var headAndShouldersHeight = faceRectangle.height * 3;

                            var headAndShouldersLeft = Math.max(faceRectangle.left - faceRectangle.width / 2, 0);
                            var headAndShouldersTop = Math.max(faceRectangle.top - faceRectangle.height, 0);

                            canvas.width = headAndShouldersWidth;
                            canvas.height = headAndShouldersHeight;

                            ctx.drawImage(originalImage, headAndShouldersLeft, headAndShouldersTop, headAndShouldersWidth, headAndShouldersHeight, 0, 0, canvas.width, canvas.height);

                            var desiredWidth = 2 * 300;
                            var desiredHeight = 2 * 300;

                            var resizedCanvas = document.createElement('canvas');
                            var resizedCtx = resizedCanvas.getContext('2d');
                            resizedCanvas.width = desiredWidth;
                            resizedCanvas.height = desiredHeight;

                            resizedCtx.drawImage(canvas, 0, 0, canvas.width, canvas.height, 0, 0, resizedCanvas.width, resizedCanvas.height);

                            var resizedImageData = resizedCanvas.toDataURL('image/jpeg');

                            originalImage.src = resizedImageData;
                            
                            $('#image_upload_btn').css({'opacity':1,'cursor':'pointer'});
                            $('#image_upload').removeAttr('disabled');
                            $('.submit').removeAttr('disabled');

                            // removeBg(resizedImageData);
                        } else {
                            
                            console.log('Face is not looking directly at the camera.');
                            $('.face_p_text').html(`Face is not looking directly at the camera. <i class="fa fa-close text-danger"></i>`);
                            $('#image_upload_btn').css({'opacity':1,'cursor':'pointer'});
                            $('#image_upload').removeAttr('disabled');
                            $('.submit').removeAttr('disabled');
                        }


                    }
                    else if (data.length > 1) {
                        console.log('Multiple faces detected.');

                        $('.face_p_text').html(`Multiple faces detected <i class="fa fa-close text-danger"></i>`);
                        $('#image_upload_btn').css({'opacity':1,'cursor':'pointer'});
                        $('#image_upload').removeAttr('disabled');

                    } else if (data.length == 0) {

                        console.log('No face detected.');

                        $('.face_p_text').html(`No face detected <i class="fa fa-close text-danger"></i>`);

                        $('#image_upload_btn').css({'opacity':1,'cursor':'pointer'});
                        $('#image_upload').removeAttr('disabled');
                    }
                   
                    
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }

        $(document).on("change", "#image_upload", function (e) {
            e.preventDefault();

            $('#image_upload_btn').css({'opacity': 0.6, 'cursor': 'context-menu'});
            $(this).prop('disabled', true);
            
            var imagePreview = $('#preview-image');
            var selectedImage = e.target.files[0];
            
            if (selectedImage) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = new Image();
                    img.onload = function() {
                        
                        
                        detectFaces(e.target.result);
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(selectedImage);
            }
        });

        // $modal.on('shown.bs.modal', function() {
        //     cropper = new Cropper(image, {
        //     aspectRatio: 1,
        //     viewMode: 3,
        //     preview:'.preview'
        //     });
        // }).on('hidden.bs.modal', function(){
        //     cropper.destroy();
        //     cropper = null;

        //     $('#image_upload_btn').css({'opacity':1,'cursor':'pointer'});
        //     $('#image_upload').removeAttr('disabled');
        // });

        // $('#crop').click(function() {
        //     canvas = cropper.getCroppedCanvas({
        //         width: 400,
        //         height: 400
        //     });

        //     var croppedImage = canvas.toDataURL();
        //     detectFaces(croppedImage);
        //     $modal.modal('hide');
        // });

    </script>

    
@endsection

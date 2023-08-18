@extends('layouts.admin_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Form  -->
        <form class="form" id="document_update">
            @csrf
            <div class="card form-submit-card mt-4">
                <div class="row card-body">

                    <div class="col-sm-6">
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="document_type">Select Document</label><span class="text-danger">*</span>
                            <input type="hidden" id="doc_id" value="">
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="document_width">Document width (in cm)</label><span class="text-danger">*</span>
                            <input type="text" name="document_width" id="document_width" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" placeholder="Enter width">
                            @error('document_width')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="document_height">Document height (in cm)</label><span class="text-danger">*</span>
                            <input type="text" name="document_height" id="document_height" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" placeholder="Enter height">
                            @error('document_height')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                       
                </div>
                <div class="row mt-3  mb-5 justify-content-center">
                    <button type="submit" class="form-control btn btn-primary submit px-3 " style="width:200px;">Proceed</button>
                    <!-- <a href="{{route('details')}}" class="form-control btn btn-primary submit px-3 " style="width:200px;">Proceed</a> -->
                </div>
            </div>

        </form>
    </div>
</div>
    <script>
         $(document).ready(function() {
           
            $('#document_height, #document_width').on('input', function() {
                var inputValue = $(this).val();
                var sanitizedValue = inputValue.replace(/[^\d.]/g, '');
                sanitizedValue = sanitizedValue.replace(/(\..*)\./g, '$1');

                $(this).val(sanitizedValue);
            });

            $('#document_height, #document_width').on('paste', function(e) {
                e.preventDefault();
                var currentVal = $(this).val();
                var pastedText = (e.originalEvent || e).clipboardData.getData('text/plain');

                var sanitizedPastedText = pastedText.replace(/[^\d.]/g, '');
                sanitizedPastedText = sanitizedPastedText.replace(/(\..*)\./g, '$1');

                $(this).val(currentVal + sanitizedPastedText);
            });


            $(document).on('change','#document_type',function(e){
                e.preventDefault();
                var code = $(this).val();


                $.ajax({
                    url: 'admin/getDocumentSize/'+code, 
                    type: 'GET',
                    success: function(response) {
                        if(response.success) {
                            
                            var id = response.data.id;
                            var width = response.data.width;
                            var height = response.data.height;

                            $('#doc_id').val(id);
                            $('#document_width').val(width);
                            $('#document_height').val(height);

                        } else {
                            console.log(response.message);
                        }
                        
                        
                    
                    },
                    error: function(xhr, status, error) {
                    console.error('Error:', error);
                    }
                });
            });


            $("#document_update").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var id = $('#doc_id').val();

                if(id) {
                    $.ajax({
                        type: "POST",
                        url: 'admin/documentSizeUpdate/'+id, 
                        data: formData,
                        success: function(response) {
                            toastr.success('Document Size Updated', 'Success');
                            setInterval(location.reload(), 3000);
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 422) {
                                // Show error Toastr message
                                toastr.error(xhr.responseJSON.error, 'Validation Error');
                            } else {
                                toastr.error('An error occurred: ' + error, 'Error');
                            }
                        }
                    });
                } else {
                    toastr.error('Please select Document', 'Error');
                }
                
            });
        });



    </script>
@endsection

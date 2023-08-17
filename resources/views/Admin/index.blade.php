@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Form  -->
        <form class="form" id="" method="POST" action="{{route('details')}}" enctype="multipart/form-data">
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="document_size">Document size (in pixels)</label><span class="text-danger">*</span>
                            <input type="text" name="document_size" id="document_size" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" placeholder="Enter name">
                            @error('document_size')
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
@endsection

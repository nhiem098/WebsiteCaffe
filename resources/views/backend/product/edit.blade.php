@extends('backend.master.master')
@section('title','Product')

@section('style')
<link href="backend\assets\libs\mohithg-switchery\switchery.min.css" rel="stylesheet" type="text/css">
<link href="backend\assets\libs\select2\css\select2.min.css" rel="stylesheet" type="text/css">
<link href="backend\assets\libs\summernote\summernote-bs4.min.css" rel="stylesheet" type="text/css">
<link href="backend\assets\libs\dropzone\min\dropzone.min.css" rel="stylesheet" type="text/css">
<link href="backend\assets\libs\dropify\css\dropify.min.css" rel="stylesheet" type="text/css">
@endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Elements</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add Product</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <form action="{{route('product.update',['product'=>$product->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('avatar')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-box" style="padding-bottom: 48px;">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>

                        <div class="switchery-demo mb-3">
                            <label class="mr-2" for="active">Active</label>
                            <input type="checkbox" {{$product->active ? "checked=''" : ''}} name="active" id="active" data-plugin="switchery"
                                data-color="#039cfd">
                        </div>

                        <div class="form-group mb-3">
                            <label for="product-name">Product Name <span class="text-danger">*</span></label>
                            <input type="text" id="product-name" name="name" value="{{$product->name}}"
                                class="@error('name') is-invalid @enderror form-control" placeholder="e.g : Apple iMac">
                        </div>

                        <div class="form-group mb-3">
                            <label for="product-slug">Slug </label>
                            <input type="text" id="product-slug" name="slug" class="form-control" placeholder="e.g : apple-imac" value="{{$product->slug}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="product-category">Categories <span class="text-danger">*</span></label>
                            <select class="@error('category_id') is-invalid @enderror form-control select2"
                                id="product-category" name="category_id">
                                @foreach ($categories as $category)
                                @if ($category->child != true)
                                <option value="{{$category->id}}" {{$product->category_id==$category->id ? "selected" : ''}}>{{$category->name}}</option>
                                @else
                                <optgroup label="{{$category->name}}">
                                    @foreach ($category['children'] as $children)
                                    <option value="{{$children->id}}"{{$product->category_id==$children->id ? "selected" : ''}}>{{$children->name}}</option>
                                    @endforeach
                                </optgroup>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="product-price">Price <span class="text-danger">*</span></label>
                            <input type="number" min=0 value="{{$product->price}}"
                                class="@error('price') is-invalid @enderror form-control" id="product-price"
                                name="price" placeholder="Enter amount">
                        </div>

                        <div class="form-group mb-0">
                            <label>Note</label>
                            <textarea class="form-control" name="note" rows="3"
                                placeholder="Please enter comment">{{$product->note}}</textarea>
                        </div>
                    </div> <!-- end card-box -->

                    <div class="card-box">
                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Do You Want To Change Product Avatar?</h5>

                        <input type="file" name="avatar" data-plugins="dropify">

                    </div> <!-- end col-->
                </div> <!-- end col -->

                <div class="col-lg-6">

                    <div class="card-box">
                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Description</h5>

                        <div class="form-group mb-3">
                            <label for="product-description">Product Description</label>
                            <textarea class="form-control" id="product-description" name="description" rows="5"
                                placeholder="Please enter description">{{$product->description}}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="product-summary">Product Summary</label>
                            <textarea class="form-control" id="product-summary" name="summary" rows="3"
                                placeholder="Please enter summary">{{$product->summary}}</textarea>
                        </div>
                    </div> <!-- end card-box -->

                    <div class="card-box">
                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Product Avatar Current</h5>
                        <div class="row">
                            <div class="col-12 text-center">
                                <img src="{{asset($product->avatar)}}" alt="image" class="img-fluid rounded" style="height: 300px;">
                            </div>
                            
                        </div>
                        

                    </div> <!-- end col-->
                
                </div> <!-- end col-->

            </div>
            <div class="col-12">
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light mr-1">
                        <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Success
                    </button>
                    <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light ml-1">
                        <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span>Cancel
                    </button>
                </div>
            </div> <!-- end col -->

        </form>
        <!-- end row -->
    </div>
</div>

@endsection

@section('script')
<script src="backend\assets\libs\mohithg-switchery\switchery.min.js"></script>
<script src="backend\assets\js\pages\form-advanced.init.js"></script>
<!-- Summernote js -->
<script src="backend\assets\libs\summernote\summernote-bs4.min.js"></script>
<!-- Select2 js-->
<script src="backend\assets\libs\select2\js\select2.min.js"></script>
<!-- Plugins file uploads-->
<script src="backend\assets\libs\dropzone\min\dropzone.min.js"></script>
<script src="backend\assets\libs\dropify\js\dropify.min.js"></script>
<!-- Init js-->
<script src="backend\assets\js\pages\form-fileuploads.init.js"></script>

<!-- Init js -->
<script src="backend\assets\js\pages\add-product.init.js"></script>
@endsection

@extends('backend.master.master')
@section('title','Category')

@section('style')
<link href="backend\assets\libs\mohithg-switchery\switchery.min.css" rel="stylesheet" type="text/css">
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
                    <h4 class="page-title">Edit category</h4>
                </div>
            </div>
        </div>
        <!-- end page title --><div class="switchery-demo mb-3">
                            <label class="mr-2" for="active">Active</label>
                            <input type="checkbox" checked="" name="active" id="active" data-plugin="switchery"
                                data-color="#039cfd">
                        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('category.update',['id' => $category->id])}}" method="POST">
                            @csrf
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="switchery-demo">
                                <label class="mr-2" for="active">Active</label>
                                <input type="checkbox" {{$category->active ? "checked=''":''}} name="active" id="active" data-plugin="switchery"
                                    data-color="#039cfd">
                            </div>
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Name <span class="text-danger">*</span></label>
                                            <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror form-control" required value="{{$category->name}}"
                                                placeholder="name">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="content">Description</label>
                                            <textarea class="form-control" id="content" name="content" rows="5">{{$category->content}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="slug">Slug</label>
                                            <input type="text" id="slug" name="slug" value="{{$category->slug}}" class="form-control"
                                                placeholder="slug">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="parent">Parent</label>
                                            <select class="form-control" name="parent_id" id="parent">
                                                <option value="0"></option>
                                                @foreach ($categories as $value)
                                                    @if ($value->id != $category->id)
                                                    <option value="{{$value->id}}" {{$value->id == $category->parent_id ? 'selected' : ''}}>{{$value->name}}</option>
                                                    @endif
                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="Note">Note</label>
                                            <textarea class="form-control" id="note" name="note" rows="2">{{$category->note}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-list text-right">
                                <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light">
                                    <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Success
                                </button>
                                <a href="{{route('category.index')}}"><button type="button" class="btn btn-danger btn-rounded waves-effect waves-light">
                                    <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span>Cancel
                                </button></a>
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>

@endsection

@section('script')
<script src="backend\assets\libs\mohithg-switchery\switchery.min.js"></script>
<script src="backend\assets\js\pages\form-advanced.init.js"></script>
@endsection

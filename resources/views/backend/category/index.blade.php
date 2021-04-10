@extends('backend.master.master')
@section('title','Category')

@section('style')
    <!-- third party css -->
    <link href="backend\assets\libs\datatables.net-bs4\css\dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\libs\datatables.net-buttons-bs4\css\buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\libs\datatables.net-select-bs4\css\select.bootstrap4.min.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Datatables</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Category</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h2 class="header-title mb-2 col-2">List Category</h2>
                            <a class="col-10 text-right" href="{{route('category.create')}}">
                                <button type="button" class="btn btn-primary waves-effect waves-light mb-2">
                                    <span class="btn-label"><i class="mdi mdi-plus-thick"></i></span>Add category
                                </button>
                            </a>
                        </div>
                        <table id="alternative-page-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>                  
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td>{{$category->content}}</td>
                                        <td>@if($category->active)
                                            <span class="badge badge-success badge-pill" style="font-size: 12px">On</span>
                                        @else
                                            <span class="badge badge-danger badge-pill">Off</span>
                                        @endif</td>
                                        <td>{{$category->note}}</td>
                                        <td>
                                            <a href="{{route('category.edit',['category'=>$category->id])}}" class="action-icon"> <i
                                                    class="mdi mdi-square-edit-outline" title="edit"></i></a>
                                            <a href="{{route('category.destroy',['category'=>$category->id])}}" class="action-icon"> <i
                                                    class="mdi mdi-delete" title="delete"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->
</div> <!-- content -->
@endsection

@section('script')
    <!-- third party js -->
    <script src="backend\assets\libs\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="backend\assets\libs\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="backend\assets\libs\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="backend\assets\libs\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
    <script src="backend\assets\libs\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
    <script src="backend\assets\libs\datatables.net-buttons-bs4\js\buttons.bootstrap4.min.js"></script>
    <script src="backend\assets\libs\datatables.net-buttons\js\buttons.html5.min.js"></script>
    <script src="backend\assets\libs\datatables.net-buttons\js\buttons.flash.min.js"></script>
    <script src="backend\assets\libs\datatables.net-buttons\js\buttons.print.min.js"></script>
    <script src="backend\assets\libs\datatables.net-keytable\js\dataTables.keyTable.min.js"></script>
    <script src="backend\assets\libs\datatables.net-select\js\dataTables.select.min.js"></script>
    <script src="backend\assets\libs\pdfmake\build\pdfmake.min.js"></script>
    <script src="backend\assets\libs\pdfmake\build\vfs_fonts.js"></script>
    <!-- Datatables init -->
    <script src="backend\assets\js\pages\datatables.init.js"></script>
@endsection
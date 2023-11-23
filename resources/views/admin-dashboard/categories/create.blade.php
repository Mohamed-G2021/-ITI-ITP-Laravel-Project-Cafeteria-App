@extends('layouts.app')
@section('content')
<head>

    <title>SB Admin 2 - Create Product</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/admin-dashboard/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/admin-dashboard/sb-admin-2.min.css') }}" rel="stylesheet">

</head>



<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
    @include('admin-dashboard.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            @include('admin-dashboard.topbar')
                <!-- Begin Page Content -->
                <div class="container-fluid">


    <div class="card p-4 m-5" style="width: 500px;">
        <div class="card-body">
            <h1 class="card-title text center">Create New Category</h1>



            <form method="post" action="{{route('categories.store')}}" enctype="multipart/form-data">
                @csrf

        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        <div>
            @error('name')
            <div style="color:red; font-weight:bold">{{ $message }}</div>
            @enderror

        </div>


        <div class="d-flex justify-content-center">
            @if(url()->previous()== "http://localhost:8000/admin/dashboard/products/create" ||url()->previous()== "http://127.0.0.1:8000/admin/dashboard/products/create" )
            <button type="submit" class="btn btn-warning" name="submit-button" value='back-to-product' style="width: 250px;">Submit and back to create product</button>

            @elseif (str_contains(url()->previous() , 'edit'))            
            <button type="submit" class="btn btn-warning" name="submit-button" value='back-to-product' style="width: 250px;">Submit and back to edit product</button>

            @else
            <button type="submit" class="btn btn-warning mb-3" style="width: 200px;">Submit</button>
            @endif
        </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>
@include('admin-dashboard.scripts')
</body>
@endsection
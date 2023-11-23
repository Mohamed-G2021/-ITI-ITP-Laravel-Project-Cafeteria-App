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

        <div class="row  justify-content-center mt-4 fw-bolder fs-5">
          <div class="col-lg-6 fw-bolder shadow p-5 rounded">
          <h1 class="fw-bolder"> Add new product</h1>
        <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                        <div class="mb-3">
                                <div class="form-row">
                                        <div class="form-group col-md-6">
                                                <label class="form-label">Category</label>
                                                <div class="input-group">
                                                        <select class="form-select" name='category_id' aria-label="Default select example">
                                                                <option selected disabled value="">Open this select menu</option>
                                                                @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                        </select>
                                                        <a href="{{ route('categories.create') }}" class="btn btn-warning mx-1">Add New Category</a>
                                                </div>
                                        </div>
                                </div>
                        </div>

                        <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                <div class="font-weight-bold text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Price</label>
                                <input class="form-control" name="price" id="exampleFormControlTextarea1" rows="3"></input>
                                @error('price')
                                <div class="font-weight-bold text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="exampleFormControlTextarea1" rows="3"></input>
                                @error('image')
                                <div class="font-weight-bold text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="mb-3">
                                <button type="submit" class="btn btn-warning">Submit</button>

                        </div>
        </form>
          </div>
      
        </div>
</div>
</div>
</div>
@include('admin-dashboard.scripts')
</body>
@endsection
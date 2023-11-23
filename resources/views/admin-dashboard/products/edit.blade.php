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
        <!-- <h1 class="text-start"> Edit {{$product->name}}</h1> -->
        <div class="row justify-content-center mt-4 fw-bolder fs-5">
        <form method="post"class="col-lg-6 shadow p-4 rounded" action="{{route('products.update', $product->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                <div class="mb-3">
                                <div class="form-row">
                                        <div class="form-group">
                                                <label class="form-label">Category</label>
                                                <div class="input-group">
                                                        <select class="form-select p-2" name='category_id' aria-label="Default select example">
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
                                <input type="text" name="name" value="{{old('name') ?? $product->name}}" class="form-control p-2">
                                @error('name')
                                <div class="font-weight-bold text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Price</label>
                                <input class="form-control p-2" name="price" value="{{$product->price}}" id="exampleFormControlTextarea1" rows="3"></input>
                                @error('price')
                                <div class="font-weight-bold text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                  

                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Image</label>
                                <input type="file" class="form-control p-2" name="image" value="{{$product->image}}" id="exampleFormControlTextarea1" rows="3"></input>
                                @error('image')
                                <div class="font-weight-bold text-danger">{{ $message }}</div>
                                @enderror
                   </div>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
        </div>

</div>
</div>
</div>
</div>
@include('admin-dashboard.scripts')
</body>
@endsection
@extends('layouts.app')
@section('content')
<head>

    <title>SB Admin 2 - Show Product</title>

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
            <h5 class="card-title text-capitalize fw-bolder fs-1 mb-3">{{ $category->name }}</h5>
{{--   
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                --}}

                @if ($category->products->isEmpty())
                    <p>No products found in this category.</p>
                @else
                    <ul>
                        @foreach ($category->products as $product)
                            <li class="text-capitalize fw-bolder">{{ $product->name }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="card-body">
                 
            
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning  mb-3" style="width: 200px;">
                        <a href="{{ route('categories.index') }}" class="text-black" style="text-decoration: none;">Back to all categories</a>
                    </button>
                </div>
                
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
    @include('admin-dashboard.scripts')
</body>
@endsection

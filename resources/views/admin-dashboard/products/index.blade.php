@extends('layouts.app')
@section('content')


<head>

    <title>SB Admin 2 - All Products</title>
    <title>SB Admin 2 - Dashboard</title>

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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">All Products</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>
        <a href="{{url('admin/dashboard/products/create')}}" class="btn btn-warning">Add new product</a>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Availability</th>
                                        <th>Actions</th>
                                        <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Availability</th>
                                        <th>Actions</th>
                                        <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->price}} egp</td>
                                            <td><img src="{{asset("/images/$product->image")}}" class="card-img-top" style="object-fit:contain; width:50px;height:60px"> </td>
                                            <td>
                                                    {{$product->availability}}
                                                    @if($product->availability == 'available')
                                                    <form action="{{route('products.change', $product->id)}}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-warning" name='update-button' value='unavailable'>Make unavailable</button>
                                                    </form>
                                                    @elseif($product->availability == 'unavailable')
                                                    <form action="{{route('products.change', $product->id)}}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-warning" name='update-button' value='available'>Make available</button>
                                                    </form>
                                                    @endif

                                            <td>
                                                    <a href="{{ url('admin/dashboard/products', $product->id) }}" class="btn text-white" style="background-color:#823a35">show</a>
                                                    <a href="{{url('admin/dashboard/products/' . $product->id . '/edit')}}" class="btn btn-warning">edit</a>
                                            </td>

                                            <form action="{{route('products.destroy',$product->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <td>
                                                            <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger">
                                                    </td>
                                            </form>

                                        </tr>
                                        @endforeach

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    @include('admin-dashboard.scripts')

</body>

</html>
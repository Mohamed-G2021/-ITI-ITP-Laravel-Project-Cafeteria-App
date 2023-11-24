@extends('layouts.app')
@section('content')
<head>

    <title>SB Admin 2 - All Branches</title>

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

    <h1 class="h3 mb-2 text-gray-800">All Branches</h1>
    <a href="{{ url('admin/dashboard/branches/create') }}" class="btn btn-warning text-black p-2 my-3 ">Add New Branch</a>
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr class="table-secondary ">
                        <th>Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branches as $branch)
                    <tr>

                        <td>{{ $branch->name }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{url('admin/dashboard/branches/' . $branch->id . '/edit')}}" class="btn btn-warning text-black mx-1">Edit</a>
                                <form action="{{ route('branches.destroy', $branch->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger mx-1">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
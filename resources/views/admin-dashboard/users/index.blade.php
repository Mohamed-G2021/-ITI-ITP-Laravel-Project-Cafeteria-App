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

    <a href="{{url('admin/dashboard/users/create') }}" class="mb-4 btn btn-warning mt-3 ">Add New User</a>
    </div>
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body ">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td> {{$user->name}}</td>
                        @if(str_contains( $user->image, 'https'))
                        <td><img src="{{ asset("$user->image") }}" width="50" height="60"> </td>
                        @else
                        <td> <img src="{{asset('images/'.$user->image)}}" width="50" height="60"></td>
                        @endif
                        <td> {{$user->email}}</td>

                        <td> <a href="{{ route('admin-users.edit', $user->id) }}" class="btn btn-warning"> Edit </a></td>
                        <td>
                            <form action="{{ route('admin-users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
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

    @include('admin-dashboard.scripts')

</body>

    @endsection
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
                <h2 class="fs-1 fw-bolder ">Checks</h2>

    <p>
        {{--$orders->first()->user--}}
        {{--@foreach($orders as $order)
            @foreach($order->products as $product)
                <p>{{$product->name ?? "--"}}</p>
            @endforeach
        @endforeach--}}

    </p>
    <!--start inputsinfo-->
    <div class="inputsinfo">

        <form id="filtration-form" method="GET" action="{{ url('/checks') }}">
            <!-- Add your filtration form elements here -->
        <div class="row my-4 fw-bolder">
            <div class=" mb-3 col-md-6">
            <label for="start" class="form-label">Date From</label>
            <input type="date" id="start" name="from_date" class="form-control">
            </div> 
            <div class="mb-3 col-md-6">
            <label for="end" class="form-label">Date To</label>
            <input type="date" id="end" name="to_date" class="form-control">
            </div> 
            <div class="col-md-6">
            <label for="name" class="form-label">User name</label>
            <select name="user_id" class="form-select" aria-label="Default select example">
                <option value="-1" selected >Select User</option>
                <option value="0"  >All User</option>

                @foreach($allusers as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            </div>
        </div>
            

            <!--<button type="submit">Filter</button>-->
        </form>


    </div>
    <!--end inputsinfo-->

    <!--start data-->
    <div class="data">

    <table class="table text-capitalize fw-bolder">
            <thead>
                <tr class="table-secondary ">

                <th scope="col" class="bg-white">Name</th>
                <th scope="col" class="bg-white">Total Amount</th>
                </tr>
            </thead>

                @foreach($users as $user)
                    <tbody class="py-2">
                        <tr>
                            <td >
                                <span id="showorderbody" class="h4">+</span> {{$user->name }}
                            </td>

                            <td>{{$user->total_amount}}</td>
                        </tr>

                    </tbody>
                    <!--start user orders-->
                    <tbody class="orderbody d-none">
                        <tr>
                            <th scope="col">Order Date</th>
                            <th scope="col">Amount</th>
                        </tr>

                    @foreach($orders as $order)
                        @if($order->user->id == $user->id)
                                <tr>
                                    <td>
                                        <span id="showproductbody" class="h4">+</span> {{$order->created_at }}
                                    </td>
                                    <td>{{$order->amount}}</td>
                                </tr>
                                <!--start products-->
                                <tr class="productbody d-none">
                                    <td colspan="2">
                                        <!--start show product-->
                                            <div class="row ">
                                                @foreach($order->products as $product)
                                                    <div class="col-md-3">
                                                        <div class="productprice">
                                                            <img src="{{asset('images/'.$product->image)}}" width="50px">
                                                            <span class="price">{{$product->price}} LE</span>
                                                        </div>

                                                        <p>{{$product->name}}</p>
                                                        <span>{{$product->pivot->quantity}}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        <!--end show product-->
                                    </td>
                                </tr>
                                <!--end products-->

                        @endif
                    @endforeach
                    </tbody>
            <!--end user orders-->
                @endforeach

    </table>



    </div>
    <!--end data-->

</div>
<!--end container-->

</div>
  </div>
    </div>
    @include('admin-dashboard.scripts')
</body>
@endsection





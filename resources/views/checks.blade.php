@extends('layouts.app')

@section('content')

<!--start container-->
<div class="container">
    <h2>Checks</h2>

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
            <label for="start">Date From</label>
            <input type="date" id="start" name="from_date">

            <label for="end">Date To</label>
            <input type="date" id="end" name="to_date">
            <label for="name">Username</label>
            <select name="user_id" class="form-select my-5 w-50" aria-label="Default select example">
                <option value="-1">Select User </option>
                <option value="0" >All User</option>
                @foreach($allusers as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>

            <!--<button type="submit">Filter</button>-->
        </form>


    </div>
    <!--end inputsinfo-->

    <!--start data-->
    <div class="data">

    <table class="table table-bordered border-primary">
            <thead>
                <tr>

                <th scope="col">Name</th>
                <th scope="col">Total Amount</th>
                </tr>
            </thead>

                @foreach($users as $user)
                    <tbody>
                        <tr>
                            <td>
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
                                            <div class="row">
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


@endsection





@extends('layouts.app')

@section('content')
<style>
   .main{
        background-color:#823a35;
        color:white;
        height:100vh;
   }
   td{
    background-color:#a1625d !important;
    color:white !important;
   }
</style>
<div class="main pt-5">

<div class="container">
        <h1>All Products</h1>

        <br>
        <a href="{{route('products.create')}}" class="btn btn-warning">Add new product</a>
        <br><br>
        <table class="table text-capitalize">
                <thead>
                        <tr class="table-secondary">
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Availability</th>
                                <th>Actions</th>
                                <th>Delete</th>
                        </tr>
                </thead>

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
                                        <a href="{{route('products.show',$product->id)}}" class="btn text-white" style="background-color:#823a35">show</a>
                                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-warning">edit</a>
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
        <div class="d-flex">
                {!! $products->links() !!}
        </div>
</div>
</div>
<div class="text-center p-4 text-white " style="background-color: #823a35">
    © 2021 Copyright:
    <a class="text-reset fw-bold" href="#">Cafeteria.com</a>
  </div>
@endsection
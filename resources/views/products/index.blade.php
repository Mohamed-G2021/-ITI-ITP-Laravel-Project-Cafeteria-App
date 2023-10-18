@extends('layouts.app')

@section('content')
<div class="container fw-bolder">
        <h2 class="fw-bolder fs-1">All Products</h2>
        <br>
        <a href="{{route('products.create')}}" class="btn btn-success">Add new product</a>
        <br><br>
        <table class="table text-capitalize">
                <thead>
                        <tr class="table-secondary">
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Image</th>
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
                                        @if($product->availability == 'available')
                                        <a href="" class="btn btn-success mr-1"> Available</a>
                                        @else
                                        <a href="" class="btn btn-secondary mr-1">Unavailable</a>
                                        @endif
                                        <a href="{{route('products.show',$product->id)}}" class="btn btn-info mr-1">show</a>
                                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-warning mr-1">edit</a>
                                        <form action="{{route('products.destroy',$product->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                <td> <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger"></td>
                                </form>

                        </tr>
                        @endforeach

                </tbody>
        </table>
        <div class="d-flex">
 {!! $products->links() !!}
 </div>
</div>
@endsection
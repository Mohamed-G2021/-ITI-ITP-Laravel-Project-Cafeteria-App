@extends('layouts.app')

@section('content')

@section('content')
<div class="container">
        <h1>All Products</h1>
        <br>
        <a href="{{route('products.create')}}" class="btn btn-primary">Add new product</a>
        <br><br>
        <table class="table">
                <thead>
                        <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Show</th>
                                <th>Edit</th>
                                <th>Delete</th>
                        </tr>
                </thead>

                <tbody>
                        @foreach($products as $product)

                        <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td> <img src="" class="card-img-top" height="200" style="object-fit: contain;"> </td>
                                <td><a href="{{route('products.show',$product->id)}}" class="btn btn-primary">show</a></td>
                                <td><a href="{{route('products.edit',$product->id)}}" class="btn btn-warning">edit</a></td>
                                <form action="{{route('products.destroy',$product->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <td> <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger"></td>
                                </form>

                        </tr>
                        @endforeach

                </tbody>
        </table>
</div>
@endsection('content')
@endsection
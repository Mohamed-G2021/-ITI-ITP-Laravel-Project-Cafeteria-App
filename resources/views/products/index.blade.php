@extends('layouts.app')

@section('content')

@section('content')
@if($errors->any())
<div class="alert alert-danger">
        <p><strong>Opps Something went wrong</strong></p>
        <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
        </ul>
</div>
@endif
<div class="container">
        <h1>All Products</h1>
        <br>
        <a href="{{route('products.create')}}" class="btn btn-primary">Add new product</a>
        <br><br>
        <table class="table">
                <thead>
                        <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Available</th>
                                <th>Actions</th>
                                <th>Delete</th>
                        </tr>
                </thead>

                <tbody>
                        @foreach($products as $product)
                        <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}} egp</td>
                                <td><img src="{{asset("/images/$product->image")}}" class="card-img-top" height="200" style="object-fit: contain; width:100px;height:100px"> </td>
                                <td>
                                        @if($product->availability == 'available')
                                        <form action="{{route('products.change', $product->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning" name='update-button' value='unavailable'>Unavailable</button>
                                        </form>
                                        @elseif($product->availability == 'unavailable')
                                        <form action="{{route('products.change', $product->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-info" name='update-button' value='available'>Available</button>
                                        </form>
                                        @endif

                                <td>
                                        <a href="{{route('products.show',$product->id)}}" class="btn btn-primary">show</a>
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
@endsection('content')
@endsection
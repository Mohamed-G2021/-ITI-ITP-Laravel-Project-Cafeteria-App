@extends('layouts.app')

@section('content')
<div class="container">
        <h1>{{$product->name}} product details</h1>

        <div class="card" style="width: 18rem;">
                <div class="card-body">
                        <img src="" class="card-img-top" height="200" style="object-fit: contain;">
                        <h5 class="card-title">Name: {{$product->name}}</h5>
                        <h5 class="card-title">Price: {{$product->price}} egp</h5>
                        <h5 class="card-title">Category: <a href="">$category</a></h5>
                        <h5 class="card-title">Created at: {{$product->created_at}}</h5>
                        <h5 class="card-title">Updated at: {{$product->updated_at}}</h5>
                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-primary">Edit</a>

                        <br><br>
                        <form action="{{route('products.destroy',$product->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger">
                        </form>

                </div>
        </div>
        <br>

        @endsection
@extends('layouts.app')

@section('content')

<div class="container">
        <h1> Edit {{$product->name}}</h1>

        <form method="post" action="{{route('products.update', $product->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">

                        <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{$product->name}}" class="form-control">

                        </div>
                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Price</label>
                                <input class="form-control" name="price" value="{{$product->price}}" id="exampleFormControlTextarea1" rows="3"></input>

                        </div>

                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" value="{{$product->image}}" id="exampleFormControlTextarea1" rows="3"></input>

                        </div>


                        <button type="submit" class="btn btn-primary">Update</button>
        </form>
</div>

@endsection
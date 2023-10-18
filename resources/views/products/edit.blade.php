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
                                <input type="text" name="name" value="{{old('name') ?? $product->name}}" class="form-control">
                                @error('name')
                                <div class="font-weight-bold text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Price</label>
                                <input class="form-control" name="price" value="{{$product->price}}" id="exampleFormControlTextarea1" rows="3"></input>
                                @error('price')
                                <div class="font-weight-bold text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="mb-3">
                                <div class="form-row">
                                        <div class="form-group col-md-6">
                                                <label class="form-label">Category</label>
                                                <div class="input-group">
                                                        <select class="form-select" name='category_id' aria-label="Default select example">
                                                                <option selected disabled value="">Open this select menu</option>
                                                                @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                        </select>
                                                        <a href="{{ route('categories.create') }}" class="btn btn-info mx-1">Add New Category</a>
                                                </div>
                                        </div>
                                </div>
                        </div>

                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" value="{{$product->image}}" id="exampleFormControlTextarea1" rows="3"></input>
                                @error('image')
                                <div class="font-weight-bold text-danger">{{ $message }}</div>
                                @enderror
                        </div>


                        <button type="submit" class="btn btn-primary">Update</button>
        </form>
</div>

@endsection
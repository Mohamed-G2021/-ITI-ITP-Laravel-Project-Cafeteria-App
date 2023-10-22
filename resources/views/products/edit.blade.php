@extends('layouts.app')

@section('content')

<div class="container">
        <!-- <h1 class="text-start"> Edit {{$product->name}}</h1> -->
        <div class="row justify-content-center mt-4 fw-bolder fs-5">
                <form method="post" class="col-lg-6 shadow p-4 rounded" action="{{route('products.update', $product->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                                <div class="form-row">
                                        <div class="form-group">
                                                <label class="form-label">Category</label>
                                                <div class="input-group">
                                                        <select class="form-select p-2" name='category_id' aria-label="Default select example">
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
                                <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" value="{{old('name') ?? $product->name}}" class="form-control p-2">
                                        @error('name')
                                        <div class="font-weight-bold text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Price</label>
                                        <input class="form-control p-2" name="price" value="{{$product->price}}" id="exampleFormControlTextarea1" rows="3"></input>
                                        @error('price')
                                        <div class="font-weight-bold text-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Image</label>
                                        <input type="file" class="form-control p-2" name="image" value="{{$product->image}}" id="exampleFormControlTextarea1" rows="3"></input>
                                        @error('image')
                                        <div class="font-weight-bold text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                </form>
        </div>

</div>

@endsection
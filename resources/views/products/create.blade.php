@extends('layouts.app')

@section('content')

<div class="container">
        <h1> Add new product</h1>

        <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">

                        <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control">

                        </div>
                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Price</label>
                                <input class="form-control" name="price" id="exampleFormControlTextarea1" rows="3"></input>

                        </div>

                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="exampleFormControlTextarea1" rows="3"></input>

                        </div>

                        <div class="mb-3">
                                <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Category</label>
                                            <div class="input-group">
                        <select class="form-select"  name='category_id' aria-label="Default select example">
                            <option selected disabled value="">Open this select menu</option>
                            @foreach($category as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('categories.create', $category->id) }}" class="btn btn-info mx-1">Add New Category</a>
                        </div>
                    </div>
                                </div>
                        </div>
                        <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
</div>

@endsection
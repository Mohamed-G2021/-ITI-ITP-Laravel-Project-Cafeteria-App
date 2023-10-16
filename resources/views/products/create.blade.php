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
                                <label for="" class="form-label">Category</label>
                                <select class="form-select col-4" aria-label="Default select example">
                                        <option selected disabled value="">select category</option>
                                        <option value="">category</option>

                                </select>

                        </div>

                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="exampleFormControlTextarea1" rows="3"></input>

                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>

@endsection
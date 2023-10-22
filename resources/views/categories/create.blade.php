@extends('layouts.app')
@section('content')
<style>
    .card{
        background-color:#823a35;
        color:white;

    }
</style>
<div class="main">
<div class="container d-flex align-items-center justify-content-center mt-5">


    <div class="card p-4 m-5" style="width: 500px;">
        <div class="card-body">
            <h1 class="card-title text center">Create New Category</h1>



            <form method="post" action="{{route('categories.store')}}" enctype="multipart/form-data">
                @csrf

        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        <div>
            @error('name')
            <div style="color:red; font-weight:bold">{{ $message }}</div>
            @enderror

        </div>


        <div class="d-flex justify-content-center">
<<<<<<< Updated upstream
            @if(str_contains(url()->previous(), 'create'))
            <button type="submit" class="btn btn-success" name="submit-button" value='back-to-product' style="width: 250px;">Submit and back to create product</button>
            @elseif(str_contains(url()->previous(), 'edit'))
            <button type="submit" class="btn btn-success" name="submit-button" value='back-to-product' style="width: 250px;">Submit and back to edit product</button>
=======
            @if(url()->previous()== "http://localhost:8000/products/create" ||url()->previous()== "http://127.0.0.1:8000/products/create" )
            <button type="submit" class="btn btn-warning" name="submit-button" value='back-to-product' style="width: 250px;">Submit and back to create product</button>

            @elseif (str_contains(url()->previous() , 'edit'))            
            <button type="submit" class="btn btn-warning" name="submit-button" value='back-to-product' style="width: 250px;">Submit and back to edit product</button>

>>>>>>> Stashed changes
            @else
            <button type="submit" class="btn btn-warning mb-3" style="width: 200px;">Submit</button>
            @endif
        </div>
        </form>
    </div>
</div>
</div>
</div>

@endsection
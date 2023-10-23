@extends('layouts.app')

@section('content')
<style>
.main{
        background-color:#823a35;
        color:white;
        height:100vh;
        width:100%;

    }
</style>
<div class="main pt-5">
<div class="container">
    <h1 class="fs-1 fw-bolder text-capitalize my-3">{{$product->name}} product details</h1>
    <div class="row">
        <div class="card col-md-8 p-0 shadow my-3">
            <div class="row g-0">
                <div class="col-md-4 ">
                    <img src="{{asset("/images/$product->image")}}" class="img-fluid rounded-start " style="width:100%;height:100%">
                </div>
                <div class="col-md-8">
                    <div class="card-body p-4">
                        <h3 class="card-title fs-1 mb-4">{{$product->name}}</h3>
                        <h4 class="card-title">{{$product->price}} EGP</h4>
                        @if($product->category)
                        <h5 class="card-title">Category: <a href="{{ route('categories.show', $product->category_id) }}">{{$product->category->name}}</a></h5>
                        @endif
                        <h5 class="card-title">Created at: {{$product->created_at}}</h5>
                        <!-- <h5 class="card-title">Updated at: {{$product->updated_at}}</h5> -->
                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-warning px-3 my-3">Edit</a>


                        <form action="{{route('products.destroy',$product->id)}}" method="post" class="d-inline ms-3">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger">
                        </form>

                    </div>

                </div>

            </div>

        </div>
    </div>
    <br>
    <div class="">
        <a href="{{route('products.index')}}" class="btn btn-warning text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
            </svg><span class="ms-2">Back to all products</span></a>
    </div>
</div>
</div>
<div class="text-center p-4 text-white" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2023 Copyright:
    <a class="text-reset fw-bold" href="#">Cafeteria.com</a>
  </div>
<!-- <div class="owl-carousel">
    @foreach($products as $product)
        <div class="item">
            <h4>{{ $product->name }}</h4>
            <p>{{ $product->description }}</p>
        </div>
    @endforeach
</div> -->
@endsection
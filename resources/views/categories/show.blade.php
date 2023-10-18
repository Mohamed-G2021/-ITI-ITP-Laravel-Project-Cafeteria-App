@extends('layouts.app')
@section('content')
<div class="container d-flex align-items-center justify-content-center mt-5" >


    <div class="card p-4 m-5" style="width: 500px;">
        <div class="card-body">
            <h5 class="card-title text-capitalize fw-bolder fs-1 mb-3">{{ $category->name }}</h5>
{{--   
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                --}}

                @if ($category->products->isEmpty())
                    <p>No products found in this category.</p>
                @else
                    <ul>
                        @foreach ($category->products as $product)
                            <li class="text-capitalize fw-bolder">{{ $product->name }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="card-body">
                 
            
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success mb-3" style="width: 200px;">
                        <a href="{{ route('categories.index') }}" class="text-white" style="text-decoration: none;">Back to all categories</a>
                    </button>
                </div>
                
                </div>
            </div>
        </div>
    </div>

@endsection

@php
use \App\Http\Controllers\OrderProductController;
@endphp
@extends('layouts.app')
@section('content')

<style>
  textarea {
  width: 100%;
  height: 100px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  /* resize: none; */
}
</style>
<!-- <nav class="navbar bg-body-tertiary justify-content-end me-5">
  <div class="container d-flex justify-content-center ">
    
<nav class="navbar bg-body-tertiary justify-content-end me-5">
  <div class="container-fluid d-flex justify-content-center ">
    <h1>Welcome {{ Auth::user()->name }}</h1>
  </div>
  <span>
    <div class="input-group d-flex " role="search">

      <div class="form-floating ">
        <input class="form-control " type="search" placeholder="Search">
      </div>
      <span class="input-group-text w-25 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" id="IconChangeColor">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" 
           id="mainIconPathAttribute"></path>
        </svg>
      </span>
    </div>
  </span>
  </form>
  </div>
</nav> -->

<div class="container shop">
<h1 class="fw-bolder fs-1 text-center text-warning">Enjoy Your Coffee</h1>
 <div class="row mt-4 py-3">
    
    <div class="col-md-6">
    <h4 class="fw-bold fs-5">Latest Order</h4>
       <div class="row row-cols-4 justify-content-center text-center">
        @foreach ($orderProducts as $orderProduct)
         <div class="col">
          <img src="{{ asset('images/products_images/'.$orderProduct->product->image) }}" 
            class="" alt="" style="width:50px;height:70px;">
          <p class="text-center">{{$orderProduct->product->name}}</p>
         </div>
        @endforeach
      </div>
      <hr>
      <div class="row row-cols-4 text-center">
        @foreach ($products as $prd)
          <div class="col">
          <form action="{{route('order-products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input name="productId" type="hidden" value="{{$prd->id}}">
            <button type="submit" class="border-0" onclick="">
              <img src="{{asset("/images/$prd->image")}}" alt="order_image" style="width:50px;height:50px;">
            </button>
          </form>
          <p name="name" value="{{ $prd->name }}">{{ $prd->name }}</p>
          <p name="price" value="{{ $prd->price }}">{{ $prd->price }} EGP</p>
        </div>
        @endforeach
      </div>
   </div>
<!-- ///////////////////////////////////////////////////////////////////// -->
<div class="col-md-6">
   <div class="cart">
        <a href="/" class="link-dark text-decoration-none">
          <h3 class="fw-bolder fs-5">Shopping Cart</h3>
         
        </a>
       
        <table class="table text-center mt-3 table-light">
            <thead>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th></th>
            </thead>
             <tbody>
              @foreach ($orderProducts as $orderProduct)
              <tr>
                <th scope="row">{{$orderProduct->product->name}}</th>
                <td class=""> 
                  <div class="d-flex justify-content-center">
                  <form action="{{ route('order-products.update', $orderProduct->id) }}" method="post">
                      @csrf
                      @method('PUT')
                      <input type="submit" value="-" name="remove" class="btn btn-warning">
                    </form>
                    <h4 class="text-center p-2">{{$orderProduct->quantity}}</h4>
                    <form action="{{ route('order-products.update', $orderProduct->id) }}" method="post">
                      @csrf
                      @method('PUT')
                      <input type="submit" value="+" name="add" class="rounded btn btn-warning" >
                    </form>
                  </div>
                </td>
                <td class="fw-bold">{{$orderProduct->product->price}} EGP</td>
                <td>
                  <form action="{{route('order-products.destroy', $orderProduct->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="x" class="btn btn-danger">
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
       </table>    
   </div>

          <div class=" mt-2">
            <div class="">
            <label for="floatingTextarea">Note</label>
              <textarea id="floatingTextarea" name="notes"></textarea>
             </div>
       <div class="select mb-2">
        <label for="">Branch</label>
            <select class="form-select">
              <option selected>Choose Branch</option>
              <option value="">Zayed</option>
              <option value="">Nasr City</option>
              <option value="">New Cairo</option>
            </select>
          </div>
           <hr>
           <div class="d-flex justify-content-between">
            <p class="fs-3 ">{{$amount}} EGP</p>
            <form action="{{route('process-data')}}" method="post" enctype="multipart/form-data">
              @csrf
              <button class="btn btn-danger float-end" type="submit" value="done">Order Now</button>
            </form>
          </div>
   </div>       
    </div>
  </div>
</div>

<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="">
  /* global bootstrap: false */
  (function() {
    'use strict'
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(function(tooltipTriggerEl) {
      new bootstrap.Tooltip(tooltipTriggerEl)
    })
  })()
</script>

@endsection

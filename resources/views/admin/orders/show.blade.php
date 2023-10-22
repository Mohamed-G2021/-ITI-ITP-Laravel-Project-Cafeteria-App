@extends('layouts.app')
@section('content')
<style>
   .main{
        background-color:#823a35;
        color:white;
        height:100vh;
   }
</style>
<div class="main">
 <section class="order_details  container my-5">
<div class="row border gap-5 justify-content-center py-4">
@foreach($order->products as $product)
  <div class="col-md-3 border rounded text-center p-3" style="width:150px">
       <img src="{{asset('images/'.$product->image)}}" class="" alt="tea"  style="width:100px; height:100px"> 
        <h5 class="mt-3">{{$product->name}}</h5>
        <p class="">{{$product->price}} EGP </p>
         <p>{{$product->quantity}} </p>   
   </div>
@endforeach
 </div>
 <h1>Total:{{$order->amount}}</h1>
</section>
</main>
<div class="text-center p-4 text-white" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2021 Copyright:
    <a class="text-reset fw-bold" href="#">Cafeteria.com</a>
  </div>
@endsection

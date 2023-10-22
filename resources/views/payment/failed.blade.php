@extends('layouts.app')
@section('content')
<style>
  .failed{
    background:#fb082936;
    text-transform: capitalize;
  }
</style>
 <section class="container">
   <div class="row justify-content-center mt-3">
    <div class="col-6 failed p-5 rounded text-center">
        <h1 class="fs-1 fw-bolder mb-5"> payment failed</h1>
       <a href="{{route('order-products.index')}}"> <button type="button" class="btn btn-danger" >Go to home</button></a>
    </div>
   </div>
 </section>



@endsection
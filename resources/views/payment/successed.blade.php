@extends('layouts.app')
@section('content')
<style>
  .success{
    background: #b6ddb6;
    text-transform: capitalize;
  }
</style>
 <section class="container">
   <div class="row justify-content-center mt-3">
    <div class="col-6 success p-5 rounded">
        <h1 class="fs-1 fw-bolder mb-3 text-center ">payment done successfully</h1>
       <ul class="fs-5 fw-bold">
        <li>
         order Products
        </li>
        <li>
        Amount:
        </li>
       </ul>
    </div>
   </div>
 </section>



@endsection
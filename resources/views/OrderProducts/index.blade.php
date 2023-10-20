
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
<nav class="navbar bg-body-tertiary justify-content-end me-5">
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
</nav>

<div class="row">

  <div class="col">
  @if(Auth::check() && Auth::user()->role === 'admin')
    
  <h1>Add to user</h1>
  <form action="{{route('cust')}}" method="post" enctype="multipart/form-data">
    @csrf
  <select class="form-select mb-4" name="user" >
    @foreach ($users as $user )
        <option value="{{$user->id}}">{{$user->name}}</option>
    @endforeach
    
  </select>
  <button class="btn btn-danger float-end" type="submit">Go</button>
</form>
  @else
   
    <h4 class="mt-5 m-5 fs-3 fw-bold">Latest Order</h4>

    @if (!empty($userOrders))      
    <div class="container text-center mt-3 ">
      <div class="row row-cols-3">
            @foreach ($userOrders->products as $product)

        <div class="col">
          <img src="{{ asset('images/'.$product->image) }}" class="w-50" alt="">
          <p>{{$product->name}}</p>
        </div>
        @endforeach

      </div>
    </div>
@else
<h5 class="m-5 text-primary">You didn't order anything yet</h5>
    <hr>
  @endif
    @endif

    </form>
    <div class="container text-center mt-3 ">
      <div class="row row-cols-4">

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
  </div>

  <div class="col-4  ms-5 me-5">
    <main>
      <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="">
        <!-- <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom"> -->
           <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
          <span class="fs-2 fw-semibold">Shopping Cart</span>
        <!-- </a> -->
        <div class="list-group list-group-flush border-bottom ">

        <table class="table text-center mt-3 table-light">
            <thead>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th></th>
            </thead>
            <tbody>
             <tbody>
              @foreach ($cart as $item)
              <tr>
                <th scope="row">{{$item->product->name}}</th>
                <td class="table-active d-flex justify-content-center">
                  <div class="d-flex justify-content-center">
                  <form action="{{ route('order-products.update', $item['id']) }}" method="post">
                      @csrf
                      @method('PUT')
                      <input type="submit" value="-" name="remove" class="btn btn-warning">
                    </form>


                    <button class="btn btn-warning-outline border-0 disabled fs-5">{{$item['quantity']}}</button>

                    <form action="{{ route('order-products.update', $item['id']) }}" method="post">
                      @csrf
                      @method('PUT')
                      <input type="submit" value="+" name="add" class="rounded btn btn-warning" >
                    </form>

                  </div>
                </td>
                <td>{{$item->product->price}} EGP</td>
                <td>
                  <form action="{{route('order-products.destroy', $item['id'])}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="X" class="btn btn-warning">
                  </form>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>

          
          <div class="d-flex flex-column align-items-end">
            <form action="{{route('process-data')}}" method="post" enctype="multipart/form-data">
                  @csrf
        <h3>Notes</h3>
         <textarea name="notes" type="submit" id="" cols="79" rows="5" class="w-100">{{old('notes')}}</textarea>

          <div class=" align-items-center ">

            <h3>Branch</h3>
            <select class="form-select mb-4" name="branch" >
              <option selected>Choose Branch</option>
              <option value="1">Zayed</option>
              <option value="2">Nasr City</option>
              <option value="3">New Cairo</option>
            </select>
          </div>
          <br>
          <hr>

            <p class="fs-3 " id="amount">{{$amount}} EGP</p>

            <form action="{{route('process-data')}}" method="post" enctype="multipart/form-data">
              @csrf
              <button class="btn btn-danger float-end" onclick="del()" value="done">Confirm</button>
                  <input type="hidden" name="confirmed" value="0">
            </form>
          </div>
   </div>       
    </div>
  </div>
</div>
<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">
    </script>


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

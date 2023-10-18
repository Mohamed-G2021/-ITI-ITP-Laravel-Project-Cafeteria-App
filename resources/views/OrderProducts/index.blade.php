
@extends('layouts.app')
@section('content')

<nav class="navbar bg-body-tertiary justify-content-end me-5">
  <div class="container-fluid d-flex justify-content-center ">
  </div>
  <span>
    <div class="input-group d-flex " role="search">

      <div class="form-floating ">
        <input class="form-control " type="search" placeholder="Search">
      </div>
      <span class="input-group-text w-25 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" id="IconChangeColor">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" id="mainIconPathAttribute"></path>
        </svg>
      </span>
    </div>
  </span>
  </form>
  </div>
</nav>




<div class="row">

  <div class="col">
  @if(Auth::id())
    
  <h1>Add to user</h1>
  <select class="form-select mb-4">
      <option selected>Choose Branch</option>
      <option value="">Zayed</option>
      <option value="">Nasr City</option>
      <option value="">New Cairo</option>
  </select>
  
    @else
   

    <h4 class="mt-5">Latest Order</h4>
    <div class="container text-center mt-3 ">
      <div class="row row-cols-3">
        @foreach ($orderProducts as $orderProduct)
        <div class="col">
          <img src="{{ asset('images/products_images/'.$orderProduct->product->image) }}" class="w-50" alt="">
          <p>{{$orderProduct->product->name}}</p>
        </div>
        @endforeach
      </div>
    </div>
    <hr>
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
              <img src="{{asset("/images/$prd->image")}}" class="w-100" alt="">
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
        <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
          <!-- <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg> -->
          <span class="fs-2 fw-semibold">Shopping Cart</span>
        </a>
        <div class="list-group list-group-flush border-bottom ">

          <table class="table table-dark text-center " >
            <thead>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th></th>
            </thead>
            <tbody id="table_body">
              @foreach ($orderProducts as $orderProduct)
              <tr>
                <th scope="row">{{$orderProduct->product->name}}</th>
                <td class="table-active d-flex justify-content-center">
                  <div class="border-5 d-flex bg-danger rounded text-center">
                    <form action="{{ route('order-products.update', $orderProduct->id) }}" method="post">
                      @csrf
                      @method('PUT')
                      <input type="submit" value="-" name="remove" class="btn btn-danger border-0">
                    </form>


                    <button class="btn btn-warning-outline border-0 disabled fs-5">{{$orderProduct->quantity}}</button>

                    <form action="{{ route('order-products.update', $orderProduct->id) }}" method="post">
                      @csrf
                      @method('PUT')
                      <input type="submit" value="+" name="add" class="btn btn-danger border-0">
                    </form>

                  </div>
                </td>
                <td>{{$orderProduct->product->price}} EGP</td>
                <td>
                  <form action="{{route('order-products.destroy', $orderProduct->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="X" class="btn btn-danger">
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
            <select class="form-select mb-4" name="branch">
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
              <button class="btn btn-danger float-end" type="submit" value="done">Confirm</button>

            </form>
          </div>
        </div>
      </div>
  </div>


  </main>
</div>
<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">
    </script>

<script>
        function del(event) {
            $('#table_body').detach();
            $('#amount').text('0 EGP')
           
        }
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
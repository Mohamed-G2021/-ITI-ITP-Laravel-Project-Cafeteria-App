@extends('layouts.app')
@section('content')
<style>
  .success {
    background: #b6ddb6;
    text-transform: capitalize;
  }
</style>
<section class="container">
  <div class="row justify-content-center mt-3">
    <div class="col-6 success p-5 rounded">
      <h1 class="fs-1 fw-bolder mb-3 text-center ">payment done successfully</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">name</th>
            <th scope="col">price</th>
            <th scope="col">quantity</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $index => $product)
          <tr>
            <td>
              {{$product->name}}
            </td>
            <td>
              {{$product->price}}
            </td>
            <td>
              {{$quantity[$index]}}
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>

      <div class="h3 text-success">
        Amount: {{$order->amount}}
      </div>
      <a href="{{route('order-products.index')}}"> <button type="button" class="btn btn-danger">Go to home</button></a>
    </div>
  </div>
</section>



@endsection
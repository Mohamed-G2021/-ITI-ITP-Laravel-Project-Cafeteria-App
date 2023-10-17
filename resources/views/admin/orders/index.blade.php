@extends('layouts.app')
@section('content')
<section class="container">
    <h2>My Orders</h2>
  <form action="{{ route('adminfilter.filter') }}" method="GET">
  <div class="row my-4">
  <div class="input-group mb-3 col">
  <input type="date" name="start_date" id="start_date" class="form-control">
  </div> 
  <div class="input-group mb-3 col">
  <input type="date" name="end_date" id="start_date" class="form-control">
  </div>
  <div class="col">
  <button type="submit" class="btn btn-secondary" >Filter</button>
  </div>
</div>
  </form>
<div class="orders">
<table class="table  table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">Order Date </th>
      <th scope="col">Name</th>
      <th scope="col">Room</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    @foreach($orders as $order)
    <tr>
      <td scope="row" class="d-flex justify-content-between">
        <p>{{$order->created_at}}</p>
       </td>
      
       <td>{{$order->user->name}}</td>
       <td>{{$order->status}}</td>
      <td>
      <form action="{{ route('admins-orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <select name="status" id="status" class="form-select" onchange="this.form.submit()">
           
                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="out for delivery" {{ $order->status === 'out for delivery' ? 'selected' : '' }}>out for delivery</option>
                <option value="done" {{ $order->status === 'done' ? 'selected' : '' }}>done</option>
            </select>
            <!-- <button type="submit"></button> -->
        </form>
      </td>
    </tr>
        <tr>
         <td colspan="4">
      <section class="order_details  container my-1">
     <div class="row border gap-2 justify-content-center">
    @foreach($order->products as $product)
    <div class="col-md-3  text-center p-3" style="width:150px">
       <img src="{{asset('images/'.$product->image)}}" class="" alt="tea"  style="width:50px; height:60px"> 
        <h5 class="mt-3">{{$product->name}}</h5>
        <p class="">{{$product->price}} EGP </p>
         <p>{{$product->pivot->quantity}} </p>   
     </div>
    @endforeach
    <h4 class="text-end">Total:{{$order->amount}}</h4>
   </div>
   </section>
         </td>
        </tr>
    @endforeach
  </tbody>
</table> 

</div>
<div class="d-flex pagination">
 {!! $orders->links() !!}
 </div>
</section>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#status').on('change', function() {
            $('#update-status-form').submit();
        });
    });
</script> -->
@endsection



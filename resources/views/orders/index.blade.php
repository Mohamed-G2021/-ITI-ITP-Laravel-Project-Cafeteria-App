@extends('layouts.app')
@section('content')

<section class="container">
    <h2>My Orders</h2>
<div class="row my-4">
  <div class="input-group mb-3 col">
  <input type="date" class="form-control">
  </div>
  <div class="input-group mb-3 col">
  <input type="date" class="form-control">
  </div>
</div>
<div class="orders">
<table class="table  table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">Order Date </th>
      <th scope="col">Status</th>
      <th scope="col">Amount</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    @foreach($orders as $order)
    <tr>
      <td scope="row" class="d-flex justify-content-between">
        <p>{{$order->created_at}}</p>
        <span  onclick="toggleDiv()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
          <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
           <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
       </svg></span>
       </td>
      <td>{{$order->status}}</td>
      <td>{{$order->amount}}</td>
      <td>
       @if($order->status=="processing")
        <form action="{{route('orders.destroy', $order->id)}}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <input type="submit"   class="btn btn-danger" value="Cancel">
       </form>
       @endif
                       </td>
    </tr>
    @endforeach
  </tbody>
</table> 
<div class="order_details row border justify-content-center py-3"  id="myDiv" >
 <div class="col-2">
<div class="card text-center" style="width: 100%;">
  <img src="/images/tea.png" class="card-img-top m-auto" alt="rtea"  style="width:100px; height:100px"> 
  <div class="card-body">
    <h5 class="card-title">Tea</h5>
    <p class="card-text">50$</p>
    <p>2</p>
  </div>
</div>
 </div>

 <div class="col-2 ">
<div class="card text-center" style="width:100%;">
  <img src="/images/tea.png" class="card-img-top  m-auto" alt="rtea"  style="width:100px; height:100px"> 
  <div class="card-body">
    <h5 class="card-title">Tea</h5>
    <p class="card-text">50$</p>
    <p>2</p>
  </div>
</div>
 </div>
 <div class="col-2">
<div class="card text-center" style="width: 10rem;">
  <img src="/images/tea.png" class="card-img-top  m-auto" alt="rtea"  style="width:100px; height:100px"> 
  <div class="card-body">
    <h5 class="card-title">Tea</h5>
    <p class="card-text">50$</p>
    <p>2</p>
  </div>
</div>
 </div>
 <h1>Total:150</h1>
</div>
</div>
</section>

<script>
    function toggleDiv() {
        var div = document.getElementById("myDiv");
        div.style.display = div.style.display === "flex" ? "none" : "flex";
    }
</script>
@endsection

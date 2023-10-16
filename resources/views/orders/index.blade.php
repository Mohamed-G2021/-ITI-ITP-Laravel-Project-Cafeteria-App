@extends('layouts.app')
@section('content')

<section class="container">
    <h2>My Orders</h2>
  <form action="{{ route('select.filter') }}" method="GET">
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
          <a href="{{route('orders.show', $order->id)}}"> <span>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
          <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
           <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
       </svg></span></a>
       </td>
      <td>{{$order->status}}</td>
      <td>{{$order->amount}}</td>
      <td><form action="{{route('orders.destroy', $order->id)}}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <input type="submit"   class="btn btn-danger" value="Cancel">
         </form></td>
    </tr>
    @endforeach
  </tbody>
</table> 
</div>
<div class="d-flex">
 {!! $orders->links() !!}
 </div>
</section>

<script>
    function toggleDiv() {
        var div = document.getElementById("myDiv");
        div.style.display = div.style.display === "flex" ? "none" : "flex";
    }
</script>
@endsection

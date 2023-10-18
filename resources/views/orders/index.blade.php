@extends('layouts.app')
@section('content')
<style>
  .hide{
    display:none;
  }
  .show{
    display:block;
  }
</style>
<section class="container">
  @if($orders->count())
    <h2 class="fw-bolder fs-1">My Orders</h2>
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
<table class="table fw-bolder">
  <thead>
    <tr class="table-secondary">
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
        <svg class="icon" data-order-id="{{ $order->id }}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path id="plus-icon" d="M12 7V12H7V14H12V19H14V14H19V12H14V7H12Z"/>
                    <path id="minus-icon" d="M7 12H19V14H7V12Z"/>
                </svg>
       </td>
      <td>{{$order->status}}</td>
      <td>{{$order->amount}}</td>
      <td><form action="{{route('orders.destroy', $order->id)}}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <input type="submit"   class="btn btn-danger" value="Cancel" onclick="return confirm('Are you sure you want to cancel this order?')" >
         </form>
        </td>
    </tr>
      <tr class="order-details-row" style="display: none;" >
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
 @else
 <div>
  <h1 class="text-center fw-bolder fs-1 mt-5">Your Cart Is Currently Empty</h1>
 </div>
 @endif
 
 
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.icon').on('click', function() {
            var orderId = $(this).data('order-id');
            var plusIcon = $(this).find('#plus-icon');
            var minusIcon = $(this).find('#minus-icon');
            var detailsRow = $(this).closest('tr').next('.order-details-row');
           // detailsRow.slideToggle();
            if (minusIcon.css('display') === 'none') {
                plusIcon.css('display', 'none');
                minusIcon.css('display', 'block');
               
                detailsRow.slideDown();
            } else {
                plusIcon.css('display', 'block');
                minusIcon.css('display', 'none');
                detailsRow.slideUp();
            }
        });
    });
</script>
@endsection
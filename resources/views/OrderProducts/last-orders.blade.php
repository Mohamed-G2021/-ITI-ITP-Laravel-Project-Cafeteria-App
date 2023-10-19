@extends('layouts.app')
@section('content')

@foreach($userOrders as $order)
                    
                 <p>
                   {{ $order->id }} 
                 </p>   
                    
                                    @endforeach


@endsection
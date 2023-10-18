<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
class AdminOrderController extends Controller
{
    
    public function index()
    {
       $orders = Order::orderBy('created_at', 'desc')->paginate(3);
          return view('admin.orders.index', compact('orders'));
    }
    public function filter(Request $request)
{
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $orders = Order::whereBetween('created_at', [$start_date, $end_date])->get();
    return view('admin.orders.index', compact('orders'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(Order $order)
    // {
    //     // return view('admin.orders.show ', ['order'=>$order]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
       $this->middleware('auth')->only(['index','store', 'update', 'destroy']);
    }
    public function index()
    {
         $orders=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(3);
        // $orders=Order::all();
        return view('orders.index',['orders'=>$orders]);
    }
     
    public function filter(Request $request)
{
    $user = auth()->user();
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $orders = Order::where('user_id', $user->id)
    ->whereBetween('created_at', [$start_date, $end_date])
    ->get();
    return view('orders.index', compact('orders'));
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
    public function show(Order $order)
    {
        return view('orders.show', ['order'=>$order]);
    }

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
         $order->delete();
         return to_route('orders.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
class AdminOrderController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->only(['store', 'update', 'destroy','index']);
    }
    
    public function index()
    {
         $user=Auth::user();
        if($user->role =='admin'){
            $orders = Order::orderBy('created_at', 'desc')->paginate(3);
            return view('admin.orders.index', compact('orders'));
        }
      else{
        return abort(403);
      }
    //    dd( $orders->products);
        
    }
    public function filter(Request $request)
{
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    //$orders = Order::whereBetween('created_at', [$start_date, $end_date])->paginate(3);
    $orders= Order::whereDate('created_at', '>=', $start_date)
        ->whereDate('created_at', '<=', $end_date)->paginate(3);
    if ($orders) {
        return view('admin.orders.index', compact('orders'));
    }
        return response('No order found for the given dates', 404);
    
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
        dd($order);
         return view('admin.orders.show', ['order'=>$order]);
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
    public function update(Request $request,  $id)
    {
        
        $order = Order::findOrFail($id);
         $order->status = $request->input('status');
         $order->save();
         return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}

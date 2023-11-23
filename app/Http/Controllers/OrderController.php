<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
      $this->middleware('auth')->only(['index','store', 'update', 'destroy']);
    }
    public function index()
    {
        $orders=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(3);
        return view('admin-dashboard.orders.index',['orders'=>$orders]);
    }
     
public function filter(Request $request)
{
    $user = auth()->user();
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $orders= Order::where('user_id', $user->id)->whereDate('created_at', '>=', $start_date)
                      ->whereDate('created_at', '<=', $end_date)->paginate(3);
    $orders->appends(request()->query());
    if($orders){
        return view('admin-dashboard.orders.index', compact('orders'));
    }
        // $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        // return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        return view('admin-dashboard.orders.create', ['orders' => $orders]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //     // Create a new order
        // $order = new Order();
        // // $order->user_id = auth()->user()->id; // Assuming you have authentication and want to associate the order with the authenticated user

        // // Get the product IDs from the session
        // $productIds = session('order_products', []);
        // // dd($productIds);
        // $amount = [];
        // // Loop through the product IDs and create order products
        // foreach ($productIds as $productId) {
        //     $orderProduct = new OrderProduct();
        //     $orderProduct->order_id = $order->id;
        //     $orderProduct->product_id = $productId;

        //     // $amount->push($orderProduct->products->price);

        //     $orderProduct->quantity = 1; // Set the initial quantity to 1
        //     $orderProduct->save();
        // }
        // // dd($orderProduct->products->price);
        // $order->save();

        // // Clear the order products from the session
        // session()->forget('order_products');
        // $orderProducts = OrderProduct::all();
        // $Products = Product::all();

        // return view('OrderProducts.index',['orderProducts'=>$orderProducts, 'products'=>$Products] );
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Order $order)
    {
        if ($request->ajax()) {
            return view('admin-dashboard.orders.show', ['order' => $order]);
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)

    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)

    {
        $order->delete();
        // return to_route('orders.index');
        return redirect(url('admin/dashboard/orders/' ));

    }
}

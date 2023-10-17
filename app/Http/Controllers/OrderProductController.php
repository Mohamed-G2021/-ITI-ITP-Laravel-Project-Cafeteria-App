<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Order;


class OrderProductController extends Controller
{

    protected $confirm = false;
    /**
     * Display a listing of the resource.
     */
  
    public function index()
    {
        $orderProducts = OrderProduct::all();
        $Products = Product::all();

        return view('OrderProducts.index',['orderProducts'=>$orderProducts, 'products'=>$Products] );
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
    public  function store(Request $request)
    {
        //
     
        $productIds = session('order_products', []);
        // if(empty($productIds))
        {
             $order = new Order();
        $order->status = 'processing';
        $order->amount = 0;
        $order->user_id =1;
        $order->save();
        session(['order_id' => $order->id]);
        }


        $productId = $request->input('productId');       
        $orderId = session('order_id');
        $quantity = 1;


        // $orderProduct = OrderProduct::where('order_id', $orderId)->where('product_id', $productId)->first();
        $orderProduct = OrderProduct::where('product_id', $productId)->first();

        // dd($orderId);
        if($orderProduct){
            $orderProduct->quantity +=1;
            $orderProduct->save();
        }
        else{
            OrderProduct::firstOrCreate([
                'order_id'=>$orderId,
                'product_id'=>$productId,
                'quantity'=>$quantity,
           ]);
        }
        session()->push('order_products', $productId);
        $orderProducts = OrderProduct::all();
        $Products = Product::all();
      
    
        return view('OrderProducts.index',['orderProducts'=>$orderProducts, 'products'=>$Products] );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)

    {
        //
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
    public function update(Request $request, string $id)
    {
        //
        $product=  OrderProduct::findorfail($id);

        if( $request->get("add")){
        $product->quantity = $product->quantity  + 1;

        }
        else{
            $product->quantity = $product->quantity  - 1;

        }
        // $product->update($request->all());
        $product->save();

        $orderProducts = OrderProduct::all();
        $Products = Product::all();

        return to_route('order-products.index', ['orderProducts'=>$orderProducts, 'products'=>$Products] );


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        OrderProduct::findorfail($id)->delete();
        
        $orderProducts = OrderProduct::all();
        $Products = Product::all();
        
        return to_route('order-products.index', ['orderProducts'=>$orderProducts, 'products'=>$Products] );

    }
    public function confirm_order(){
        $orderId = session('order_id');
        OrderProduct::where('order_id', $orderId)->delete();
        session()->forget('order_products');
        return to_route('OrderProducts.index');
    }
}

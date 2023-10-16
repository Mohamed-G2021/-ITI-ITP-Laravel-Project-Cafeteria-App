<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProduct;
use App\Models\Product;


class OrderProductController extends Controller
{

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

        $productId = $request->input('productId');
        $quantity = 1;
        $orderId = 1;

        $orderProduct = OrderProduct::where('order_id', $orderId)->where('product_id', $productId)->first();
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
        // OrderProduct::update($id, $quantity);
        $product->update($request->all());
        $orderProducts = OrderProduct::all();
        $Products = Product::all();

        return to_route('orders.index', ['orderProducts'=>$orderProducts, 'products'=>$Products] );


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
        
        return to_route('orders.index', ['orderProducts'=>$orderProducts, 'products'=>$Products] );

    }
}

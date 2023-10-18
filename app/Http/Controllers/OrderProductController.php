<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Auth;


class OrderProductController extends Controller
{    

    protected $confirm = false;
    protected $amount = 3;
    protected $id ;

    protected function calculate_amount(){
        $amount = 0;
        $orderProducts = OrderProduct::all();

        foreach ($orderProducts as $orderProduct) {
            $amount += ($orderProduct->quantity* (int)$orderProduct->product->price);

      }
      return $amount;
    }
  protected function cust(Request $request){
        $id = (int) $request->get('user');
        session(['user_id' => $id]);

        return to_route('order-products.index',['user_id'=>$id ] );
  }


    /**
     * Display a listing of the resource.
     */
  
    public function index()
    {
        // if($confirm == undefined || $confirm == true )
        {
            $orderProducts = new OrderProduct;
            $confirm = false;

        }
        // else
        {
            // $orderProducts = OrderProduct::all();

        }
        $orderProducts = OrderProduct::all();
        $Products = Product::all();
        $users = User::all();
        $amount  =$this->calculate_amount($orderProducts);
        
        return view('OrderProducts.index',['orderProducts'=>$orderProducts, 'products'=>$Products , 'amount'=>$amount , 'users'=>$users] );
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
     $user_orders ;
        $productIds = session('order_products', []);
        if(empty($productIds))
        {
             $order = new Order();
            $order->status = 'processing';
            $order->amount = $this->calculate_amount();     
            if(Auth::user()->role =="admin" ){
                $order->user_id = session('user_id');

            }
            else{
                $order->user_id =$request->user()->id; 
                $user_orders = $order; 
            }
            $order->save();

        session(['order_id' => $order->id]);
        }


        $productId = $request->input('productId');    
        $notes = $request->input('notes');  
   
        $orderId = session('order_id');
        $quantity = 1;


       $orderProduct = OrderProduct::where('order_id', $orderId)->where('product_id', $productId)->first();
        $x=$orderProduct;
        if($orderProduct){
            $orderProduct->quantity +=1;
            $orderProduct->save();

        }
        else{
          $x =   OrderProduct::firstOrCreate([
                'order_id'=>$orderId,
                'product_id'=>$productId,
                'quantity'=>$quantity,

           ]);   
           $x->save();


        }
   
        session()->push('order_products', $productId);
        $orderProducts = OrderProduct::all();
        $Products = Product::all();
        $amount= $this->calculate_amount() ;
     
        return redirect('order-products' );
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
        $ord_product=  OrderProduct::findorfail($id);

        if( $request->get("add")){
        $ord_product->quantity = $ord_product->quantity  + 1;


        }
        else{
            if($ord_product->quantity > 0){
                $ord_product->quantity = $ord_product->quantity  - 1;

            }


        }
        // $product->update($request->all());
        $ord_product->save();

        $orderProducts = OrderProduct::all();
        $Products = Product::all();
        $amount=$this->calculate_amount();
      return redirect('order-products' );


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
        $amount  =$this->calculate_amount();
      
        return redirect('order-products' );

    }
    public function confirm_order(Request $request){
        $orderId = session('order_id');
        $amount = $this->calculate_amount();
        $order = Order::findorfail($orderId);
      
        $order->update([            
            'amount'=> $this->calculate_amount(),
        ]);        

        $order->notes = $request->get('notes');
        $order->branch_id= (int)$request->get('branch');
        $order->save();
        // OrderProduct::where('order_id', $orderId)->delete();
        session()->forget('order_products');
        $confirm = true;
        return to_route('orders.index');
    }
   
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Order;
use App\Http\Services\FatoorahServices;
use Illuminate\Support\Facades\Redirect;
use App\Models\Transaction;
use Auth;
use App\models\User;



class OrderProductController extends Controller
{
    protected $confirm = false;
    protected $amount = 3;
    protected $id ;
    protected $user_orders = [];


    private $fatoorahServices;

    public function __construct(FatoorahServices $fatoorahServices){
        $this->fatoorahServices=$fatoorahServices;
    }



    protected function calculate_amount(){
        $amount = 0;
        // $orderProducts = OrderProduct::all();
                    // session()->forget('cart');

        if( session()->has('cart')){

            $orderProducts = session('cart');


        foreach ($orderProducts as $orderProduct) {
            $amount += ((int)$orderProduct->quantity* (int)$orderProduct->product->price);

      }}
      else{ $amount=0;}
      return $amount;
    }


  protected function cust(Request $request){
        $id = (int) $request->get('user');
        session(['user_id' => $id]);
        $orderId = session('order_id');
        $user_orders =   Order::where('user_id', $id)->where('order_id', $orderId-1);
        return to_route('order-products.index',['user_id'=>$id, 'user_orders'=>$user_orders ] );
  }

  public function getUserOrders(Request $request)
  {
    //   $user = Auth::user();
    //   $userOrders = Order::where('user_id', $user->id)->get();
    $user = Auth::user();
    // $userOrders = Order::where('user_id', $user->id)->get();
    $orderId = session('order_id');
    $userOrders =   $userOrders = Order::where('user_id', $user->id)->latest()->first();

      dd($userOrders);
      return view('order-products.index', ['userOrders' => $userOrders]);
  }

    public function index()
    {
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
       if( session()->has('cart')){
        $amount  =$this->calculate_amount($orderProducts);

       }
       else{$amount = 0;}
        $user = Auth::user();


        $orderId = session('order_id');
        $userOrders =   $userOrders = Order::where('user_id', $user->id)->latest()->first();
        $cart = session('cart', []);

        // dd($cart);

        return view('OrderProducts.index',

        ['orderProducts'=>$orderProducts, 'products'=>$Products ,
        'amount'=>$amount , 'users'=>$users, 'userOrders'=>$userOrders, 'cart'=>$cart] );
    }


    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public  function store(Request $request)
    {
        //
     $user_orders =null;
        $productIds = session('order_products', []);
        $cart = session('cart', []);
        if(empty($productIds))
        {
             $order = new Order();
            $order->status = 'processing';
            $order->amount = 0;
            if(Auth::user()->role =="admin" ){
                $order->user_id = session('user_id');
                $user_orders = $order;

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
       $item = collect($cart)->where('order_id', $orderId)->where('product_id', $productId)->first();
       $x=$orderProduct;
        if($item){
            $item['quantity'] +=1;
            $orderProduct->quantity +=1;
            $orderProduct->save();
            session(['cart' => $cart]);

            // $cart =$orderProduct;
            // session()->push('cart', $cart);

        }
        else{
          $x =   OrderProduct::firstOrCreate([
                'order_id'=>$orderId,
                'product_id'=>$productId,
                'quantity'=>$quantity,

           ]);
           $x->save();
           $cart = $x ;
           session()->push('cart', $cart);

        }

        session()->push('order_products', $productId);
        // $orderId = session('order_id');
        // $user_orders =   $user_orders::where('user_id', $id)->where('order_id', $orderId-1);

        $orderProducts = OrderProduct::all();
        $Products = Product::all();
        $amount= $this->calculate_amount() ;

        return to_route('order-products.index' ,[ 'cart'=> $cart]);
    }

    public function update(Request $request, string $id)
    {
         $cart = session('cart');
        $ord_product=  OrderProduct::findorfail($id);
        $item = collect($cart)->firstWhere('id', $id);
        if( $request->get("add")){
            $item['quantity'] += 1; // Update the quantity of the item
            $ord_product['quantity'] = $ord_product['quantity']  + 1;

        }
        else{
            if($item['quantity'] > 0){

            $item['quantity'] -= 1; // Update the quantity of the item
            $ord_product['quantity'] = $ord_product['quantity']  - 1;
                        }
        }
            session(['cart' => $cart]);

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
        $cart = session('cart');

        $cart = collect($cart)->filter(function ($item) use ($id) {
            return $item['id'] != $id;
        })->values()->all();
        session(['cart' => $cart]);

        // Delete the item from the database
        OrderProduct::findOrFail($id)->delete();
        // Recalculate the amount
        $amount = $this->calculate_amount();
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
        session()->forget('cart');

        $confirm = true;
        $amount = 0;

        //return to_route('orders.index', $amount);
        //return $order;
        //after select user data from db
        $data=[
            'CustomerName' => $order->user->name,
            'NotificationOption'=>'LNK',
            'InvoiceValue'=>$order->amount,
            'CustomerEmail'=>$order->user->email,
            'CallBackUrl'=>'http://localhost:8000/api/callback',
            'ErrorUrl'=>'http://localhost:8000/api/error',
            'Language'=>'en',
            'DisplayCurrencyIso'=>'SAR'
        ];
        $info= $this->fatoorahServices->sendPayment($data);
        Transaction::create([
            'user_id'=>$order->user_id,
            'invoiceid'=>$info['Data']['InvoiceId']
        ]);
        //return $info;
        return redirect($info['Data']['InvoiceURL']);
        //transaction table  invoiceid , userid
    }
    public function paymentCallBack(Request $request){
        //return $request;
        $data=[];
        $data['Key']=$request->paymentId;
        $data['KeyType']='paymentId';

        $paymentData=$this->fatoorahServices->getPaymentStatus($data);
        $usertrans=Transaction::where('invoiceid',$paymentData['Data']['InvoiceId'])->first();
        $usertrans->update(['paymentid'=>$request->paymentId]);
        //return $paymentData;
        return to_route('order-products.index');
        //search in transaction table for returned invoiceid to get that userid

    }
}




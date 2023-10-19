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


class OrderProductController extends Controller
{

    protected $confirm = false;
    protected $amount = 3;
    private $fatoorahServices;

    public function __construct(FatoorahServices $fatoorahServices){
        $this->fatoorahServices=$fatoorahServices;
    }


    protected function clac_amount(){
        $amount = 0;
        $orderProducts = OrderProduct::all();

        foreach ($orderProducts as $orderProduct) {
            $amount += ($orderProduct->quantity* (int)$orderProduct->product->price);

      }
      return $amount;
    }
    // protected    $amount=0 ;



    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $orderProducts = OrderProduct::all();
        $Products = Product::all();
        $amount  =$this->clac_amount($orderProducts);
        return view('OrderProducts.index',['orderProducts'=>$orderProducts, 'products'=>$Products , 'amount'=>$amount] );
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
        if(empty($productIds))
        {
             $order = new Order();
            $order->status = 'processing';
            $order->amount = 0;
            $order->user_id =1;
            $order->save();

        session(['order_id' => $order->id]);
        }


        $productId = $request->input('productId');
        $notes = $request->input('notes');

        $orderId = session('order_id');
        $quantity = 1;


       $orderProduct = OrderProduct::where('order_id', $orderId)->where('product_id', $productId)->first();
        $x=$orderProduct;
        // dd($orderId);
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

        }

        session()->push('order_products', $productId);
        $orderProducts = OrderProduct::all();
        $Products = Product::all();
        // $this->amount = $order->amount;
        $amount=0 ;
      foreach ($orderProducts as $orderProduct) {
        $amount += ($orderProduct->quantity* (int)$orderProduct->product->price);

      }
        return view('OrderProducts.index',['orderProducts'=>$orderProducts, 'products'=>$Products, 'amount'=>$amount] );
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
            $ord_product->quantity = $ord_product->quantity  - 1;


        }
        // $product->update($request->all());
        $ord_product->save();

        $orderProducts = OrderProduct::all();
        $Products = Product::all();
        $amount=0 ;
        foreach ($orderProducts as $orderProduct) {
            $amount += ($orderProduct->quantity* (int)$orderProduct->product->price);

      }

        return view('OrderProducts.index',['orderProducts'=>$orderProducts, 'products'=>$Products, 'amount'=>$amount] );


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
        $amount  =$this->clac_amount();

        return to_route('order-products.index', ['orderProducts'=>$orderProducts, 'products'=>$Products, 'amount'=>$amount] );

    }
    public function confirm_order(){
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
        return to_route('orders.index', $amount);

        //after select user data from db
        $data=[
            'CustomerName' => 'abdelrahman ahmed',
            'NotificationOption'=>'LNK',
            'InvoiceValue'=>100,
            'CustomerEmail'=>'abd00tarek19@gmail.com',
            'CallBackUrl'=>'http://localhost:8000/api/callback',
            'ErrorUrl'=>'http://localhost:8000/api/error',
            'Language'=>'en',
            'DisplayCurrencyIso'=>'SAR'
        ];
        $info= $this->fatoorahServices->sendPayment($data);
        dd($order->user_id);
        Transaction::create([
            'user_id'=>Auth::user()->id,
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




<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Order;
use App\Models\Branch;
use App\Http\Services\FatoorahServices;
use Illuminate\Support\Facades\Redirect;
use App\Models\Transaction;
use Auth;
use DB;
use App\Models\User;



class OrderProductController extends Controller
{
    protected $confirm = false;
    protected $amount = 3;
    protected $id;
    protected $user_orders = [];


    private $fatoorahServices;

    public function __construct(FatoorahServices $fatoorahServices)
    {
        $this->middleware('auth')->only(['store', 'destroy', 'confirm_order']);
        $this->fatoorahServices = $fatoorahServices;
    }



    protected function calculate_amount()
    {
        $amount = 0;
        // session()->forget('cart');
        if (session()->has('cart')) {
            $orderProducts = session('cart');
            $i = 0;
            foreach ($orderProducts as $orderProduct) {
                $quantity = $orderProduct['quantity'];
                $product = isset($orderProduct['product_id']) ? Product::find($orderProduct['product_id']) : null;

                if ($product) {
                    $amount += ((int)$quantity * (int)$product->price);
                }
            }
        } else {
            $amount = 0;
        }
        return $amount;
    }


    protected function cust(Request $request)
    {
        $id = (int) $request->get('user');
        session(['user_id' => $id]);
        $orderId = session('order_id');
        $user_orders =   Order::where('user_id', $id)->where('order_id', $orderId - 1);
        return to_route('order-products.index', ['user_id' => $id, 'user_orders' => $user_orders]);
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $branches = Branch::all();
        $googleLogin = false;

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $Products = Product::where('name', 'LIKE', "%$keyword%")->paginate(3);
        } else {
            $Products = Product::paginate(3);
        }
        $orderProducts = OrderProduct::all();
        $users = User::all();
        if (session()->has('cart')) {
            $amount  = $this->calculate_amount($orderProducts);
        } else {
            $amount = 0;
        }
        $user = Auth::user();
        if ($user == null) {
            $user = User::get()->where('password', null)->first;
            $userID = $user->id->id;
            $googleLogin = true;
        } else {
            $userID =  $user->id;
        }
        // dd(session('user_id'));
        $orderId = session('order_id');
        $userOrders =   $userOrders = Order::where('user_id', $userID)->where('amount', '>', 0)->latest()->first();
        $cart = session('cart', []);

        return view(
            'OrderProducts.index',

            [
                'orderProducts' => $orderProducts, 'products' => $Products, 'googleLogin' => $googleLogin,
                'amount' => $amount, 'users' => $users, 'userOrders' => $userOrders, 'cart' => $cart, 'branches' => $branches,
            ]
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public  function store(Request $request)
    {

        $user_orders = null;
        $productIds = session('order_products', []);
        $cart = session('cart', []);
        if (empty($productIds)) {
            $order = new Order();
            $order->status = 'processing';
            $order->amount = 0;
            if (Auth::user()->role == "admin") {
                $order->user_id = session('user_id');
                $user_orders = $order;
            } else {
                $order->user_id = $request->user()->id;
                $user_orders = $order;
            }
            $order->save();

            session(['order_id' => $order->id]);
        }

        $productId = $request->input('productId');
        $notes = $request->input('notes');

        $orderId = session('order_id');
        $quantity = 1;
        $item = collect($cart)->where('order_id', $orderId)->where('product_id', $productId)->first();
        if ($item) {
            $item['quantity'] += 1;
            session(['cart' => $cart]);
        } else {
            $cart =   OrderProduct::firstOrCreate([
                'order_id' => $orderId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
            OrderProduct::where('order_id', $orderId)->delete();
            session()->push('cart', $cart);
        }

        session()->push('order_products', $productId);
        $orderProducts = OrderProduct::all();
        $Products = Product::all();
        $amount = $this->calculate_amount();
        return to_route('order-products.index', ['cart' => $cart]);
    }
    public function show($id)
    {

        $product = Product::findOrFail($id);
        dd($product);
        return view('product.show', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $cart = session('cart');
        $item = collect($cart)->firstWhere('id', $id);
        if ($request->get("add")) {
            $item['quantity'] += 1;
        } else {
            if ($item['quantity'] > 0) {
                $item['quantity'] -= 1;
            }
        }
        session(['cart' => $cart]);
        $orderProducts = OrderProduct::all();
        $Products = Product::all();
        $amount = $this->calculate_amount();
        return redirect('order-products');
    }

    public function destroy(string $id)
    {
        $cart = session('cart');

        $cart = collect($cart)->filter(function ($item) use ($id) {
            return $item['id'] != $id;
        })->values()->all();
        session(['cart' => $cart]);
        $amount = $this->calculate_amount();
        return redirect('order-products');
    }

    public function confirm_order(Request $request)
    {

        $orderId = session('order_id');
        $amount = $this->calculate_amount();
        $order = Order::findorfail($orderId);

        $order->update([
            'amount' => $this->calculate_amount(),
        ]);

        $cart = session('cart', []);
        foreach ($cart as $item) {
            $productId = $item['product_id'];
            $quantity = $item['quantity'];
            $orderProduct = new OrderProduct();
            $orderProduct->id = (int)(DB::table('order_products')->max('id')) + 1;

            $orderProduct->order_id = $orderId;
            $orderProduct->product_id = $productId;
            $orderProduct->quantity = $quantity;
            $orderProduct->save();
        }
        $order->notes = $request->get('notes');
        $order->branch_id = (int)$request->get('branch');
        $order->save();

        session()->forget('order_products');
        session()->forget('cart');

        $confirm = true;
        $amount = 0;

        $data = [
            'CustomerName' => $order->user->name,
            'NotificationOption' => 'LNK',
            'InvoiceValue' => $order->amount,
            'CustomerEmail' => $order->user->email,
            'CallBackUrl' => 'http://localhost:8000/api/callback',
            'ErrorUrl' => 'http://localhost:8000/api/error',
            'Language' => 'en',
            'DisplayCurrencyIso' => 'SAR'
        ];
        $info = $this->fatoorahServices->sendPayment($data);
        Transaction::create([
            'user_id' => $order->user_id,
            'invoiceid' => $info['Data']['InvoiceId']
        ]);

        return redirect($info['Data']['InvoiceURL']);
    }
    public function paymentCallBack(Request $request)
    {
        $order = Order::latest()->first();
        $orderProducts = DB::table('order_products')->where('order_id', $order->id)->get();
        $products = [];
        $quantity = [];

        foreach ($orderProducts as $orderProduct) {
            array_push($products, DB::table('products')->where('id', $orderProduct->product_id)->first());
            array_push($quantity, $orderProduct->quantity);
        }
        // foreach ($orderProducts as $orderProduct) {
        //     $products['name'] = DB::table('products')->where('id', $orderProduct->product_id)->select('name')->first();
        //     $products['price'] = DB::table('products')->where('id', $orderProduct->product_id)->select('price')->first();
        //     $products['quantity'] = DB::table('order_products')->where('id', $orderProduct->product_id)->select('quantity')->first();
        // }
        $data = [];
        $data['Key'] = $request->paymentId;
        $data['KeyType'] = 'paymentId';

        $paymentData = $this->fatoorahServices->getPaymentStatus($data);
        $usertrans = Transaction::where('invoiceid', $paymentData['Data']['InvoiceId'])->first();
        $usertrans->update(['paymentid' => $request->paymentId]);

        return view(
            'payment.succeed',
            [
                'order' => $order,
                'orderProducts' => $orderProducts,
                'products' => $products,
                'quantity' => $quantity
            ]
        );
    }
}

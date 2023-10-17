if ( ! function_exists('clac_amount'))
{

   
    function clac_amount(){
        $amount = 0;
        $orderProducts = OrderProduct::all();

        foreach ($orderProducts as $orderProduct) {
            $amount += ($orderProduct->quantity* (int)$orderProduct->product->price);

      }
      return $amount;
    }
}
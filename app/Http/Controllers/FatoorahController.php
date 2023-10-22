<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\FatoorahServices;

class FatoorahController extends Controller
{
    private $fatoorahServices;

    public function __construct(FatoorahServices $fatoorahServices){
        $this->fatoorahServices=$fatoorahServices;
    }

    public function payOrder(){
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
        return $this->fatoorahServices->sendPayment($data);

        //transaction table  invoiceid , userid
    }

    public function paymentCallBack(Request $request){
        //return $request;
        $data=[];
        $data['Key']=$request->paymentId;
        $data['KeyType']='paymentId';

        $paymentData=$this->fatoorahServices->getPaymentStatus($data);
        return $paymentData;
        //$paymentData['Data']['InvoiceId'];
        //search in transaction table for returned invoiceid to get that userid
    }

}

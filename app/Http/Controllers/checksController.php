<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class checksController extends Controller
{
   public function index(){
    return view("checks");
   }
}

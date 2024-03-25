<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
      public function index(){
        $orders = Order::where('user_id',auth()->user()->id)->orderBy("created_at","desc")->paginate(10);
        return view("frontend.collections.orders.index",compact("orders"));
      }
      public function show($order_id){
      $order = Order::where("user_id",auth()->user()->id)->where("id",$order_id)->first();
      if($order){
        return view("frontend.collections.orders.show",compact("order"));
      }else{
       return redirect("")->back()->with("status","Order Unavailable!");
      }
      }
}

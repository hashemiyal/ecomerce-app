<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
  public function index(Request $request)
  {
    $toddayDate = Carbon::now()->format('Y-m-d');

    $orders = Order::when($request->date != null, function ($q) use ($request) {
      return $q->whereDate("created_at", $request->date);
    }, function ($q) use ($toddayDate) {
      return $q->whereDate('created_at', $toddayDate);
    })
      ->when($request->status != null, function ($q) use ($request) {
        return $q->where('status_msg', $request->status);
      })->paginate(10);
    return view("admin.orders.index", compact("orders"));
  }
  public function show($order_id)
  {
    $order = Order::where("id", $order_id)->first();
    if ($order) {
      return view("admin.orders.show", compact("order"));
    } else {
      return redirect("")->back()->with("status", "Order Unavailable!");
    }

  }
}
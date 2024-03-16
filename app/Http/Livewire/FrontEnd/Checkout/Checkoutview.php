<?php

namespace App\Http\Livewire\FrontEnd\Checkout;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class Checkoutview extends Component
{
    public $total_price = 0, $fullname, $phone, $email, $pincode, $address,$payment_mode=null,$payment_id=null;
    public function render()
    {
        $this->total_price = $this->getTotalPrice();
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        return view('livewire.front-end.checkout.checkoutview', ['totla_price' => $this->total_price]);
    }
    public function getTotalPrice()
    {
        $total = 0;
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $total += $cart->quantity * $cart->product->selling_price;
        }
        return $total;
    }
    public function rules()
    {
        return [
            'fullname' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:11|min:10',
            'pincode' => 'required|integer',
        ];

    }
    public function codOrder()
    {
        $this->payment_mode='cas on delivery';
        if($this->placeOrder()){
            $this->dispatchBrowserEvent('message', ['text' => 'Order added!']);
            Cart::where('user_id', auth()->user()->id)->delete();
            $this->emit('cartchanged');
            return redirect('collections');
        }else{
            $this->dispatchBrowserEvent('message', ['text' => 'Something Went Wrong']);
        }



    }
    public function placeOrder(){
        $this->validate();
        $order = Order::create([
              'user_id'=> auth()->user()->id,
              'tracking_no'=> 'tr_no-'.Str::random(10),
              'fullname'=> $this->fullname,
              'email'=> $this->email,
              'pincode'=> $this->pincode,
              'address'=> $this->address,
              'phone'=> $this->phone,
              'status_msg'=>'In Progress',
              'payment_mode'=> $this->payment_mode,
              'payment_id'=> $this->payment_id,
              
        ]);
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
           $orderItem = OrderItem::create([
              'order_id'=> $order->id,
              'product_id'=> $cart->product_id,
              'product_color_id'=>null,
              'quantity'=> $cart->quantity,
              'price'=> $cart->product->selling_price,
           ]);
           $cart->product()->where('id', $cart->product_id)->decrement('quantity', $cart->quantity);
        }
        return $order;

    }
}

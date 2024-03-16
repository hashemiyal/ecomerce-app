<?php

namespace App\Http\Livewire\FrontEnd\Cart;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class Cartview extends Component
{
    public $cartquantity,$total_price=0;

    public function render()
    {
        $carts = Cart::where("user_id", auth()->user()->id)->get();
        return view('livewire.front-end.cart.cartview', ['carts' => $carts,'total_price'=>$this->total_price]);
    }
    public function increment($cart_id)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('id', $cart_id);
        if ($cart) {
            $cart->increment('quantity');
        } else {
            $this->dispatchBrowserEvent('message', ['text' => 'Item Not Found!']);
        }


    }
    public function decrement($cart_id)
    {

        $cart = Cart::where('user_id', auth()->user()->id)->where('id', $cart_id);
        if ($cart) {
            $cart->decrement('quantity');
        } else {
            $this->dispatchBrowserEvent('message', ['text' => 'Item Not Found!']);
        }

    }
    public function removecart($cart_id)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('id', $cart_id);
        if ($cart) {
            $cart->delete();
            $this->emit('cartchanged');
        } else {
            $this->dispatchBrowserEvent('message', ['text' => 'Item Not Found!']);
        }
    }
}

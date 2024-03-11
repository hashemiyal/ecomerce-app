<?php

namespace App\Http\Livewire\FrontEnd\Cart;

use Livewire\Component;
use App\Models\Cart;
class Cartview extends Component
{
    public function render()
    {   $carts=Cart::where("user_id", auth()->user()->id)->get();
        return view('livewire.front-end.cart.cartview',['carts'=>$carts]);
    }
}

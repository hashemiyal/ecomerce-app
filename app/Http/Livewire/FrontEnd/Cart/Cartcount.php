<?php

namespace App\Http\Livewire\FrontEnd\Cart;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class Cartcount extends Component
{
    public $cartCount;
    protected $listeners = ['cartchanged' => 'CartCount'];
    public function CartCount()
    {
        if (Auth::check()) {
            $this->cartCount = Cart::where('user_id', Auth::user()->id)->count();
        } else {
            $this->cartCount = 0;
        }
    }
    public function render()
    {
        $this->CartCount();
        return view('livewire.front-end.cart.cartcount', ['cartcount' => $this->cartCount]);
    }

}

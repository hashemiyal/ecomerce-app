<?php

namespace App\Http\Livewire\FrontEnd\Products;

use App\Models\Wishlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $product, $quantityval = 1;
    public function render()
    {
        return view('livewire.front-end.products.view', ['product' => $this->product]);
    }
    public function mount($product)
    {
        $this->product = $product;
    }
    public function addtowish($product_id)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product_id)->first()) {
                // session()->flash('message', 'Aleardy added to your wishlist!');
                $this->dispatchBrowserEvent('message', ['text' => 'Already added to your wishlist!']);
                return false;
            } else {
                Wishlist::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $product_id
                ]);
                //  session()->flash('message', 'Product added to your wishlist!.');  
                $this->dispatchBrowserEvent('message', ['text' => 'Product added to your wishlist!']);
            }

        } else {
            //    session()->flash('message', 'Please Loging First!');
            $this->dispatchBrowserEvent('message', ['text' => 'Please Login First!']);
            return false;
        }

    }
    public function increment()
    {
        if ($this->quantityval < 10) {
            $this->quantityval++;
        }

    }
    public function decrement()
    {
        if ($this->quantityval > 0) {
            $this->quantityval--;
        }
    }

}

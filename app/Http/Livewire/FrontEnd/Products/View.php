<?php

namespace App\Http\Livewire\FrontEnd\Products;

use App\Models\Wishlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

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
    public function addtocart($product_id)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $product_id)->where('status', 0)->exists()) {
                if (Cart::where("user_id", auth()->user()->id)->where("product_id", $product_id)->first()) {
                    $this->dispatchBrowserEvent('message', ['text' => 'Product already added to cart!']);
                } else {
                    if ($this->product->quantity > 0) {
                        if ($this->product->quantity > $this->quantityval) {
                            Cart::create([
                                'user_id' => Auth::user()->id,
                                'product_id' => $product_id,
                                'quantity' => $this->quantityval
                            ]);
                            $this->emit('cartchanged');
                            $this->dispatchBrowserEvent('message', ['text' => 'Product added to cart!']);
                        } else {
                            $this->dispatchBrowserEvent('message', ['text' => 'only  ' . $this->product->quantity . ' of it  is available!']);
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', ['text' => 'out of stock']);
                    }

                }
            } else {
                $this->dispatchBrowserEvent('message', ['text' => 'Product is not available!']);
            }
        } else {
            $this->dispatchBrowserEvent('message', ['text' => 'Please Login First!']);
        }
    }

}

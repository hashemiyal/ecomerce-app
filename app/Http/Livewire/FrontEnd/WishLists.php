<?php

namespace App\Http\Livewire\FrontEnd;
use App\Models\Wishlist;
use Livewire\Component;


class WishLists extends Component
{
    public function render()
    {   $wishlists=WishList::where("user_id",auth()->user()->id)->get();
        return view('livewire.front-end.wish-lists',['wishlists'=>$wishlists]);
    }
    
  public function removewishlist($wishlist_id){
    WishList::where('user_id',auth()->user()->id)->where('id', $wishlist_id)->delete();
    session()->flash('success','Selected Item removed!');
  } 
}

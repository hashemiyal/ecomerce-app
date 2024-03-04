<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class Index extends Component
{   public $product_id;
    public function render()
    {   $products=Product::all();
        return view('livewire.admin.product.index', ['products'=>$products]);
    }
    public function delete($product_id){
    $this->product_id=$product_id;
    }
    public function destroyproduct(){
    $deleteableproduct=Product::find($this->product_id);
    if($deleteableproduct->productImages()){
      foreach($deleteableproduct->productImages as $image){
        if(File::exists($image->image)){
          File::delete($image->image);
        }
      }
       
    }
    $deleteableproduct->delete();
    return redirect()->back()->with('status ','product delete suucessfuly');
    }
}

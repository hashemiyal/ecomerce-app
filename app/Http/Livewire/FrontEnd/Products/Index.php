<?php

namespace App\Http\Livewire\FrontEnd\Products;

use Livewire\Component;
use App\Models\Product;

class Index extends Component
{   public $category,$products,$brandinput=[],$priceinput;
    protected $queryString = ['brandinput','priceinput'];
    public function render()
    {   
        $this->products=Product::where("category_id", $this->category->id)->when($this->brandinput, function ($query) {
        $query->whereIn("brand", $this->brandinput);
        })->when($this->priceinput, function ($query) {
           $query->when($this->priceinput=='high-to-low',function($query){
           $query->orderBy('selling_price','Desc');
           })->when($this->priceinput=='low-to-high',function($query){
            $query->orderBy('selling_price','asc');
          });
        })
        ->where("status",0)->get();
        return view('livewire.front-end.products.index',['products'=>$this->products,'category'=>$this->category]);
    }
    public function mount($category){
    $this->category=$category;
    }
}

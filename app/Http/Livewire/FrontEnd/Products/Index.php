<?php

namespace App\Http\Livewire\FrontEnd\Products;

use Livewire\Component;

class Index extends Component
{   public $products,$category;
    public function render()
    {
        return view('livewire.front-end.products.index',['products'=>$this->products,'category'=>$this->category]);
    }
    public function mount($products,$category){
    $this->products=$products;
    $this->category=$category;
    }
}

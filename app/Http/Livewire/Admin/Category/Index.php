<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category_id;
    public function render()
    {   $categories=Category::orderby("id","desc")->paginate(10);
        return view('livewire.admin.category.index',['categories'=>$categories]);
    }
    public function deletecategory($category_id){
    $this->category_id=$category_id;
    }
    public function destroycategory(){
     $deleteablecategory=Category::find($this->category_id);
     $deleteablecategory->delete();
     if(File::exists('uploads/category/'. $deleteablecategory->image)){
        File::delete('uploads/category/'. $deleteablecategory->image);
    }
      return session()->flash('status','selected category deleted!');
     
    }
}

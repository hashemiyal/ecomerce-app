<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;


class Index extends Component
{   public $name,$slug,$status,$brand_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {   $brands =Brand::orderby("id","desc")->paginate(10);
        return view('livewire.admin.brand.index',['brands'=>$brands]);
    }
    public function rules(){
        return [
            'name'=> 'required|string',
            'slug'=> 'required|string',
            'status'=> 'nullable'
        ];
    }
    public function createbrand(){
      $validedbrand=$this->validate();
      Brand::create([
        'name'=> $this->name,
        'slug'=>Str::slug($this->slug),
        'status'=> $this->status==true? '1':'0',
      ]);
      session()->flash('status','New brand succesfully created');
    }
    public function editebrand($brand_id){
      $this->brand_id=$brand_id;
      $updateableband=Brand::find($brand_id);
      $this->name=$updateableband->name;
      $this->slug=$updateableband->slug;
      $this->status=$updateableband->status;
    }
    public function updatebrand(){
      $validedbrand=$this->validate();
      Brand::findOrFail($this->brand_id)->update([
        'name'=> $this->name,
        'slug'=>Str::slug($this->slug),
        'status'=> $this->status==true? '1':'0',
      ]);
      session()->flash('status','Brand Updated succesfully');
    }
    public function deletebrand($brand_id){
     $this->brand_id=$brand_id;
    }
    public function destroybrand(){
    Brand::find($this->brand_id)->delete();
    session()->flash('status','Brand Deleted succesfully');
    }
}

<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
  public function index(){
    
    $sliders=Slider::where("status",0)->get();
    return view("frontend.index",compact("sliders"));
  }
  public function categories(){
     $categories=Category::where("status",0)->get();
     return  view("frontend.collections.category.index",compact("categories"));
  }

  public function products($category_slug){
    $category=Category::where("slug", $category_slug)->first();
    $products=$category->products()->get();
    return  view("frontend.collections.products.index",compact("products","category"));
 }
}

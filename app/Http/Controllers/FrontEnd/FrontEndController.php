<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
  public function index()
  {

    $sliders = Slider::where("status", 0)->get();
    return view("frontend.index", compact("sliders"));
  }
  public function categories()
  {
    $categories = Category::where("status", 0)->get();
    return view("frontend.collections.category.index", compact("categories"));
  }

  public function products($category_slug)
  {
    $category = Category::where("slug", $category_slug)->first();
    return view("frontend.collections.products.index", compact("category"));
  }

  public function productView($category_slug, $product_slug)
  {
    $category = Category::where("slug", $category_slug)->first();
    if ($category) {
      $product = $category->products()->where("slug", $product_slug)->where('status', '0')->first();
      return view('frontend.collections.products.view', compact('product'));
    } else {
      return redirect()->back();
    }

  }
}

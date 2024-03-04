<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{   public $product_id;
    public function create(){
    $brands = Brand::all();
    $colors=Color::where('status','0')->get();
    $categories = Category::all();
    return view ("admin.product.create",compact("brands","categories","colors"));
    }
    public function index(){
        $products=Product::all();
        
        return view ("admin.product.index",compact("products"));
    }
    public function store(ProductFormRequest $request){
    $validateddata = $request->validated();
    $product=Category::findOrFail($validateddata['category_id'])->products()->create([ 
    "category_id"=>$validateddata['category_id'],
     "name"=> $validateddata['name'],
     "slug"=>Str::slug($validateddata['slug']),
     "description"=> $validateddata['description'],
     "original_price"=>$validateddata['original_price'],
    "selling_price"=> $validateddata['selling_price'],
    "brand"=> $validateddata['brand'],
    "small_description"=>$validateddata['small_description'],
    "quantity"=> $validateddata['quantity'],
    "trending"=> $request->trending== true?'1':'0',
    'status'=> $request->status== true?'1':'0',
    'meta_title'=>$validateddata['meta_title'],
    'meta_keyword'=> $validateddata['meta_keyword'],
    'meta_description'=> $validateddata['meta_description'],
    ]);
    if($request->hasFile('image')){
     $path="uploads/products/";
     $i=0;
     foreach ($request->file("image") as $eachimage){
      $ext=$eachimage->getClientOriginalExtension();
      $filename=time().$i++.".".$ext;
      $eachimage->move($path,$filename);
      $fullpath=$path.$filename;
      $product->productImages()->create([
        'product_id'=>$product->id,
        'image'=> $fullpath
      ]);
     }
    }
    if($request['colors']){
     foreach ($request['colors'] as $key=>$color){
      $product->productColors()->create([
         'product_id'=>$product->id,
         'color_id'=>$color,
         'quantity'=>$request->colorquantity[$key] ?? 0,
      ]);
     }
   
    }
    return redirect('admin/product')->with('status','Product added succesfully');

    }
    public function edite($product_id){
      $product = Product::find($product_id);
      $categories=Category::all();
      $brands=Brand::all();
      $product_colors=$product->productColors->pluck('color_id')->toArray();
      $colors=Color::whereNotIn('id',$product_colors)->get();
      return view('admin.product.edit',compact('product','categories','brands','colors'));
    }
    public function destroy($product_id){
      $productimage=ProductImage::find($product_id);
      if(File::exists($productimage->image)){
        File::delete($productimage->image);
       }
      $productimage->delete();
      return redirect()->back()->with('status','image removed.');
    }
    public function update(ProductFormRequest $request, $product_id){
      $validateddata = $request->validated();
      $product = Category::findOrFail($validateddata['category_id'])->products()->where('id',$product_id)->first();
      
      if($product){

        $product->update([ 
          "category_id"=>$validateddata['category_id'],
           "name"=> $validateddata['name'],
           "slug"=>Str::slug($validateddata['slug']),
           "brand"=> $validateddata['brand'],
           "small_description"=>$validateddata['small_description'],
           "description"=> $validateddata['description'],
           "original_price"=>$validateddata['original_price'],
          "selling_price"=> $validateddata['selling_price'],
          "quantity"=> $validateddata['quantity'],
          "trending"=> $request->trending== true?'1':'0',
          'status'=> $request->status== true?'1':'0',
          'meta_title'=>$validateddata['meta_title'],
          'meta_keyword'=> $validateddata['meta_keyword'],
          'meta_description'=> $validateddata['meta_description'],
          ]);
          if($request->hasFile('image')){
           $path="uploads/products/";
           $i=0;
           foreach ($request->file("image") as $eachimage){
            $ext=$eachimage->getClientOriginalExtension();
            $filename=time().$i++.".".$ext;
            $eachimage->move($path,$filename);
            $fullpath=$path.$filename;
            $product->productImages()->create([
              'product_id'=>$product->id,
              'image'=> $fullpath
            ]);
           }
          }
          if($request['colors']){
            foreach ($request['colors'] as $key=>$color){
             $product->productColors()->create([
                'product_id'=>$product->id,
                'color_id'=>$color,
                'quantity'=>$request->colorquantity[$key] ?? 0,
             ]);
            }
          
           }

          return redirect('admin/product')->with('status','Product updated succesfuly!');
        }
          
          else{
           return redirect('admin/product')->with('status','no such product with  this category found Please select a another category!');
          
      }
      
    }
    public function updateproductcolor(Request $request,$productcolor_id){
      $productcolor=Product::find($request->product_id)->productColors()->where('id',$productcolor_id)->first();
      $productcolor->update([
        'quantity'=>$request->quantity
      ]);
      return response()->json(['message','Product color updated!']);
    }
    public function deleteproductcolor($productcolor_id){
      $productcolor=ProductColor::find($productcolor_id);
      $productcolor->delete();
      return response()->json(['message','Product Color Deleted!']);
    }
}

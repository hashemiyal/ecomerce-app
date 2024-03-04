<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class CategoryController extends Controller
{
   public function index(){
    return view("admin.category.index");
   }
   public function create(){
      return view("admin.category.create");
   }
   public function store(CategoryFormRequest $request){
      $validateddata = $request->validated();
      $category = new Category;
      $category->name = $validateddata["name"];
      $category->slug = $validateddata["slug"];
      $category->description = $validateddata["description"];
      $category->meta_title = $validateddata["meta_title"];
      $category->meta_keyword = $validateddata["meta_keyword"];
      $category->meta_description = $validateddata["meta_description"];
      if($request->hasFile('image')){
         $ext=$request->file('image')->getClientOriginalExtension();
         $filename=time().'.'.$ext;
         $image= $request->file('image');
         $image->move('uploads/category', $filename);
         $category->image='uploads/category/'.$filename;
      };
      $category->status = $request["status"]== true ? '1':'0';
      $category->save();
      return redirect('admin/category')->with('status','category successfuly added');
   }
   public function edite(Category $category){
    return view('admin/category/edite',compact('category'));
   }
   public function update(CategoryFormRequest $request,$category){
      $updateablecategory=Category::findOrFail($category);
      $validateddata = $request->validated();
      $updateablecategory->name =$validateddata["name"];
      $updateablecategory->slug = $validateddata["slug"];
      $updateablecategory->description = $validateddata["description"];
      $updateablecategory->meta_title = $validateddata["meta_title"];
      $updateablecategory->meta_keyword = $validateddata["meta_keyword"];
      $updateablecategory->meta_description = $validateddata["meta_description"];
      if(File::exists('uploads/category/'. $updateablecategory->image)){
         File::delete('uploads/category/'. $updateablecategory->image);
      };
      if($request->hasFile('image')){
         $ext=$request->file('image')->getClientOriginalExtension();
         $filename=time().'.'.$ext;
         $image= $request->file('image');
         $image->move('uploads/category', $filename);
         $updateablecategory->image='uploads/category/'.$filename;
      };
      $updateablecategory->status = $request["status"]== true ? '1':'0';
      $updateablecategory->update();
      return redirect('admin/category')->with('success','category successfuly updated');

}
}

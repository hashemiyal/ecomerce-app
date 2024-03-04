<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
public function index(){
   $colors = Color::all();
    return view("admin.color.index",compact("colors"));
   }
   public function create(){
    return view("admin.color.create");
   }
   public function store(ColorFormRequest $request){
    $validatedcolor=$request->validated();
    Color::create([
        "name"=> $validatedcolor["name"],
        "code"=> $validatedcolor["code"],
        "status"=> $request['status']==true?'1':'0',
    ]);
    
   return redirect('admin/color')->with('status','color has been added!');
   }
   public function edite(Color $color){
    return view('admin.color.edite',compact('color'));
   }
   public function update(ColorFormRequest $request,$color_id){
    $color=Color::find($color_id);
    $validatedcolor=$request->validated();
    $color->name=$validatedcolor['name'];
    $color->code=$validatedcolor['code'];
    $color->status=$request['status']==true?'1':'0';
    $color->save();
    return redirect('admin/color')->with('status','color has been updated!!');
   }
   public function delete($color_id){
   $color=Color::find($color_id);
   $color->delete();
   return redirect('admin/color')->with('status','Selected color successfully deleted!');
   }
}

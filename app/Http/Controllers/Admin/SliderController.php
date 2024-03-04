<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    //

    public function index(){
        $sliders = Slider::all();
        return view("admin.slider.index",compact("sliders"));
    }
    public function create(){
     return view("admin.slider.create");
    }
    public function store(SliderFormRequest $request){
        $validedslider=$request->validated();
        
        if($request->hasFile('image')){
         $image = $request->file('image');
         $filename=time().'.'.$image->getClientOriginalExtension();
         $image->move(public_path('uploads/sliders'), $filename);
         $validedslider['image']='uploads/sliders/'.$filename;
        }
        Slider::create([
            'title'=> $validedslider['title'],
            'description'=> $validedslider['description'],
            'image'=>$validedslider['image']??null,
            'status'=> $request->status==true?'1':'0',
        ]);
        return redirect('admin/slider')->with('status','yes the slider added!');

    }
    public function edite(Slider $slider){
      return view('admin.slider.edite',compact('slider'));
    }
    public function update(SliderFormRequest $request,Slider $slider){
       $validedslider=$request->validated();
       if($request->hasFile('image')){
        $image = $request->file('image');
        $filename=time().'.'.$image->getClientOriginalExtension();
        $image->move("uploads/sliders/",$filename);
        if(File::exists($slider->image)){
            File::delete($slider->image);
        }
        $validedslider['image']='uploads/sliders/'.$filename;
       }
       Slider::where('id', $slider->id)->update([
        'title'=> $validedslider['title'],
        'description'=> $validedslider['description'],
        'image'=> $validedslider['image']??$slider['image'],
        'status'=> $request->status==true?'1':'0',
       ]);
     
       return redirect("admin/slider")->with("status","Slider Changed Successfully!");
    }
    public function delete(Slider $slider){
        $slider->delete();
        if(File::exists($slider->image)){
         File::delete($slider->image);
        }
        return redirect("admin/slider")->with("status","Selected Slider Deleted Successfully!");
    }

}

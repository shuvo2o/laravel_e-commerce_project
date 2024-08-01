<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function Index() {
        $sliders = Slider::latest()->get();
        return Inertia::render('Admin/Slider/Index',['sliders'=>$sliders]);
    }

    public function SliderCreate(){
        return Inertia::render('Admin/Slider/Create');
    }

    public function SliderStore(Request $request){

        $validator = Validator::make($request->all(),[
            'slider_name' =>['required','min:3'],
            'slider_description' =>['required','min:5'],
            'image' =>['nullable','image'],
        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move('slider_images', $uniqueName);
            
            Slider::create([
               'slider_name' => $request->slider_name,
               'slider_description' => $request->slider_description,
               
               'image' => 'slider_images/' .$uniqueName
           ]);
   
            return Redirect::route('admin.slider')->with('message', 'Slider created successfully.');
         }
        
    }

    public function SliderEdit(Slider $slider){
        return Inertia::render('Admin/Slider/Edit',['slider'=>$slider]);
    }

    public function SliderUpdate(Request $request, Slider $slider){
        $imagePath = $slider->image;
        if($request->hasFile('image')){
            if($slider->image && file_exists(public_path($slider->image))){
                unlink(public_path($slider->image));
            }
            $image = $request->file('image');
            $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move('slider_images', $uniqueName);
            $imagePath ='slider_images/' .$uniqueName;
          }
    
    $slider->update([
       'slider_name' => $request->slider_name,
        'slider_description' => $request->slider_description,
        'image' => $imagePath
    ]);
    
    return Redirect::route('admin.slider')->with('message','Slider Update Successfully.');
}

    public function SliderDelete(Slider $slider){

            $image = $slider->image;
            if(File::exists($image)){
                File::delete($image);
            }
            $slider->delete();
            return Redirect::route('admin.slider')->with('message','Slider Delete Successfully.');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // For redirecting the login page if the user is not logedin
    }
    
    // Getting all sliders
    public function HomeSlider(){
        $sliders = Slider::orderBy('id', 'desc')->paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'sliders'
         ); // Taking all data (with paginate() OR with get()) from the db table and assigning it into $sliders; ordering it by id in desc
        return view('admin.slider.index', compact('sliders'));
    }


    // Adding slider
    public function AddSlider(){
        return view('admin.slider.create');
    }


    // Store slider
    public function StoreSlider(Request $request){
        $validated = $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,webp',
            ],
        );

        $slider_image = $request->file('image'); // passing the uploaded image into a variable $image

        // If you have Intervention Image Library
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('image/slider/'.$name_gen);
        $last_img = 'image/slider/'.$name_gen;
        /*********************************/

        // Eloquent ORM
        Slider::insert([ // "Slider::" is the name of the model in app/Models/Slider.php
            'title' => $request->title, // DB field => input field name from html form
            'description' => $request->description,            
            'image' => $last_img,            
            'created_at' => Carbon::now()
        ]);

        // Using Toastr cdn for notification
        $notification = array(
            'message' => 'Slider added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.slider')->with($notification); // redirect to previous page with message displaying for success
    }


    // Delete method
    public function Delete($id){
        $slider_image = Slider::find($id)->image;
        unlink($slider_image);

        $delete = Slider::find($id)->delete();

        // Using Toastr cdn for notification
        $notification = array(
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }


    // Edit method
    public function Edit($id){
        // Eloquent ORM
        $sliders = Slider::find($id); //finding the exact slider with this id

        return view('admin.slider.edit', compact('sliders')); // Passing the specific id to the edit page
    }


    // Update method
    public function Update(Request $request, $id){
        $old_image = $request->old_image;

        $slider_image = $request->file('image'); // passing the uploaded image into a variable $brand_image
        
        // If there is a new uploaded image
        if($slider_image && !empty($slider_image)){

            // If you have Intervention Image Library
            $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
            Image::make($slider_image)->resize(1920, 1088)->save('image/slider/'.$name_gen);
            $last_img = 'image/slider/'.$name_gen;
            /*********************************/            

            unlink($old_image);
            
            // Eloquent ORM
            Slider::find($id)->update([ // "Slider::" is the name of the model in app/Models/Slider.php
                'title' => $request->title, // DB field => input field name from html form
                'description' => $request->description,            
                'image' => $last_img,            
                'updated_at' => Carbon::now()
            ]);

        } else { // If there is NOT new uploaded image

             // Eloquent ORM
             Slider::find($id)->update([ // "Slider::" is the name of the model in app/Models/Slider.php
                'title' => $request->title, // DB field => input field name from html form
                'description' => $request->description,            
                'updated_at' => Carbon::now()
            ]);

        }
    
            $notification = array(
                'message' => 'Slider updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.all.slider')->with($notification); // redirect to home/slider page with message displaying for success
    
        }
}

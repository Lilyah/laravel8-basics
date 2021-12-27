<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multipic;
use Auth;
use Illuminate\Support\Carbon;
use Image;

class MultipicController extends Controller
{
    // Lilyah: I have removed the constructor because I don't need it for every method in this class.
    // Instead of this I place it in web.php
    // public function __construct()
    // {
    //     $this->middleware('auth'); // For redirecting the login page if the user is not logedin
    // }

    // Multi images All
    public function Multipic(){
        $images = Multipic::orderBy('id', 'desc')->paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'images'
         ); // Taking all data (with paginate() OR with get() OR with all()) from the db table and assigning it into $images; ordering it by id in desc  ; getting all data from Multipic model

        return view('admin.multipic.index', compact('images')); // passing $images with compact to the index page
    }


    // Add multi images
    public function AddImg(Request $request){
        $validated = $request->validate([
            'image' => 'required',
            ]
        );

        $image = $request->file('image'); // passing the uploaded image into a variable $image

        // Foreach loop for uploading multiple images at once
        foreach($image as $multi_image){
            
            // If you have Intervention Image Library
            $name_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();
            Image::make($multi_image)->save('image/multi/'.$name_gen);
            $last_img = 'image/multi/'.$name_gen;
            /*********************************/

            // Eloquent ORM
            Multipic::insert([ // "Brand::" is the name of the model in app/Models/Brand.php
                'image' => $last_img,         
                'created_at' => Carbon::now()
            ]);
        } 

        // Using ToastrJS for notification
        $notification = array(
            'message' => 'Images Added Successfully',
            'alert-type' => 'success'
        );
                
        return redirect()->back()->with($notification); // redirect to previous page with message displaying for success

    }


    // Edit method
    public function Edit($id){
        // Eloquent ORM
        $multi = Multipic::find($id); //finding the exact image with this id

        return view('admin.multipic.edit', compact('multi')); // Passing the specific id to the edit page
    }


    // Update method
    public function Update(Request $request, $id){
        $validated = $request->validate([
            //'filter' => 'required',
            ],
        );
    
            $old_image = $request->old_image;
    
            $multipic = $request->file('image'); // passing the uploaded image into a variable $brand_image
            
            // If there is a new uploaded image
            if($multipic){
    
                $name_gen = hexdec(uniqid());// generate unique id of the image
                $img_ext = strtolower($multipic->getClientOriginalExtension()); //getting the extention of the image
                $img_name = $name_gen.'.'.$img_ext; //adding the extention ot the image
                $up_location = 'image/multi/'; // uploading the image
                $last_img = $up_location.$img_name; // saving the image in the directory
                $multipic->move($up_location, $img_name);
    
                unlink($old_image);
        
                // Eloquent ORM
                Multipic::find($id)->update([ // "Multipic::" is the name of the model in app/Models/Multipic.php
                    'title' => $request->title, // DB field => input field name from html form
                    'description' => $request->description,
                    'filter' => $request->filter,
                    'image' => $last_img,            
                    'updated_at' => Carbon::now()
                ]);
    
            } else { // If there is NOT new uploaded image
    
                 // Eloquent ORM
                 Multipic::find($id)->update([ // "Multipic::" is the name of the model in app/Models/Multipic.php
                    'title' => $request->title, // DB field => input field name from html form
                    'description' => $request->description,
                    'filter' => $request->filter,
                    'updated_at' => Carbon::now()
                ]);
    
            }

            // Using ToastrJS for notification
            $notification = array(
                'message' => 'Image Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('admin.multi.image')->with($notification); // redirect to multi/image page with message displaying for success
    
        }
        

    // Delete method
    public function Delete($id){
        $image = Multipic::find($id)->image;
        // $old_image = $image->brand_image;
        unlink($image);

        $delete = Multipic::find($id)->delete();

        // Using ToastrJS for notification
        $notification = array(
            'message' => 'Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }


    // Portfolio front-end
    public function Portfolio(){
        // Accessing table 'multipics'
        $multipic_app = Multipic::where('filter', 'app')->get();
        $multipic_app_count = Multipic::where('filter', 'app')->count();
        $multipic_card = Multipic::where('filter', 'card')->get();
        $multipic_card_count = Multipic::where('filter', 'card')->count();
        $multipic_web = Multipic::where('filter', 'web')->get();
        $multipic_web_count = Multipic::where('filter', 'web')->count();

        // Passing $multipic_app, $multipic_app_count etc. with compact to the index page
        return view('pages.portfolio', compact(
        'multipic_app',
        'multipic_app_count',
        'multipic_card',
        'multipic_card_count',
        'multipic_web',
        'multipic_web_count',
        )); 
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Auth;
use Illuminate\Support\Carbon;
use Image;



class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // For redirecting the login page if the user is not logedin
    }

    
    // Returning view of brands page from resources/views/admin/brand/index.blade.php
    public function AllBrand(){
        /* Two types of gettin data from DB
        */

        // First: Eloquent ORM method
        $brands = Brand::orderBy('id', 'desc')->paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'brands'
         ); // Taking all data (with paginate() OR with get()) from the db table and assigning it into $brands; ordering it by id in desc  
         return view('admin.brand.index', compact('brands')); // compact() is for passing the data to the index page
    }


    // Adding brand
    public function AddBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png,webp',
            ],
            [
            /* If you don't have Custom messages the system will display automatic ones
            */

            // Custom message when the Brand name field is empty
            'brand_name.required' => 'Please, Input Brand Name',

            // Custom message when the Category Name lenght is bigger than 255
            'brand_name.min' => 'Brand Name can`t be less than 4 symbols long',
            ]
        );

        $brand_image = $request->file('brand_image'); // passing the uploaded image into a variable $brand_image
        
        // Use this code if you don't have Intervention Image Library
        // $name_gen = hexdec(uniqid());// generate unique id of the image
        // $img_ext = strtolower($brand_image->getClientOriginalExtension()); //getting the extention of the image
        // $img_name = $name_gen.'.'.$img_ext; //adding the extention ot the image
        // $up_location = 'image/brand/'; // uploading the image
        // $last_img = $up_location.$img_name; // saving the image in the directory
        // $brand_image->move($up_location, $img_name);
        /**********************************/

        // If you have Intervention Image Library
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300, 300)->save('image/brand/'.$name_gen);
        $last_img = 'image/brand/'.$name_gen;
        /*********************************/

        // Eloquent ORM
        Brand::insert([ // "Brand::" is the name of the model in app/Models/Brand.php
            'brand_name' => $request->brand_name, // DB field => input field name from html form
            'brand_image' => $last_img,            
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Brand added successfully'); // redirect to previous page with message displaying for success
    }


    // Edit method
    public function Edit($id){
        // Eloquent ORM
        $brands = Brand::find($id); //finding the exact brand with this id

        return view('admin.brand.edit', compact('brands')); // Passing the specific id to the edit page
    }


    // Update method
    public function Update(Request $request, $id){
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
            ],
            [
            /* If you don't have Custom messages the system will display automatic ones
            */

            // Custom message when the Brand name field is empty
            'brand_name.required' => 'Please, Input Brand Name',

            // Custom message when the Category Name lenght is bigger than 255
            'brand_name.min' => 'Brand Name can`t be less than 4 symbols long',
            ]
        );

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image'); // passing the uploaded image into a variable $brand_image
        
        // If there is a new uploaded image
        if($brand_image){

            $name_gen = hexdec(uniqid());// generate unique id of the image
            $img_ext = strtolower($brand_image->getClientOriginalExtension()); //getting the extention of the image
            $img_name = $name_gen.'.'.$img_ext; //adding the extention ot the image
            $up_location = 'image/brand/'; // uploading the image
            $last_img = $up_location.$img_name; // saving the image in the directory
            $brand_image->move($up_location, $img_name);

            unlink($old_image);
    
            // Eloquent ORM
            Brand::find($id)->update([ // "Brand::" is the name of the model in app/Models/Brand.php
                'brand_name' => $request->brand_name, // DB field => input field name from html form
                'brand_image' => $last_img,            
                'created_at' => Carbon::now()
            ]);

        } else { // If there is NOT new uploaded image

             // Eloquent ORM
             Brand::find($id)->update([ // "Brand::" is the name of the model in app/Models/Brand.php
                'brand_name' => $request->brand_name, // DB field => input field name from html form
                'created_at' => Carbon::now()
            ]);

        }

        return redirect()->route('all.brand')->with('success', 'Brand updated successfully'); // redirect to brand/all page with message displaying for success

    }


    // Delete method
    public function Delete($id){
        $brand_image = Brand::find($id)->brand_image;
        // $old_image = $image->brand_image;
        unlink($brand_image);

        $delete = Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted Successfully');
    }


    // Multi images All
    public function Multipic(){
        $images = Multipic::all(); // getting all data from Multipic model
        return view('admin.multipic.index', compact('images')); // passing $images with compact to the index page
    }


    // Add multi images
    public function AddImg(Request $request){
        $validated = $request->validate([
            'image' => 'required',
            ]
        );

        $image = $request->file('image'); // passing the uploaded image into a variable $brand_image

        // Foreach loop for uploading multiple images at once
        foreach($image as $multi_image){
            
            // If you have Intervention Image Library
            $name_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();
            Image::make($multi_image)->resize(300, 300)->save('image/multi/'.$name_gen);
            $last_img = 'image/multi/'.$name_gen;
            /*********************************/

            // Eloquent ORM
            Multipic::insert([ // "Brand::" is the name of the model in app/Models/Brand.php
                'image' => $last_img,         
                'created_at' => Carbon::now()
            ]);
        } 

        return redirect()->back()->with('success', 'Images added successfully'); // redirect to previous page with message displaying for success

    }


    // Logout
    public function Logout(){
        Auth::logout();
        return redirect()->route('login');
    }


}

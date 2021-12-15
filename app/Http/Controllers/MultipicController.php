<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multipic;
use Auth;
use Illuminate\Support\Carbon;
use Image;

class MultipicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // For redirecting the login page if the user is not logedin
    }


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

        $image = $request->file('image'); // passing the uploaded image into a variable $brand_image

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

        return redirect()->back()->with('success', 'Images added successfully'); // redirect to previous page with message displaying for success

    }
}

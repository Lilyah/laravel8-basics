<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\HomeAbout;
use Auth;


class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // For redirecting the login page if the user is not logedin
    }


    // Getting About information
    public function HomeAbout(){
        $homeabout = HomeAbout::orderBy('id', 'desc')->paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'homeabout'
         ); // Taking all data (with paginate() OR with get()) from the db table and assigning it into $brands; ordering it by id in desc  
        return view('admin.about.index', compact('homeabout'));
    }


    // Adding About
    public function AddAbout(){
        return view('admin.about.create');
    }


    // Store About
    public function StoreAbout(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'visability' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            ],
        );

        $visability_new_about = $request->visability; // passing the uploaded image into a variable $brand_image

        if($visability_new_about == 'active'){

            $count_active_from_db = DB::table('home_abouts')->where('visability', '=', 'active')->count();
            if ($count_active_from_db == 1){
                    return redirect()->back()->with('failure', 'There is another Active About. You can have only 1 Active About at a time.'); // redirect to previous page with message displaying for success
            }
        } else {

            // Eloquent ORM
            HomeAbout::insert([ // "HomeAbout::" is the name of the model in app/Models/HomeAbout.php
                'title' => $request->title, // DB field => input field name from html form
                'visability' => $request->visability,     
                'short_desc' => $request->short_desc,            
                'long_desc' => $request->long_desc,     
                'created_at' => Carbon::now()
            ]);     
            return redirect()->route('home.about')->with('success', 'About added successfully'); // redirect to previous page with message displaying for success
        
        }
    }


    // Edit method
    public function Edit($id){
        // Eloquent ORM
        $homeabout = HomeAbout::find($id); //finding the exact About with this id

        // Query Builder
        //$homeabout = DB::table('home_abouts')->where('id', $id)->first();
        return view('admin.about.edit', compact('homeabout')); // Passing the specific id to the edit page
    }


    // Update method
    public function Update(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required',
            'visability' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            ],
        );

        $visability_new_about = $request->visability; // passing the uploaded image into a variable $brand_image

        if($visability_new_about == 'active'){

            $count_active_from_db = DB::table('home_abouts')->where('visability', '=', 'active')->count();
            if ($count_active_from_db == 1){
                    return redirect()->back()->with('failure', 'There is another Active About. You can have only 1 Active About at a time.'); // redirect to previous page with message displaying for success
            } else {
                // Eloquent ORM
                HomeAbout::find($id)->update([
                    'title' => $request->title,
                    'visability' => $request->visability,
                    'short_desc' => $request->short_desc,
                    'long_desc' => $request->long_desc,
                    'updated_at' => Carbon::now()
                ]);

                    return redirect()->route('home.about')->with('success', 'About updated successfully'); // redirect to home/about page with message displaying for success
            }
        } else {

            // Eloquent ORM
            HomeAbout::find($id)->update([
                'title' => $request->title,
                'visability' => $request->visability,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'updated_at' => Carbon::now()
            ]);

            return redirect()->route('home.about')->with('success', 'About updated successfully'); // redirect to home/about page with message displaying for success
        }
    
    }


    // Delete About
    public function Delete($id){
        $delete = HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success', 'About Deleted Successfully');
    }
}

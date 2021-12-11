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
            'short_desc' => 'required',
            'long_desc' => 'required',
            ],
        );

        // Eloquent ORM
        HomeAbout::insert([ // "HomeAbout::" is the name of the model in app/Models/HomeAbout.php
            'title' => $request->title, // DB field => input field name from html form
            'short_desc' => $request->short_desc,            
            'long_desc' => $request->long_desc,     
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('home.about')->with('success', 'About added successfully'); // redirect to previous page with message displaying for success
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
        // Eloquent ORM
        HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('home.about')->with('success', 'About updated successfully'); // redirect to home/about page with message displaying for success
    
    }


    // Delete About
    public function Delete($id){
        $delete = HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success', 'About Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // For redirecting the login page if the user is not logedin
    }


    // Returning view of categories page from resources/views/admin/category/index.blade.php
    public function AllCat(){
        /* Two types of gettin data from DB
        */

        // First: Eloquent ORM method
         $categories = Category::orderBy('id', 'desc')->paginate(
            $perPage = 3, $columns = ['*'], $pageName = 'categories'
         ); // Taking all data (with paginate() OR with get()) from the db table and assigning it into $categories; ordering it by id in desc
         $trashCat = Category::onlyTrashed()->orderBy('id', 'desc')->paginate(
            $perPage = 3, $columns = ['*'], $pageName = 'trashCat'
         ); // Soft Delete

        // Second: Query Builder
        // $categories = DB::table('categories')->orderBy('id', 'desc')->paginate(3); // Taking all data (with paginate() OR with get() ) from the db table and assigning it into $categories; ordering it by id in desc

        // When joining tables the Query Builder method looks like this
        // $categories = DB::table('categories')
        //             ->join('users', 'categories.user_id', '=', 'users.id') // Joining tables
        //             ->select('categories.*', 'users.name') // "Select all data from categories and name field drom table users"
        //             ->orderBy('id', 'desc')->paginate(3); // Order and Paginate

    return view('admin.category.index', compact('categories', 'trashCat'));
    }

    // Adding category
    public function AddCat(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
            ],
            [
            /* If you don't have Custom messages the system will display automatic ones
            */

            // Custom message when the Category field is empty
            'category_name.required' => 'Please, Input Category Name',

            // Custom message when the Category Name lenght is bigger than 255
            'category_name.max' => 'Category Name can`t be more than 255 symbols long',
            ]
        );

        /* Three types of inserting data into the DB
        */
        
        // First: Eloquent ORM method, one way
        // Category::insert([ // "Category::" is the name of the model in app/Models/Category.php
        //     'category_name' => $request->category_name,// DB field => input field name from html form
        //     'user_id' => Auth::user()->id, // "Auth" means "this user logedin"; this whole line of code get the user id and insert it into the DB
        //     'created_at' => Carbon::now()
        // ]);

        // Second: Eloquent method, second way
        // $category = new Category;
        // $category-> category_name = $request->category_name;
        // $category-> user_id = Auth::user()->id;
        // $category->save(); // save() method already have "created_at" functionality and will insert it into the DB

        // Third: Query Builder
        $data = array();
        $data['category_name'] = $request->category_name; // DB field => input field name from html form
        $data['user_id'] = Auth::user()->id; // "Auth" means "this user logedin"; this whole line of code get the user id and insert it into the DB
        DB::table('categories')->insert($data);

        return redirect()->back()->with('success', 'Category added successfully'); // redirect to previous page with message displaying for success
    }


    // Edit method
    public function Edit($id){
        // Eloquent ORM
        //$categories = Category::find($id); //finding the exact category with this id

        // Query Builder
        $categories = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('categories')); // Passing the specific id to the edit page
    }

    // Update method
    public function Update(Request $request, $id){
        // Eloquent ORM
        // $update = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id
        // ]);

        // Query Builder
        $data = array();
        $data['category_name'] = $request->category_name; // $requesy->category_name is the name attribute from the html form
        $data['user_id'] = Auth::user()->id; // the user whitch updating the category
        DB::table('categories')->where('id', $id)->update($data); //updating

        return redirect()->route('all.category')->with('success', 'Category updated successfully'); // redirect to categories/all page with message displaying for success

    }


    // SoftDelete
    public function SoftDelete($id){
        // Eloquent ORM
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category Moved to Trash Successfully');
    }

    // Restore Trashed Category
    public function Restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category Restored Successfully');
    }

    // Permanent Delete Category
    public function PermanentDelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category Deleted Successfully');
    }

}

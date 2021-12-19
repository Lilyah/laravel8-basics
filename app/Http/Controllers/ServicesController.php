<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Services;
use Auth;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // For redirecting the login page if the user is not logedin
    }


    // Getting About information
    public function HomeServices(){
        $services = Services::orderBy('id', 'asc')->get(); // Taking all data with get() from the db table and assigning it into $services; ordering it by id in desc  
        return view('admin.services.index', compact('services'));
    }


    // Edit method
    public function Edit($id){
        // Eloquent ORM
        $services = Services::find($id); //finding the exact Service with this id

        return view('admin.services.edit', compact('services')); // Passing the specific id to the edit page
    }




    // Update method
    public function Update(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required',
            'desc' => 'required',
            ],
        );

            // Eloquent ORM
            Services::find($id)->update([
                'title' => $request->title,
                'desc' => $request->desc,
                'updated_at' => Carbon::now()
            ]);

            return redirect()->route('admin.all.services')->with('success', 'Service updated successfully'); // redirect to home/services page with message displaying for success
        }
    
}

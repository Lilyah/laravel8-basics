<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // For redirecting the login page if the user is not logedin
    }


    // Getting Admin Contact information
    public function AdminContact(){
        $contacts = Contact::orderBy('id', 'desc')->paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'homeabout'
            ); // Taking all data (with paginate() OR with get()) from the db table and assigning it into $brands; ordering it by id in desc  
        return view('admin.contact.index', compact('contacts'));
    
    }



    // Adding Contact
    public function AddContact(){
        return view('admin.contact.create');
    }


    // Store Contact
    public function StoreContact(Request $request){
        $validated = $request->validate([
            'address' => 'required',
            'visability' => 'required',
            'email' => 'required',
            'phone' => 'required',
            ],
        );

        $visability_new_contact = $request->visability; // passing the data from visability html field into a variable $visability_new_contact
    
        if($visability_new_contact == 'active'){ // if the required visability from the form is 'Active'
    
            // counting the 'active' records in the db and if there is 1 we denied to insert data
            $count_active_from_db = DB::table('contacts')->where('visability', '=', 'active')->count();
            if ($count_active_from_db == 1){
                    return redirect()->back()->withInput()->with('failure', 'There is another Active Contact Information. You can have only 1 Active Contact Information at a time.'); // withInput() is for not losing the input data in case of failure; redirect to previous page with message displaying for failure
            }
        } else {
    
            // Eloquent ORM
            Contact::insert([ // "Contacts::" is the name of the model in app/Models/Contact.php
                'address' => $request->address, // DB field => input field name from html form
                'visability' => $request->visability,     
                'email' => $request->email,            
                'phone' => $request->phone,     
                'created_at' => Carbon::now()
            ]);     
            return redirect()->route('admin.all.contact')->with('success', 'Contact Information added successfully'); // redirect to previous page with message displaying for success
            
        }
    }


    // Delete Contact
    public function Delete($id){
        $delete = Contact::find($id)->delete();
        return Redirect()->back()->with('success', 'Contact Information Deleted Successfully');
    }

    // Returning view of contact page from resources/views/contact.blade.php
    public function index(){
        return view('contact');
    }
}

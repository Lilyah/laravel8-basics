<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Activate this in case of usin Query builder of type $users = DB::table('contacts')->get();

class ContactController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth'); // For redirecting the login page if the user is not logedin
    // }


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

                // Using ToastrJS for notification
                $notification = array(
                    'message' => 'There is another Active Contact Information. You can have only 1 Active Contact Information at a time',
                    'alert-type' => 'error'
                );

                return redirect()->back()->withInput()->with($notification); // withInput() is for not losing the input data in case of failure; redirect to previous page with message displaying for failure
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

            // Using ToastrJS for notification
            $notification = array(
                'message' => 'Contact Information added successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.all.contact')->with($notification); // redirect to previous page with message displaying for success
            
        }
    }


    // Edit method
    public function Edit($id){
        // Eloquent ORM
        $contact = Contact::find($id); //finding the exact Contact with this id

        // Query Builder
        //$contact = DB::table('contacts')->where('id', $id)->first();
        return view('admin.contact.edit', compact('contact')); // Passing the specific id to the edit page
    }


    // Update method
    public function Update(Request $request, $id){
        $validated = $request->validate([
            'address' => 'required',
            'visability' => 'required',
            'email' => 'required',
            'phone' => 'required',
            ],
        );
    
        $visability_new_contact = $request->visability; // passing the data from visability html field into a variable $visability_new_contact
    
        if($visability_new_contact == 'active'){ // if the required visability from the form is 'active'
    
            // counting the 'active' records in the db and if there is 1 we denied to update the record
            $count_active_from_db = DB::table('contacts')->where('visability', '=', 'active')->count();
            if ($count_active_from_db == 1){

                // Using ToastrJS for notification
                $notification = array(
                    'message' => 'There is another Active Contact Information. You can have only 1 Active Contact Information at a time',
                    'alert-type' => 'error'
                 );

                    return redirect()->back()->with($notification); // redirect to previous page with message displaying for failure
            } else {
                // Eloquent ORM
                Contact::find($id)->update([
                    'address' => $request->address,
                    'visability' => $request->visability,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'updated_at' => Carbon::now()
                ]);

                // Using ToastrJS for notification
                $notification = array(
                    'message' => 'Contact Information Updated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('admin.all.contact')->with($notification); // redirect to home/about page with message displaying for success
            }
        } else {
    
            // Eloquent ORM
            Contact::find($id)->update([
                'address' => $request->address,
                'visability' => $request->visability,
                'email' => $request->email,
                'phone' => $request->phone,
                'updated_at' => Carbon::now()
            ]);

            // Using ToastrJS for notification
            $notification = array(
                'message' => 'Contact Information Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('admin.all.contact')->with($notification); // redirecting the page with message displaying for success
        }
        
    }


    // Delete Contact
    public function Delete($id){
        $delete = Contact::find($id)->delete();

        // Using ToastrJS for notification
        $notification = array(
            'message' => 'Contact Information Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }


    // Returning view of contact page from resources/views/contact.blade.php
    public function Contact(){
        $count_active_contacts = DB::table('contacts')->where('visability', '=', 'active')->count(); // accessing table 'contacts' and count all 'active' record from the db; the purpose of this line is to use $count_active_contacts in the view page and if there isnt any to not display them

        $contact = DB::table('contacts')->where('visability', '=', 'active')->orderby('updated_at', 'desc')->first(); // accessing table 'contacts' and get last updated record with visability 'active' record from the db

        return view('pages.contact', compact('contact', 'count_active_contacts'));
    }


    // Contact form functionality
    public function ContactForm(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            ],
        );

        // Eloquent ORM
        ContactForm::insert([ // "ContactForm::" is the name of the model in app/Models/ContactForm.php
            'name' => $request->name, // DB field => input field name from html form
            'email' => $request->email,     
            'subject' => $request->subject,            
            'message' => $request->message,     
            'created_at' => Carbon::now()
        ]);    

        return Redirect()->back()->with('success', 'Message sended Successfully'); // redirect to previous page with message displaying for success
        
    }


    // Getting Contact Messages from the DB
    public function AdminContactMessage(){
        $messages = ContactForm::orderBy('id', 'desc')->paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'messages'
            ); // Taking all data (with paginate() OR with get()) from the db table and assigning it into $contacts; ordering it by id in desc  
        return view('admin.contact_message.message', compact('messages'));
    }


    // Delete Contact Messages from Admin Panel
    public function DeleteContactMessage($id){
        $delete = ContactForm::find($id)->delete();

        $notification = array(
            'message' => 'Message Deleted Successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);

    }
    
}

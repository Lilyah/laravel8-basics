<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // For redirecting the login page if the user is not logedin
    }

    
    // Returning view of contact page from resources/views/contact.blade.php
    public function index(){
        return view('contact');
    }
}

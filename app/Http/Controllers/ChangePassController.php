<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;

class ChangePassController extends Controller
{
    // Returning Vie for Change password
    public function ChangePassword(){
        return view('admin.body.change_password');
    }


    // Update Password
    public function UpdatePassword(Request $request){
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
            ],
        );

        $hashedPassword = Auth::user()->password; // current password of the user from the db
        if(Hash::check($request->old_password, $hashedPassword)){ // checking if the old_password is matching with the password in the db
            $user = User::find(Auth::id()); // finding the exact user id
            $user->password = Hash::make($request->password); // hashing the new password
            $user->save(); // saving the new hashed password
            Auth::logout(); // log out the user

            return redirect()->route('login')->with('success', 'Password Changed Successfully');
        } else {

            return redirect()->back()->with('error', 'Current Password is Invalid');

        }
    }


    // Update User Profile 
    public function ProfileUpdate(Request $request){
        if(Auth::user()){ // If the user is logedin
            $user = User::find(Auth::user()->id); // finding the id of the logedin user and assigned it to $user
            if($user){ // if $user
                return view('admin.body.update_profile', compact('user')); // returning the view with $user data
            }
        }

        // $validated = $request->validate([
        //     'old_password' => 'required',
        //     'password' => 'required|confirmed',
        //     ],
        // );

    }
}

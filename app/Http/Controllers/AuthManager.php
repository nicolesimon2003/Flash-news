<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    function login(){
        if(Auth::check()){
            return redirect('hi');
        }

        return view('login');
           
    
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {

            if ($request->is('api/*') || $request->wantsJson()) {

                return response()->json(Auth::user());
            } else {

                return redirect()->intended(route('hi'));
            }
        }
    
        return redirect(route('login'))->with("error", "Invalid credentials");
    }
    

    function registration(){
        if(Auth::check()){
            return redirect('hi');
        }

        return view('registration');
           
    
    }

    function registrationPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            

        ]);
    
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
    
        $user = User::create($data);
    
        if (!$user) {

            return redirect(route('registration'))->with("error", "Registration failed. Try again.");
        } else {

            if ($request->is('api/*') || $request->wantsJson()) {

                return response()->json($user, 201);
            } else {

                return redirect(route('login'))->with("success", "Registration successful. Login to access the app.");
            }
        }
    }

   
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));    
    }
    public function getUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }

}
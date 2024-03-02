<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetRequestForm(){
        return view('reset-request');
    }

    public function showResetPasswordPost(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        return redirect()->route('reset.password.form', ['email' => $request->email])->with("error", "Wrong email");
    }
    
    public function showResetPasswordForm(Request $request){
        $email = $request->query('email');
        return view('reset-password')->with('email', $email);
    }

    public function resetPasswordPost(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users',
        'password' => 'required|confirmed|min:3',
    ]);


    $user = User::where('email', $request->email)->first();


    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('status', 'Password reset successfully');
}
    public function resetpostman(Request $request,$email){
        $this->validate($request,[
            'password'=>'string'
        ]);
        $user = User::where('email',$email)->first();

        if(!$user){
            return response()->json(['message'=>'user not found'],404);
        }

        $user->update($request->all());

        return $user;

    }
  
}

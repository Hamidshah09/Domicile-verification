<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class userController extends Controller
{
    public function usersgrid(){
        $users = User::with('user_types', 'user_statuses', 'role_types')->get();
        return view('usersgrid', compact('users'));
    }
    public function newuser(){
        return view('newuser');
    }
    public function store(Request $request)
    {
        
        $request->validate([
            'user_type_id'=>['required','numeric'],
            'role_id'=>['required','numeric'],
            'cnic' => ['string', 'size:13'],
            'name' => ['required', 'string', 'max:255'],
            'fathername' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
    
        if (Auth::user()->role==2){
            User::create([
                'user_type_id'=>$request->user_type_id,
                'cnic' => $request->cnic,
                'name' => $request->name,
                'fathername' => $request->fathername,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role'=>$request->role_id,    
            ]);
            return redirect()->route('users.grid');
        }else{
            abort(403, 'You are not Authorized');
        }

    }
}
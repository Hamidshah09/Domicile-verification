<?php

namespace App\Http\Controllers;

use App\Models\role_types;
use App\Models\User;
use App\Models\user_statuses;
use App\Models\user_types;
use App\Rules\PreventFullCnicModification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class userController extends Controller
{
    public function usersgrid(){
        $users = User::with('user_types', 'user_statuses', 'role_types')->paginate(10);
        return view('user.usersgrid', compact('users'));
    }
    public function newuser(){
        return view('user.newuser');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'user_type_id'=>['required','numeric'],
            'role'=>['required','numeric'],
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
    public function edit($id){
        $users=User::with('user_types')
                    ->with('user_statuses')
                    ->with('role_types')
                    ->where('id', $id)
                    ->get();
        $user_types = user_types::all();
        $user_statuses = user_statuses::all();
        $role_types = role_types::all();
        return view('user.edituser', compact('users', 'user_types', 'user_statuses', 'role_types'));
    }
    public function can_cnic_be_modified($value, $cnic){
        $allowed=8;
        $modified=0;
        for ($i = 0; $i < strlen($cnic); $i++) {
            if ($cnic[$i]!=$value[$i]){
                $modified = $modified + 1;
            } 
        }
        if ($modified>$allowed){
            return false;
        }else{
            return true;
        }
    }
    public function update(Request $request, $id){
        $request->validate([
            'user_type_id'=>['required','numeric'],
            'role'=>['required','numeric'],
            'cnic' => ['required' ,'string', 'size:13'],
            'name' => ['required', 'string', 'max:255'],
            'fathername' => ['required', 'string', 'max:255'],
        ]);
        
        if($request->password){
            $request->validate(['password' => ['required', Rules\Password::defaults()],]);
        }
        $user = User::findorfail($id);
        if ($user->email != $request->email){
            $request->validate(['email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class]]);
        }
        if ($this->can_cnic_be_modified($request->cnic, $user->cnic)==false){
            return redirect()->back()->withErrors(['error'=>'Only 8 characters of cnic can be changed.'])->withInput();
        }
        $user->cnic = $request->cnic;
        $user->role = $request->role;
        $user->name = $request->name;
        $user->fathername = $request->fathername;
        $user->user_type_id = $request->user_type_id;
        $user->status_id = $request->status_id;
        $user->is_allowed_to_chat = $request->is_allowed_to_chat;
        
        if ($user->email != $request->email){
            $user->email = $request->email;
        }

        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('users.grid')->with('status', 'Record Update');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class dashboardController extends Controller
{
    public function index(){
        if (Auth::user()->role==1){
            $user_id = str(Auth::id());
            $user_apps = application::with('application_statuses')
                                    ->with('application_types')
                                    ->where('user_id', '=', Auth::id())->get();
        }else{
            $user_apps = application::where('application_status_id', '1')->get();
        }
        return view('dashboard', compact('user_apps'));

    }
    public function createnew(){
        return view('createnew');
    }
    public function storenew(Request $request){

    }   
    public function applyverification(){
        return view('applyverification');
    }
    public function submitverification(Request $request){
        
        $user_apps = application::where('user_id', Auth::id());
        if ($user_apps){
            return redirect()->back()->withErrors(['error'=>'Your Application has already been processed.'])->withInput();
        }
        $request->validate([ 'scan_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',]);
        if ($request->hasFile('scan_file')) {
            $path = $request->file('scan_file')->store('images', 'public');
        } else {
            $path = null;
        }      
        application::create([
            'user_id'=>Auth::id(),
            'application_type_id'=>'2',
            'application_status_id'=>'1',
            'scaned_docs'=>$path,
        ]);
        return view('dashboard');
    }
}

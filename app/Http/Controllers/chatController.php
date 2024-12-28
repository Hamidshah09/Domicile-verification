<?php

namespace App\Http\Controllers;

use App\Models\conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class chatController extends Controller
{
    public function index($id){
        $conversions = DB::table('conversations')
                            ->whereRaw('application_id = '. $id .' and sender_id = ' . Auth::id() . ' or  receiver_id = ' . Auth::id(). ' and application_id = '. $id)
                        ->where('application_id','=', $id)
                        // ->where('sender_id', Auth::id())
                        // ->Where('receiver_id', Auth::id())
                        ->orderByDesc('id')->get();
        return view('conversation', compact('conversions'));
    }
    public function submitchat(Request $request, $id){
        $request->validate([
            'message'=>'required|max:100'
        ]);
        $activeAdminId = User::where('role', '2')
                             ->where('status_id', '1')
                             ->get(['id']);
        if ($activeAdminId->isEmpty()){
            return redirect()->back()->withErrors(['error'=>'No Admin is active to record your messages. Please Contact System Administrator.'])->withInput();
        }
        conversation::create([
            'application_id'=>$id,
            'sender_id'=>Auth::id(),
            'receiver_id'=>$activeAdminId[0]->id,
            'chat'=>$request->message,
        ]);
        return redirect()->route('chat', $id);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class chatController extends Controller
{
    public function index($id){
        
            $conversions =conversation:: with(["sender"=>function($query){$query->select('id', 'name');}])
                                    ->with(["receiver"=>function($query){$query->select('id', 'name');}])
                                    ->where('application_id', $id)
                                    ->orderByDesc('id')->get();
            DB::table('conversations')
                            ->whereRaw('receiver_id = ' . Auth::id(). ' and application_id = '. $id)
                            ->update(['is_receiver_see'=>'1']);
        
        return view('conversation', compact('conversions'));
    }
    public function submitchat(Request $request, $id){
        $request->validate([
            'message'=>'required|max:100'
        ]);
        
        
        if (Auth::user()->role==1){
            //if user is citizen his message will be received by active operator or active admin
            $activeOperator = User::where('role', '3')
                             ->where('status_id', '1')
                             ->get(['id']);
            if ($activeOperator->isEmpty()){
                //if no active operator available we will find active admin
                $activeAdmin = User::where('role', '3')
                                ->where('status_id', '1')
                                ->get(['id']);
                if ($activeAdmin->isEmpty()){
                    //if no active admin is available chat can not be made...
                    return redirect()->back()->withErrors(['error'=>'No Admin or Operator is active to record your messages. Please Contact System Administrator.'])->withInput();
                }else{
                    $receiver_id = $activeAdmin[0]->id;    
                }
            }else{
                $receiver_id = $activeOperator[0]->id;
            }
            conversation::create([
                'application_id'=>$id,
                'sender_id'=>Auth::id(),
                'receiver_id'=>$receiver_id,
                'chat'=>$request->message,
            ]);
        }else{
            //if sender is admin or operator need to find who to send message
            $recever_id = application::findorfail($id)->get(["user_id"]);
            conversation::create([
                'application_id'=>$id,
                'sender_id'=>Auth::id(),
                'receiver_id'=>$recever_id[0]->user_id,
                'chat'=>$request->message,
            ]);
        }
        
        return redirect()->route('chat', $id);
    }

}

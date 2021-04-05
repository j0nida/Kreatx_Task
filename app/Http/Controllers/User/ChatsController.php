<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Events\ChatMessageWasReceived;

use Illuminate\Http\Request;

class ChatsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $messages=Message::with('user')->get();
        return view('user.chats',['messages'=>$messages]);
    }
    
    public function get_all_messages(){
        return Message::with('user')->get();
    }
    
    public function send_message(Request $request)
    {
        if(!empty($request->message)){
         $message = auth()->user()->messages()->create([
             'content' => $request->message
            ]);
        broadcast(new ChatMessageWasReceived($message->load('user')));
         
        return ['status' => 'ok'];
         }
    }
}

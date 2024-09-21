<?php

namespace App\Http\Controllers;

use App\Events\GreetingSent;
use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChat()
    {
        return view('chat.show');
    }
    public function messageReceived(Request $request)
    {
        $rules = [
            'message' => 'required',
        ];
        $request->validate($rules);
        broadcast(new MessageSent($request->user(), $request->message));
        return response()->json("Message Broadcasted");
    }
    public function greetReceived(Request $request, User $user)
    {
        broadcast(new GreetingSent($user, "{$request->user()->name} greeted You"));
        broadcast(new GreetingSent($request->user(), "You greeted {$user->name} "));
        return "Greeting {$user->name}  from {$request->user()->name}";
    }
}
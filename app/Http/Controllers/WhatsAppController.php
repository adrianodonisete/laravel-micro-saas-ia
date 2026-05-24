<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function newMessage(Request $request)
    {
        dd($request->all());
        // $message = $request->input('message');
        // $user = $request->input('user');
        // $user = User::find($user);
        // $user->messages()->create([
        //     'message' => $message,
        //     'user_id' => $user->id,
        // ]);
        // return response()->json(['message' => 'Message created']);
    }
}

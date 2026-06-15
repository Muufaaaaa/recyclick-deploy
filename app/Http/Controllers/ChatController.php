<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat.index', compact('chats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|min:1|max:1000',
        ]);

        Chat::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'sender' => 'user',
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}
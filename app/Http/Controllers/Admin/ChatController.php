<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $conversations = Chat::with('user')
            ->latest()
            ->get()
            ->unique('user_id');

        return view('admin.chats.index', compact('conversations'));
    }

    public function show(User $user)
    {
        $chats = Chat::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();

        Chat::where('user_id', $user->id)
            ->where('sender', 'user')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('admin.chats.show', compact('user', 'chats'));
    }

    public function reply(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string|min:1|max:1000',
        ]);

        Chat::create([
            'user_id' => $user->id,
            'message' => $request->message,
            'sender' => 'admin',
            'is_read' => true,
        ]);

        return back()->with('success', 'Balasan berhasil dikirim.');
    }
}
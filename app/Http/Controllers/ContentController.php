<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            // Admin melihat semua konten
            $contents = Content::with('user')->latest()->paginate(10);
        } else {
            // User hanya melihat kontennya sendiri
            $contents = auth()->user()->contents()->latest()->paginate(10);
        }

        return view('dashboard', [
            'contents' => auth()->user()->contents()->latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $content = new Content();
        $content->title = $request->title;
        $content->body = $request->body;
        $content->user_id = auth()->id(); // Hubungkan ke user yang sedang login
        $content->save();

        return redirect()->route('user.dashboard')->with('success', 'Content created successfully.');
    }


    public function show(Content $content)
    {
        // Pastikan konten milik user yang sedang login
        if ($content->user_id !== Auth::id()) {
            abort(403);
        }
        return view('contents.show', compact('content'));
    }

    public function edit(Content $content)
    {
        // Validasi bahwa user hanya dapat mengedit kontennya sendiri
        if (auth()->user()->id !== $content->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('contents.edit', compact('content'));
    }

    public function update(Request $request, Content $content)
    {
        if (auth()->user()->id !== $content->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $content->update($request->only('title', 'body'));

        return redirect()->route('user.contents.index')->with('success', 'Content updated successfully.');
    }

    public function destroy(Content $content)
    {
        if (auth()->user()->id !== $content->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $content->delete();

        return redirect()->route('user.contents.index')->with('success', 'Content deleted successfully.');
    }
}

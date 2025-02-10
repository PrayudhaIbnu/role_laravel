<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->when(Auth::user()->hasRole('admin'), function ($query) {
                $query->select(
                    'id',
                    'title',
                    'article',
                    'user_id',
                    'updated_at'
                );
            })->when(Auth::user()->hasRole('guest'), function ($query) {
                $query->where('user_id', Auth::id());
            })->get();

            return view('article.index', compact('articles'));
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'is_active' => true,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artilel Berhasil Dibuat!');
    }

    public function edit(Article $article)
    {
        // Edit artikel (guest dan admin)
        return view('article.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        // Update artikel (guest dan admin)
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'is_active' => 'required|boolean',
        ]);

        $article->update($request->only(['title', 'content', 'is_active']));

        return redirect()->route('article.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        // Hapus artikel (khusus guest)
        $article->delete();
        return redirect()->route('article.index')->with('success', 'Artikel berhasil dihapus.');
    }
}

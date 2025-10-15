<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSnippetRequest;
use App\Http\Requests\UpdateSnippetRequest;
use App\Models\Snippet;

class AdminSnippetController extends Controller
{
    /**
     * Display a listing of snippets.
     */
    public function index()
    {
        $snippets = Snippet::orderBy('correct_order')->paginate(15);
        
        return view('operator.snippets.index', compact('snippets'));
    }

    /**
     * Show the form for creating a new snippet.
     */
    public function create()
    {
        return view('operator.snippets.create');
    }

    /**
     * Store a newly created snippet.
     */
    public function store(StoreSnippetRequest $request)
    {
        Snippet::create($request->validated());

        return redirect()
            ->route('operator.manage.snippets.index')
            ->with('success', 'Snippet berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified snippet.
     */
    public function edit(Snippet $snippet)
    {
        return view('operator.snippets.edit', compact('snippet'));
    }

    /**
     * Update the specified snippet.
     */
    public function update(UpdateSnippetRequest $request, Snippet $snippet)
    {
        $snippet->update($request->validated());

        return redirect()
            ->route('operator.manage.snippets.index')
            ->with('success', 'Snippet berhasil diperbarui.');
    }

    /**
     * Remove the specified snippet.
     */
    public function destroy(Snippet $snippet)
    {
        $snippet->delete();

        return redirect()
            ->route('operator.manage.snippets.index')
            ->with('success', 'Snippet berhasil dihapus.');
    }
}

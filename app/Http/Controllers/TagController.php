<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $tags = Tag::all();

        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() :View
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request): RedirectResponse
    {
        Tag::query()->create(
            array_merge(
                $request->validated(),
                ['user_id' => auth()->user()->id]
            )
        );

        return redirect()->to(route('tags.home'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag) :View
    {
        $this->authorize('update', $tag);

        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag): RedirectResponse
    {
        $this->authorize('update', $tag);

        $updated = $tag->update($request->validated());

        // Show error message if updaing wasn't successful.
        if (!$updated) {

            return redirect()->back()->withErrors(['error' => 'Tag update failed.']);
        }

        // If requested update was a success,
        // redirect to index with success message.
        return redirect()->to(route('tags.home'))->with('success', 'Tag successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag): RedirectResponse
    {
        $this->authorize('delete', $tag);

        $tag->delete();

        return redirect()->to(route('tags.home'))->with('success', 'Tag successfully deleted');
    }
}

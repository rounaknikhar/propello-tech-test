<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = auth()->user()?->tasks ?? [];

        return view('index', compact('tasks'));
    }

    public function create(): View
    {

        return view('tasks.create');
    }

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);

        // Paginate all tags.
        $tags = Tag::paginate(5);

        return view('tasks.edit', compact(['task', 'tags']));
    }

    public function store(CreateTaskRequest $request): RedirectResponse
    {
        Task::query()->create(
            array_merge(
                $request->validated(),
                ['user_id' => auth()->user()->id]
            )
        );

        return redirect()->to(route('tasks.home'));
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $updated = $task->update($request->validated());

        // Show error message if updaing wasn't successful.
        if (!$updated) {
            return redirect()->back()->withErrors(['error' => 'Task update failed.']);
        }

        // If requested update was a success,
        // redirect to index with success message.
        return redirect()->to(route('tasks.home'))->with('success', 'Task successfully updated');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->to(route('tasks.home'));
    }

    public function complete(Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->complete = !$task->complete;
        $task->save();

        return redirect()->to(route('tasks.home'));
    }

    /**
     * Rdd task tag.
     */
    public function addTag(Task $task, Tag $tag): RedirectResponse
    {
        $task->tags()->attach($tag->id);
        return redirect()->back()->with('success', 'Tag successfully added');
    }

    /**
     * Remove task tag.
     */
    public function removeTag(Task $task, Tag $tag): RedirectResponse
    {
        $task->tags()->detach($tag->id);
        return redirect()->back()->with('success', 'Tag has been removed');
    }
}

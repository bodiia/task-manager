<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function index(): Renderable
    {
        $tasks = Task::with(['author', 'executor', 'status'])->get();
        return view('task.index', compact('tasks'));
    }

    public function create(): Renderable
    {
        $statuses = Status::all();
        $labels = Label::all();
        $executors = User::all();

        return view('task.create', compact('statuses', 'labels', 'executors'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $task = new Task([
            'title' => $validated['title'],
            'description' => $validated['description']
        ]);

        $task->status()->associate($validated['status']);
        $task->executor()->associate($validated['executor']);
        $task->author()->associate(auth()->user());
        $task->save();

        $task->labels()->sync($validated['labels'], false);

        return to_route('tasks.index')->with('success', 'Задача создана.');
    }

    public function show(Task $task): Renderable
    {
        $task->load(['author', 'executor']);

        return view('task.show', compact('task'));
    }

    public function edit(Task $task): Renderable
    {
        $statuses = Status::all();
        $labels = Label::all();
        $executors = User::all();

        $task->load(['executor', 'author', 'status']);

        return view('task.edit', compact('task', 'statuses', 'labels', 'executors'));
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $validated = $request->validated();

        $task->fill([
            'title' => $validated['title'],
            'description' => $validated['description']
        ]);

        $task->status()->associate($validated['status']);
        $task->executor()->associate($validated['executor']);
        $task->author()->associate(auth()->user());
        $task->save();

        $task->labels()->sync($validated['labels']);

        return to_route('tasks.index')->with('success', 'Задача изменена.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);
        $task->delete();

        return to_route('task.index')->with('success', 'Задача удалена.');
    }
}

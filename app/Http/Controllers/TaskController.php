<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Label;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

        foreach ($validated['labels'] as $label) {
            if (Label::query()->find($label)) {
                $task->labels()->attach($label);
            }
        }

        return to_route('tasks.index')->with('success', 'Задача создана.');
    }
    public function show(Task $task): Renderable
    {
        return view('task.show', compact('task'));
    }

    public function edit(Task $task): Renderable
    {
        //
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        //
    }

    public function destroy(Task $task): RedirectResponse
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
        //
    }

    public function store(Request $request): RedirectResponse
    {
        //
    }
    public function show(Task $task): Renderable
    {
        //
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

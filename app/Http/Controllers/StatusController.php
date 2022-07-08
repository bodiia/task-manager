<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatusRequest;
use App\Models\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class StatusController extends Controller
{
    public function index(): Renderable
    {
        $statuses = Status::with('tasks')->get();

        return view('statuses.index', compact('statuses'));
    }

    public function store(StoreStatusRequest $request): RedirectResponse
    {
        $status = new Status($request->validated());
        $status->creator()->associate(auth()->user());
        $status->save();

        return to_route('statuses.index')->with('success', 'Статус создан.');
    }

    public function destroy(Status $status): RedirectResponse
    {
        $this->authorize('delete', $status);
        $status->delete();

        return to_route('statuses.index')->with('success', 'Статус удален.');
    }
}

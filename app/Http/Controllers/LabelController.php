<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Models\Label;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class LabelController extends Controller
{
    public function index(): Renderable
    {
        $labels = Label::all();

        return view('labels.index', compact('labels'));
    }

    public function store(StoreLabelRequest $request): RedirectResponse
    {
        Label::query()->create($request->validated());

        return to_route('labels.index')->with('success', 'Метка создана.');
    }

    public function destroy(Label $label): RedirectResponse
    {
        $this->authorize('delete', $label);
        $label->delete();

        return to_route('labels.index')->with('success', 'Метка удалена.');
    }
}

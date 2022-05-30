<?php

namespace App\Http\Requests;

use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user() && auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $statusIds = Status::all()->pluck('id');
        $executorIds = User::all()->pluck('id');

        return [
            'title' => 'required|min:20|max:255',
            'description' => 'required|min:20|max:500',
            'status' => ['required', Rule::in($statusIds)],
            'executor' => ['required', Rule::in($executorIds)],
            'labels' => 'required|array'
        ];
    }
}

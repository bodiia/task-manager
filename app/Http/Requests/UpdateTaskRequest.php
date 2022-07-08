<?php

namespace App\Http\Requests;

use App\Models\Label;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() && $this->user()->can('update', $this->task);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $statusIds = Status::all()->pluck('id');
        $userIds = User::all()->pluck('id');
        $labelIds = Label::all()->pluck('id');

        return [
            'title' => 'required|min:20|max:255',
            'description' => 'required|min:20|max:500',
            'status' => ['required', Rule::in($statusIds)],
            'executor' => ['required', Rule::in($userIds)],
            'author' => ['required', Rule::in($userIds)],
            'labels' => 'required|array',
            'labels.*' => Rule::in($labelIds),
        ];
    }
}

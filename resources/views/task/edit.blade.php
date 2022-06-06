@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <strong>Изменить задачу</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks.update', $task) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <input type="text" name="author" value="{{ $task->author->id }}" hidden>
                            <div class="mb-3">
                                <label for="title-task">Заголовок</label>
                                <input id="title-task" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $task->title) }}">
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description-task">Описание</label>
                                <textarea id="description-task" class="form-control @error('description') is-invalid @enderror" name="description" rows="5">{{ old('description', $task->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status-task">Статус</label>
                                <select name="status" id="status-task" class="form-select @error('status') is-invalid @enderror">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" @if($status->id == old('status', $task->status->id)) selected @endif>{{ $status->status }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="executor-task">Исполнитель</label>
                                <select name="executor" id="executor-task" class="form-select @error('executor') is-invalid @enderror">
                                    @foreach($executors as $executor)
                                        <option value="{{ $executor->id }}" @if($executor->id == old('executor', $task->executor->id)) selected @endif>{{ $executor->name }}</option>
                                    @endforeach
                                </select>
                                @error('executor')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="labels-task">Метки</label>
                                <select name="labels[]" id="labels-task" class="form-select @error('labels') is-invalid @enderror" multiple>
                                    @foreach($labels as $label)
                                        <option value="{{ $label->id }}" @if($task->labels->pluck('id')->contains($label->id)) selected @endif>{{ $label->name }}</option>
                                    @endforeach
                                </select>
                                @error('labels')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-outline-primary" type="submit">Изменить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
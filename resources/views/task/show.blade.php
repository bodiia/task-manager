@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ $task->title }}</strong>
                    </div>
                    <div class="card-body">
                        <div>
                            <strong>Описание: </strong> {{ $task->description }}
                        </div>
                        <div>
                            <strong>Исполнитель: </strong> {{ $task->executor->name }}
                        </div>
                        <div>
                            <strong>Автор: </strong> {{ $task->author->name }}
                        </div>
                    </div>
                    <div class="card-footer">
                        <strong>Дата создания: </strong> {{ $task->created_at->toDateString() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="row">ID</th>
                            <th scope="row">Статус</th>
                            <th scope="row">Имя</th>
                            <th scope="row">Автор</th>
                            <th scope="row">Исполнитель</th>
                            <th scope="row">Дата создания</th>
                            <th scope="row">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->status->status }}</td>
                                <td>
                                    <a class="text-decoration-none" href="{{ route('tasks.show', $task) }}">
                                        {{ $task->title }}
                                    </a>
                                </td>
                                <td>{{ $task->author->name }}</td>
                                <td>{{ $task->executor->name }}</td>
                                <td>{{ $task->created_at->toDateString() }}</td>
                                <td>
                                    #
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4 mx-auto">
                @can('create', App\Models\Status::class)
                    <form action="{{ route('statuses.store') }}" method="POST">
                        @csrf
                        <div class="input-group gap-2">
                            <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}">
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn btn-outline-primary">Создать</button>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
        <div class="row">
            <div class="col-6 mx-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Количество задач</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statuses as $status)
                            <tr>
                                <td>{{ $status->status }}</td>
                                <td>{{ $status->created_at->toDateString() }}</td>
                                <td>{{ $status->tasks->count() }}</td>
                                <td>
                                    @can('delete', $status)
                                        <form action="{{ route('statuses.destroy', $status) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger">Удалить</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
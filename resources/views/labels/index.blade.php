@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 mx-auto">
            @can('create', App\Models\Label::class)
                <form action="{{ route('labels.store') }}" method="POST">
                    @csrf
                    <div class="input-group gap-2">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                        @error('name')
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
                        <th>Метка</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($labels as $label)
                        <tr>
                            <td>{{ $label->name }}</td>
                            <td>
                                @can('delete', $label)
                                    <form action="{{ route('labels.destroy', $label) }}" method="POST">
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
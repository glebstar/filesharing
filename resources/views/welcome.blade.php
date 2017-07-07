@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Все файлы</h1>
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Имя файла</th>
                    @foreach($files as $file)
                        <tr>
                            <td>{{ $file->id }}</td>
                            <td><a href="/{{ $file->public_id }}.html">{{ $file->name }}</a></td>
                        </tr>
                    @endforeach
                </tr>
            </table>
        </div>
        <div class="row">
            {{ $files->links() }}
        </div>
    </div>
@endsection

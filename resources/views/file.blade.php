@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Файл: <b>{{ $file->name }}</b></h2>
        <div class="row">
                <a href="/download/{{ $file->public_id }}">Скачать</a>
        </div>
    </div>
@endsection
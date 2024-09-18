@extends('layouts.layout', ['title' => "404 ошибка"])
@section('content')
    <div class="d-grid gap-2 col-6 mx-auto">
        <img src="{{asset('img/404.svg')}}" class="text">
        <a href="/" class="btn btn-secondary">Вернуться на главную</a>
    </div>
@endsection

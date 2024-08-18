@extends('layouts.layout', ['title' => "Создать пост"])
@section('content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data" class="d-grid gap-3">
        @csrf
        <h3>Создать пост</h3>
        @include('post.parts.form')
        <input type="submit" value="Создать пост" class="btn btn-outline-success">
    </form>
@endsection

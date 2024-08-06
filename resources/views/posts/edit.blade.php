@extends('layouts.layout')
@section('content')
    <form action="{{ route('posts.update', ['id'=>$post->post_id]) }}" method="post" enctype="multipart/form-data" class="d-grid gap-3">
        @csrf
        @method('PATCH')
        <h3>Редактировать пост</h3>
        @include('posts.parts.form')
        <input type="submit" value="Редактировать пост" class="btn btn-outline-success">
    </form>
@endsection

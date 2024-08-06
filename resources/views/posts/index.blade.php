@extends('layouts.layout')
@section('content')
    @if(isset($_GET['search']))
        @if(count($posts) > 0)
            <h2>Результаты поиска по запросу <?=$_GET['search']?></h2>
            @if((count($posts)) == 1)
                <p class="lead">Всего найден {{count($posts)}} пост</p>
            @else
                @if(((count($posts)) % 10 == 0) || (((count($posts)) % 10 > 4) && ((count($posts)) % 10 < 10)))
                    <p class="lead">Всего найдено {{count($posts)}} постов</p>
                @endif
                @if((count($posts)) % 10 == 1)
                    <p class="lead">Всего найдено {{count($posts)}} пост</p>
                @endif
                @if(((count($posts)) % 10 > 1) && ((count($posts)) % 10 < 5))
                    <p class="lead">Всего найдено {{count($posts)}} поста</p>
                @endif
            @endif
        @else
            <h2>По запросу <?=$_GET['search']?> ничего не найдено</h2>
            <a href="{{route('posts.index')}}" class="btn btn-outline-primary back">Отобразить все посты</a>
        @endif
    @endif
    <div class="row">
        @foreach($posts as $post)
        <div class="col-6">
            <div class="card">
                <div class="card-header"><h2>{{$post->short_title}}</h2></div>
{{--                {{$post->des}}--}}
                <div class="card-img" style="background-image: url({{$post->img ?? asset('img/t.jpg')}})"></div>
                <div class="card-author">Автор: {{$post->name}}</div>
                <a href="{{ route('posts.show', ['id' => $post->post_id]) }}" class="btn btn-outline-primary check-post">Посмотреть пост</a>
            </div>
        </div>
        @endforeach
    </div>
    @if(!isset($_GET['search']))
    <div class="pagination">
        {{$posts->links()}}
    </div>
    @endif
@endsection

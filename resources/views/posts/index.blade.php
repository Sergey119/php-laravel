<?php header('Content-Type: text/html; charset=utf-8'); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

        <div class="container navbar-collapse" id="navbarSupportedContent">
            <ul class="col-6 navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link active" aria-current="page" href="/">Главная</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" aria-current="page" href="/">Создать пост</a>
                </li>
            </ul>
            <form class="d-flex" role="search" action="{{ route('post.index') }}">
                <input class="form-control me-2" type="search" name="search" placeholder="Найти пост..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Поиск</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
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
            <a href="{{route('post.index')}}" class="btn btn-outline-primary back">Отобразить все посты</a>
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
                <a href="#" class="btn btn-outline-primary check-post">Посмотреть пост</a>
            </div>
        </div>
        @endforeach
    </div>
    @if(!isset($_GET['search']))
    <div class="pagination">
        {{$posts->links()}}
    </div>
    @endif
</div>
</body>
</html>

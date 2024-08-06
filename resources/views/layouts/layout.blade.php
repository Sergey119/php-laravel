<!doctype html>
<html lang="ru">
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
                    <a class="nav-link active" aria-current="page" href="{{route('posts.create')}}">Создать пост</a>
                </li>
            </ul>
            <form class="d-flex" role="search" action="{{ route('posts.index') }}">
                <input class="form-control me-2" type="search" name="search" placeholder="Найти пост..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Поиск</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>

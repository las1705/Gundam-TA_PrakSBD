<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modul 2 Kelompok 37</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('admin.home')}}"> TA SBD Kel 37</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('admin.home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.index')}}">Index</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.bin')}}">Recycle Bin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.customerAccount')}}">Customer Account</a>
                </li>
            </ul>
        </div>

        <form class="d-flex" role="search">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $user->username }}
                </a>
                <ul class="dropdown-menu">
                    <li>
{{--                        <form action="{{ route('logout') }}" method="post">--}}
{{--                            @csrf--}}
{{--                            <button type="submit" class="btn nav-link px-3 d-inline">Logout</button>--}}
{{--                        </form>--}}
                        <a class="dropdown-item" href="{{route('logout')}}">Logout</a>

                    </li>

                </ul>
            </div>

        </form>

    </div>


</nav>
<div class="container">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>
</body>

</html>


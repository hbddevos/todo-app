<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href='{{ asset('/css/bootstrap.css') }}'>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/fa/css/all.css') }}">

    <script src="{{ asset('/fa/js/all.js') }}" defer></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}" defer></script>
    <title>@yield('title')</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">TODO-App</a>

                <div class="navbar-collapse">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" aria-current="page">@yield('navigation')</a>
                        </li>
                    </ul>
                    <form class="d-flex my-2 my-lg-0">
{{--                        <input class="form-control me-sm-2" type="text" placeholder="Search">--}}
                        @auth
                            {{-- <span><img src="{{}}" alt=""></span> --}}
                            <span class="me-5 text-white"><i><b>{{ Auth::user()->name }}</b></i></span>
                            <form action="" method="post">
                                @csrf
                                @method('delete')
{{--                                <button type="submit" class="btn btn-outline-secondary">Logout</button>--}}
                                <a class="btn btn-outline-secondary" href="{{route('logout')}}"> Logout </a>
                            </form>
                        @endauth
                        @guest
                           <div class="d-flex gap-2 align-items-center">
                               <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                               <a href="{{route('register')}}" class="btn btn-outline-primary">Register</a>
                           </div>
                        @endguest
{{--                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Login</button>--}}
{{--                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Register</button>--}}
                    </form>
                </div>
            </div>
        </nav>


    </header>

    <main class="container mt-5  bg-secondary-rgb">
        <section class="row main">
            <div class="col-2">
                <div class="status d-flex flex-column align-items-start justify-content-between">
                    <div>
                        <div class="link-icon">
                            <i class="fa-solid fa-box-archive icon-color"></i><a
                                class="link {{ request()->is('todo/task') ? 'active' : '' }} "
                                href="{{ route('task.index') }}">All</a>
                        </div>

                        <div class="link-icon">
                            <i class="fa-solid fa-calendar-days icon-color"></i><a
                                class="link {{ request()->is('filter/today-tasks') ? 'active' : '' }}"
                                href="{{ route('filter.today') }}">Today</a>
                        </div>
                        <div class="link-icon">
                            <i class="fa-solid fa-circle-exclamation icon-color"></i><a
                                class="link {{ request()->is('filter/expired') ? 'active' : '' }}"
                                href="{{ route('filter.expired') }}">Overdue</a>
                        </div>
                        <div class="link-icon">
                            <i class="fa-solid fa-clock icon-color"></i><a
                                class="link {{ request()->is('filter/planned') ? 'active' : '' }}"
                                href="{{ route('filter.planned') }}">Scheduled</a>
                        </div>
                        <div class="link-icon">
                            <i class="fa-regular fa-circle icon-color"></i><a
                                class="link {{ request()->is('filter/pending') ? 'active' : '' }}"
                                href="{{ route('filter.pending') }}">Pending</a>
                        </div>
                        <div class="link-icon">
                            <i class="fa-solid fa-circle-check icon-color"></i><a
                                class="link {{ request()->is('filter/completed') ? 'active' : '' }}"
                                href="{{ route('filter.completed') }}">Complete</a>
                        </div>
                        <div class="link-icon">
                            <i class="fa-solid fa-recycle icon-color"></i><a
                                class="link {{ request()->is('filter/recycle') ? 'nav-item active' : '' }}"
                                href="{{ route('filter.recycle') }}">Corbeille</a>
                        </div>
                    </div>
                    <div>
                        <a class="btn btn-success {{ request()->is('todo/task/create') ? 'active' : '' }}"
                            href="{{ route('task.create') }}"><i class="fa-solid fa-add"></i>Create a Todo</a>
                    </div>
                </div>
            </div>

            <div class="col-10 list-of-todo">
                @if (session('success'))
                    <div class="alert-dismissible alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
                {{--            @dump(request()->is('filter/today-tasks')) --}}
            </div>
        </section>
    </main>
</body>

</html>

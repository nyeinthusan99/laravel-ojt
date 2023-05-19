<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }} ">
    <script src="{{ asset('app.js') }}"></script>
</head>

<body>

    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="">
                   Laravel
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @auth
                        @if (auth()->user()->type == 0)
                        <li class="nav-item">
                            <a href="{{ route('userlist') }}" class="nav-link">
                                Users
                            </a>
                        </li>
                        @endif
                        {{-- <li class="nav-item">
                            <a href="" class="nav-link">
                                User
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('postlist')}}" class="nav-link">
                                Posts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.profile') }}" class="nav-link">
                                {{ auth()->user()->name }}
                             </a>
                        </li>
                        <li class="nav-item">
                            <form action="/user/logout" method="POST">
                                @csrf
                                    <button href="" class="nav-link btn btn-link" type="submit">
                                        Logout
                                    </button>
                            </form>
                        </li>
                        @endauth
                    </ul>
            </div>
    </div>
    </nav>



    @yield('content')
    </div>


</body>

</html>

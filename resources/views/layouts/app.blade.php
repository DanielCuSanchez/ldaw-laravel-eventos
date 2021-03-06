<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - Eventos</title>
    @stack('styles')

    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid ">
            <a class="navbar-brand" href="/">Eventos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="row d-flex justify-content-end">
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('mi-perfil') }}" class="nav-link">
                                    {{ auth()->user()->name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('login.destroy') }}" class="nav-link">
                                    Cerrar sesión
                                </a>
                            </li>
                        @endauth

                        @guest
                            <li class="nav-item">
                                <a href="{{ route('login.index') }}" class="nav-link">
                                    Iniciar sesión
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register.index') }}" class="nav-link">
                                    Registro
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        < script src = "https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity = "sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin = "anonymous" >
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>

</html>

<!doctype html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>WheelyGoodCars</title>
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
        @livewireStyles
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

    </head>
    <body>
        @livewireScripts
        <nav class="navbar navbar-expand-md navbar-dark d-print-none bg-black">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}"><strong class="text-primary">Wheely</strong> good cars<strong class="text-primary">!</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">


                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('cars.public') }}">Auto's te Koop</a></li>

                            @auth
                                <li class="nav-item"><a class="nav-link text-light" href="{{ route('cars.create') }}">Aanbod plaatsen</a></li>
                                <li class="nav-item"><a class="nav-link text-light" href="{{ route('cars.index') }}">Mijn aanbod</a></li>






                            @endauth
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        @guest
                           {{-- <li class="nav-item"><a class="nav-link text-secondary"   href="{{ route('register') }}">Registreren</a></li> --}}
                            <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('login') }}">Inloggen</a></li>
                        @endguest
                        @auth
                            <li class="nav-item"><a class="nav-link text-secondary"   href="{{ route('logout') }}">Uitloggen</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>
        <footer class="footer">

            <div class="contact">
                <h5>Contact</h5>
                <p>tele:123-456-7890</p>
                <p>Mail:email@example.com</p>
            </div>
            <ul class="social-links">
                <h5>Social media links</h5>
                <li><a href="https://www.facebook.com/WheelyGoodCars" target="_blank">Facebook</a></li>
                <li><a href="https://twitter.com/WheelyGoodCars" target="_blank">Twitter</a></li>
                <li><a href="https://www.instagram.com/WheelyGoodCars" target="_blank">Instagram</a></li>
                <li><a href="https://www.linkedin.com/company/WheelyGoodCars" target="_blank">LinkedIn</a></li>
            </ul>
            <div class="contact">
                <h5>Contact</h5>
                <p>tele:123-456-7890</p>
                <p>Mail:email@example.com</p>
            </div>



        </footer>

    </body>
</html>

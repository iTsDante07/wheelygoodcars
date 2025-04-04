@extends('layouts.app')
@section('content')

    <div class="welkom1">
        <h1>Welkom bij WheelyGoodCars, hét platform om jouw auto snel en eenvoudig te verkopen!</h1>
    </div>

    <div class="welkom">
        <h2>Word vandaag nog lid en verkoop je auto moeiteloos!</h2>
        <p>
            Sluit je aan bij ons platform en bereik duizenden potentiële kopers.
            Meld je gratis aan en begin direct met het aanbieden van auto's.
            Geen gedoe, simpel en snel!
        </p>
        <ul>
            <li>✔ Gratis registratie</li>
            <li>✔ Bereik een groot publiek</li>
            <li>✔ PDF downloaden per auto</li>

            <li>✔ Eenvoudig jouw auto plaatsen</li>
            <li>✔ Veilig en betrouwbaar platform</li>
        </ul>
        <li class="nav-item">
            <a class="register" href="{{ route('register') }}">
                Nu registreren en starten
            </a>
        </li>
    </div>


@endsection

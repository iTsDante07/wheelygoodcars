@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Details van de auto</h1>
    <p><i class="fas fa-industry"></i><strong> Merk:</strong> {{ $car->brand }} {{ $car->model }}</p>
    <p><i class="fas fa-camera"></i><strong> Afbeelding:</strong> <img src="{{ $car->image }}" style="max-width: 100%; height: auto;"></p>

    <div class="kenteken12">
        <div class="inset">
            <div class="blue">
                <h1>NL</h1>
            </div>
            <p><strong></strong> <span class="kenteken-text">{{ $car->license_plate }}</span></p>
        </div>
    </div>

    <p><i class="fas fa-euro-sign"></i> <strong>Prijs:</strong> {{ $car->price }} €</p>
    <p><i class="fas fa-road"></i> <strong>Kilometerstand:</strong> {{ $car->mileage }} km</p>
    <p><i class="fas fa-chair"></i> <strong>Aantal Zitplaatsen:</strong> {{ $car->seats ?? 'N/A' }}</p>
    <p><i class="fas fa-car-side"></i> <strong>Aantal Deuren:</strong> {{ $car->doors ?? 'N/A' }}</p>
    <p><i class="fas fa-calendar-alt"></i> <strong>Productiejaar:</strong> {{ $car->production_year ?? 'N/A' }}</p>
    <p><i class="fas fa-weight"></i> <strong>Gewicht:</strong> {{ $car->weight ?? 'N/A' }} kg</p>
    <p><i class="fas fa-palette"></i> <strong>Kleur:</strong> {{ $car->color ?? 'N/A' }}</p>
    <p><i class="fas fa-eye"></i> <strong>Aantal Weergaven:</strong> {{ $car->views }}</p>

    <!-- Tags weergave -->


    @if(auth()->check() && auth()->id() === $car->user_id)
        <a href="{{ route('cars.pdf', $car->id) }}" class="btn btn-secondary">
            <i class="fas fa-file-pdf"></i> PDF Downloaden
        </a>
    @endif

    @guest
        <a href="{{ route('cars.public') }}" class="btn btn-primary">Terug naar Auto's te Koop</a>
    @endguest
</div>

<!-- Bootstrap Toast Popup met aangepaste styling, alleen zichtbaar voor de eigenaar -->
@if($isOwner)
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <div id="viewToast" class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true" style="width: 300px; font-size: 16px; padding: 15px;">
            <div class="d-flex">
                <div class="toast-body">
                    🚗 <strong>{{ $car->views ?? 100 }}</strong> klanten hebben deze auto vandaag bekeken!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function() {
                let toast = new bootstrap.Toast(document.getElementById('viewToast'));
                toast.show();
            }, 1000);
        });
    </script>
@endif

@endsection

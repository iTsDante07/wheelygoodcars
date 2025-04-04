@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4"><i class="fas fa-car"></i> Alle Auto's</h1>

    <div class="grid-container">
        @foreach($cars as $index => $car)
            <div class="car-item">
                <div class="car-header">
                    <h3>{{ $car->brand }} {{ $car->model }}</h3>
                </div>

                @if($car->image)
                <div class="car-image-wrapper">
                    <img src="{{ asset('storage/' . $car->image) }}" class="car-image" alt="{{ $car->brand }} {{ $car->model }}">
                </div>
                @else
                <p class="no-image"><i class="fas fa-image"></i> Geen afbeelding beschikbaar</p>
                @endif

                <div class="car-info">
                    <p><i class="fas fa-euro-sign"></i> <strong>Prijs:</strong> €{{ number_format($car->price, 2) }}</p>
                    <p><i class="fas fa-eye"></i> <strong>Aantal Weergaven:</strong> {{ $car->views }}</p>
                </div>

                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary"><i class="fas fa-info-circle"></i> Bekijk details</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
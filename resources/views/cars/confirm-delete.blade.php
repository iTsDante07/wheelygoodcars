@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Weet je zeker dat je deze auto wilt verwijderen?</h1>

    <p><strong>Merk:</strong> {{ $car->brand }}</p>
    <p><strong>Model:</strong> {{ $car->model }}</p>
    <p><strong>Kenteken:</strong> {{ $car->license_plate }}</p>

    <form action="{{ route('cars.destroy', $car) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Ja, verwijder deze auto</button>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
@endsection

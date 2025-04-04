@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Auto Bewerken</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('cars.update', $car) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group kenteken-group">
            <label for="license_plate"><i class="fas fa-car"></i> Kenteken</label>
            <div class="kenteken">
                <div class="inset">
                    <div class="blue">
                        <h1>NL</h1>
                    </div>
                    <input type="text" class="form-control" id="license_plate" name="license_plate" value="{{ $car->license_plate }}" maxlength="6" placeholder="XP-004-T" required/>
                </div>
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="brand"><i class="fas fa-industry"></i> Merk</label>
                <input type="text" class="form-control" id="brand" name="brand" value="{{ $car->brand }}" required readonly>
            </div>
            <div class="form-group">
                <label for="model"><i class="fas fa-car"></i> Model</label>
                <input type="text" class="form-control" id="model" name="model" value="{{ $car->model }}" required readonly>
            </div>
            <div class="form-group">
                <label for="price"><i class="fas fa-euro-sign"></i> Prijs</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $car->price }}" required>
            </div>
            <div class="form-group">
                <label for="mileage"><i class="fas fa-road"></i> Kilometerstand</label>
                <input type="number" class="form-control" id="mileage" name="mileage" value="{{ $car->mileage }}" required>
            </div>
            <div class="form-group">
                <label for="seats"><i class="fas fa-chair"></i> Aantal Zitplaatsen</label>
                <input type="number" class="form-control" id="seats" name="seats" value="{{ $car->seats }}" required readonly>
            </div>
            <div class="form-group">
                <label for="doors"><i class="fas fa-car-side"></i> Aantal Deuren</label>
                <input type="number" class="form-control" id="doors" name="doors" value="{{ $car->doors }}" required readonly>
            </div>
            <div class="form-group">
                <label for="production_year"><i class="fas fa-calendar-alt"></i> Productiejaar</label>
                <input type="number" class="form-control" id="production_year" name="production_year" value="{{ $car->production_year }}" required readonly>
            </div>
            <div class="form-group">
                <label for="weight"><i class="fas fa-weight"></i> Gewicht</label>
                <input type="number" class="form-control" id="weight" name="weight" value="{{ $car->weight }}" required readonly>
            </div>
            <div class="form-group">
                <label for="color"><i class="fas fa-palette"></i> Kleur</label>
                <input type="text" class="form-control" id="color" name="color" value="{{ $car->color }}" required readonly>
            </div>
            <div class="form-group">
                <label for="image"><i class="fas fa-camera"></i> Afbeelding</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
                @livewire('status-updater', ['car' => $car])


        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Bijwerken</button>
    </form>
</div>
@endsection

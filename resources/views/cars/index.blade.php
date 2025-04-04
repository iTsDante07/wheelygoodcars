@extends('layouts.app')

@section('content')
<div class="container">
    <h1><i class="fas fa-car"></i> Mijn Auto's</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="parent1">
        @forelse($cars as $index => $car)
            <div class="car1">
                <div class="Merk">
                    <h3></i> {{ $car->brand }} {{ $car->model }}</h3>
                </div>
                <div class="kenteken1">
                    <div class="inset">
                        <div class="blue">
                            <h1>NL</h1>
                        </div>
                        <p><strong></strong> <span class="kenteken-text">{{ $car->license_plate }}</span></p>
                    </div>
                </div>

                <div class="knopen">
                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info"><i class="fas fa-info-circle"></i> </a>{{--Details--}}

                    <form action="{{ route('cars.confirmDelete', $car->id) }}" method="GET">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button> {{--Verwijderen--}}
                    </form>
                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> </a>{{--Bewerken--}}
                </div>
            </div>
        @empty
            <p><i class="fas fa-exclamation-circle"></i> Je hebt nog geen auto's toegevoegd.</p>
        @endforelse
    </div>
</div>
@endsection
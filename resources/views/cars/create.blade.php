@extends('layouts.app')

@section('content')
<div class="container">
    <h1><i class="fas fa-car"></i> Nieuwe Auto Toevoegen</h1>
    <form id="carForm" action="{{ route('cars.store') }}" method="POST">
        @csrf

        <div class="kenteken">
            <div class="inset">
                <div class="blue">
                    <h1>NL</h1>
                </div>
                <input type="text" class="form-control" id="license_plate" name="license_plate" maxlength="6" placeholder="XP-004-T" />
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="brand"><i class="fas fa-industry"></i> Merk</label>
                <input type="text" class="form-control" id="brand" name="brand" required readonly>
            </div>
            <div class="form-group">
                <label for="model"><i class="fas fa-car"></i> Model</label>
                <input type="text" class="form-control" id="model" name="model" required readonly>
            </div>
            <div class="form-group">
                <label for="price"><i class="fas fa-euro-sign"></i> Prijs</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="mileage"><i class="fas fa-road"></i> Kilometerstand</label>
                <input type="number" class="form-control" id="mileage" name="mileage" required>
            </div>
            <div class="form-group">
                <label for="seats"><i class="fas fa-chair"></i> Aantal Zitplaatsen</label>
                <input type="number" class="form-control" id="seats" name="seats" required readonly>
            </div>
            <div class="form-group">
                <label for="doors"><i class="fas fa-car-side"></i> Aantal Deuren</label>
                <input type="number" class="form-control" id="doors" name="doors" required readonly>
            </div>
            <div class="form-group">
                <label for="production_year"><i class="fas fa-calendar-alt"></i> Productiejaar</label>
                <input type="number" class="form-control" id="production_year" name="production_year" required readonly>
            </div>
            <div class="form-group">
                <label for="weight"><i class="fas fa-weight"></i> Gewicht</label>
                <input type="number" class="form-control" id="weight" name="weight" required readonly>
            </div>
            <div class="form-group">
                <label for="color"><i class="fas fa-palette"></i> Kleur</label>
                <input type="text" class="form-control" id="color" name="color" required readonly>
            </div>
            <div class="form-group">
                <label for="image"><i class="fas fa-camera"></i> Afbeelding (Optioneel)</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Opslaan</button>
    </form>
</div>

<script>
    document.getElementById('license_plate').addEventListener('input', function() {
        var kenteken = this.value;
        if (kenteken.length >= 6) {
            fetch(`/api/car-info?kenteken=${kenteken}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        document.getElementById('brand').value = data[0].merk || '';
                        document.getElementById('model').value = data[0].handelsbenaming || '';
                        document.getElementById('price').value = '';
                        document.getElementById('mileage').value = data[0].meterstand || '';
                        document.getElementById('seats').value = data[0].aantal_zitplaatsen || '';
                        document.getElementById('doors').value = data[0].aantal_deuren || '';
                        var productiejaar = data[0].datum_eerste_toelating;
                        document.getElementById('production_year').value = productiejaar ? productiejaar.toString().slice(0, 4) : '';
                        document.getElementById('weight').value = data[0].massa_rijklaar || '';
                        document.getElementById('color').value = data[0].eerste_kleur || '';
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    });
</script>

@endsection

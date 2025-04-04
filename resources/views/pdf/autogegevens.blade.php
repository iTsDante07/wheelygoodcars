<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Auto Gegevens</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; text-align: left; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <div class="pdf-p">
        <p><strong><span style="color: #ff7700;">Wheely</span> good cars<span style="color: #ff7700;">!</strong></p>

    </div>

    <h1>Auto Gegevens</h1>
    <table>
        <tr><th>Merk</th><td>{{ $car->brand }}</td></tr>
        <tr><th>Model</th><td>{{ $car->model }}</td></tr>
        <tr><th>Bouwjaar</th><td>{{ $car->production_year ?? 'Onbekend' }}</td></tr>
        <tr><th>Kleur</th><td>{{ $car->color ?? 'Onbekend' }}</td></tr>
        <tr><th>Prijs</th><td>€ {{ number_format($car->price, 2, ',', '.') }}</td></tr>
        <tr><th>Kenteken</th><td>{{ $car->license_plate }}</td></tr>
        <tr><th>Kilometerstand</th><td>{{ number_format($car->mileage, 0, ',', '.') }} km</td></tr>
        <tr><th>Aantal Zitplaatsen</th><td>{{ $car->seats ?? 'Onbekend' }}</td></tr>
        <tr><th>Aantal Deuren</th><td>{{ $car->doors ?? 'Onbekend' }}</td></tr>
        <tr><th>Gewicht</th><td>{{ $car->weight ? $car->weight . ' kg' : 'Onbekend' }}</td></tr>
        <tr><th>Tags</th>
        </tr>
        @if($car->image)
            <tr>
                <th>Afbeelding</th>
                <td><img src="{{ public_path('storage/app/public/cars' . $car->image) }}" width="200"></td>
            </tr>
        @endif
    </table>
</body>
</html>

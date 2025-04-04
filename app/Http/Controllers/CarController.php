<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use GuzzleHttp\Client;

class CarController extends Controller
{
    public function create()
    {
        return view('cars.create');
    }

    // Auto opslaan in de database
    public function store(Request $request)
    {
        // Haal het kenteken op uit de invoer en zet het om naar hoofdletters
        $license_plate = strtoupper($request->input('license_plate'));
        $license_plate = preg_replace('/[^A-Z0-9]/', '', $license_plate);
        $formatted_license_plate = implode('-', str_split($license_plate, 2));

        // Merge het kenteken naar het request
        $request->merge(['license_plate' => $formatted_license_plate]);

        // Validatie
        $validated = $request->validate([
            'license_plate' => [
                'required',
                'string',
                'max:8',
                'regex:/^[A-Z0-9]{2}-[A-Z0-9]{2}-[A-Z0-9]{2}$/',
                'unique:cars',
            ],
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'seats' => 'nullable|integer',
            'doors' => 'nullable|integer',
            'production_year' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'color' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048', // Zorg voor een maximale bestandsgrootte van 2MB voor de afbeelding
            'views' => 'nullable|integer',
        ]);

        // Sla de afbeelding op, indien aanwezig
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('car_images', 'public');
        }

        // Maak de auto aan
        $car = Car::create([
            'user_id' => Auth::id(),
            'license_plate' => $validated['license_plate'],
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'price' => $validated['price'],
            'mileage' => $validated['mileage'],
            'seats' => $validated['seats'],
            'doors' => $validated['doors'],
            'production_year' => $validated['production_year'],
            'weight' => $validated['weight'],
            'color' => $validated['color'],
            'image' => $imagePath,  // Voeg het pad van de afbeelding toe
            'views' => $validated['views'] ?? 0,
        ]);

        // Redirect met succesmelding
        return redirect()->route('cars.index')->with('success', 'Auto succesvol aangemaakt!');
    }


    public function index()
    {
        if (Auth::check()) {
            $cars = Auth::user()->cars;
        } else {
            $cars = [];
        }

        return view('cars.index', compact('cars'));
    }

    public function show(Car $car)
    {
        // Verhoog het aantal views met 1 bij elk bezoek
        $car->increment('views');

        // Controleer of de ingelogde gebruiker de eigenaar van de auto is
        $isOwner = Auth::check() && Auth::id() === $car->user_id;

        return view('cars.show', compact('car', 'isOwner'));
    }

    public function destroy(Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            return redirect()->route('cars.index')->with('error', 'Je mag deze auto niet verwijderen.');
        }

        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Auto succesvol verwijderd!');
    }

    public function confirmDelete($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.confirm-delete', compact('car'));
    }

    public function edit(Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            return redirect()->route('cars.index')->with('error', 'Je mag deze auto niet bewerken.');
        }

        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        // Controleer of de ingelogde gebruiker de eigenaar is
        if ($car->user_id !== Auth::id()) {
            return redirect()->route('cars.index')->with('error', 'Je mag deze auto niet bewerken.');
        }

        // Valideer de ingevoerde gegevens
        $validated = $request->validate([
            'license_plate' => 'required|string|max:10|unique:cars,license_plate,' . $car->id,
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'seats' => 'nullable|integer',
            'doors' => 'nullable|integer',
            'production_year' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'color' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:255',
            'views' => 'nullable|integer',
        ]);

        // Werk de auto bij met de nieuwe gegevens
        $car->update([
            'license_plate' => $validated['license_plate'],
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'price' => $validated['price'],
            'mileage' => $validated['mileage'],
            'seats' => $validated['seats'],
            'doors' => $validated['doors'],
            'production_year' => $validated['production_year'],
            'weight' => $validated['weight'],
            'color' => $validated['color'],
            'image' => $validated['image'],
            'views' => $validated['views'] ?? 0,
        ]);

        // Redirect naar de lijst van auto's
        return redirect()->route('cars.index')->with('success', 'Auto succesvol bijgewerkt!');
    }

    public function public()
    {
        // Haal alle auto's op van alle gebruikers
        $cars = Car::all();

        return view('cars.public', compact('cars'));
    }

    public function getCarInfoFromRDW(Request $request)
    {
        $kenteken = strtoupper(str_replace('-', '', $request->input('kenteken')));

        if (!$kenteken) {
            return response()->json(['error' => 'Kenteken is vereist'], 400);
        }

        $apiUrl = "https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken={$kenteken}";
        $appToken = env('RDW_APP_TOKEN');

        $client = new Client();

        try {
            $response = $client->get($apiUrl, [
                'headers' => [
                    'X-App-Token' => $appToken
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (empty($data)) {
                return response()->json(['error' => 'Geen gegevens gevonden voor dit kenteken.'], 404);
            }

            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Fout bij het ophalen van gegevens: ' . $e->getMessage()], 500);
        }
    }
}
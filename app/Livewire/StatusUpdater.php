<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;

class StatusUpdater extends Component
{
    public $car;
    public $price;
    public $status;

    // Haal de auto op wanneer de component wordt geladen
    public function mount(Car $car)
    {
        $this->car = $car;
        $this->price = $car->price;
        $this->status = $car->sold_at ? 'verkocht' : 'beschikbaar';
    }

    // Functie om de status bij te werken
    public function updateStatus()
    {
        if ($this->status === 'verkocht') {
            $this->car->sold_at = now();
        } else {
            $this->car->sold_at = null;
        }
        $this->car->save();
        $this->emit('Updated'); // Event uit zenden voor bijvoorbeeld live update
    }

    // Functie om de vraagprijs bij te werken
    public function updatePrice()
    {
        $this->car->price = $this->price;
        $this->car->save();
    }

    public function render()
    {
        return view('livewire.status-updater');
    }
}

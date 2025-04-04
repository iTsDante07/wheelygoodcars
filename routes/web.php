<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|                @livewire('status-updater', ['car' => $car])


*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    //
});

require __DIR__.'/auth.php';


    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');

    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');

    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');

    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');

    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');

    Route::get('/public-cars', [CarController::class, 'public'])->name('cars.public');

    use App\Http\Controllers\PdfController;

    Route::get('/download-pdf/{id}', [PdfController::class, 'generatePdf'])->name('cars.pdf');
    // Route naar bevestigingspagina (bijvoorbeeld in je routes/web.php)
    Route::get('/cars/{car}/confirm-delete', [CarController::class, 'confirmDelete'])->name('cars.confirmDelete');

    Route::get('/api/get-car-info/{kenteken}', [CarController::class, 'getCarInfo']);
    Route::resource('cars', CarController::class);

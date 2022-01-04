<?php

use App\Http\Controllers\DashboardController;
use App\Http\Livewire\BeneficiosEntregados;
use App\Http\Livewire\BeneficiosEntregadosReportes;
use App\Http\Livewire\BeneficiosOtorgadosReporte;
use App\Http\Livewire\Categorias;
use App\Http\Livewire\Comunas;
use App\Http\Livewire\ConsejosComunales;
use App\Http\Livewire\Eventos;
use App\Http\Livewire\LideresMunicipio;
use App\Http\Livewire\LideresSociales;
use App\Http\Livewire\MunicipioNecesidad;
use App\Http\Livewire\Municipios;
use App\Http\Livewire\Parroquias;
use App\Http\Livewire\Secretarias;
use App\Http\Livewire\Subcategorias;
use App\Http\Livewire\Ubches;
//use App\Models\Categoria;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* TOMAR EN CUENTAAAAAAAAAAAAAAAA
Para proteger grupos de rutas....
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get(/categorias, Categoria::class);
    Route::get(/dashboard, function(){
        return view('dashboard');
    })->name('dashboard');



*/
Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/categorias', Categorias::class)->name('categorias');
Route::middleware(['auth:sanctum', 'verified'])->get('/subcategorias', Subcategorias::class)->name('subcategorias');
Route::middleware(['auth:sanctum', 'verified'])->get('/municipios', Municipios::class)->name('municipios');
Route::middleware(['auth:sanctum', 'verified'])->get('/parroquias', Parroquias::class)->name('parroquias');
Route::middleware(['auth:sanctum', 'verified'])->get('/ubch', Ubches::class)->name('ubch');
Route::middleware(['auth:sanctum', 'verified'])->get('/comunas', Comunas::class)->name('comunas');
Route::middleware(['auth:sanctum', 'verified'])->get('/consejos-comunales', ConsejosComunales::class)->name('consejos-comunales');
Route::middleware(['auth:sanctum', 'verified'])->get('/lideres-sociales', LideresSociales::class)->name('lideres-sociales');
Route::middleware(['auth:sanctum', 'verified'])->get('/beneficios-otorgados', BeneficiosOtorgadosReporte::class)->name('beneficios-otorgados');
Route::middleware(['auth:sanctum', 'verified'])->get('/lideres-municipios', LideresMunicipio::class)->name('lideres-municipios');
Route::middleware(['auth:sanctum', 'verified'])->get('/municipio-necesidad', MunicipioNecesidad::class)->name('municipio-necesidad');
Route::middleware(['auth:sanctum', 'verified'])->get('/secretarias', Secretarias::class)->name('secretarias');
Route::middleware(['auth:sanctum', 'verified'])->get('/eventos', Eventos::class)->name('eventos');
Route::middleware(['auth:sanctum', 'verified'])->get('/beneficios-entregados-reportes', BeneficiosEntregadosReportes::class)->name('beneficios-entregados-reportes');
Route::middleware(['auth:sanctum', 'verified'])->get('/beneficios-entregados', BeneficiosEntregados::class)->name('beneficios-entregados');

<?php

use App\Http\Controllers\Livewire\Dashboard\Index as Dashboard;

use App\Http\Controllers\Livewire\Admin\Providers\Create as ProvidersCreate;
use App\Http\Controllers\Livewire\Admin\Providers\Edit as ProvidersEdit;
use App\Http\Controllers\Livewire\Admin\Providers\Index as ProvidersIndex;

use App\Http\Controllers\Livewire\Admin\Countries\Create as CountriesCreate;
use App\Http\Controllers\Livewire\Admin\Countries\Edit as CountriesEdit;
use App\Http\Controllers\Livewire\Admin\Countries\Index as CountriesIndex;

use App\Http\Controllers\Livewire\Admin\Cities\Create as CitiesCreate;
use App\Http\Controllers\Livewire\Admin\Cities\Edit as CitiesEdit;
use App\Http\Controllers\Livewire\Admin\Cities\Index as CitiesIndex;

use App\Http\Controllers\Livewire\Jobs\Index as JobsIndex;
use App\Http\Controllers\Livewire\Tenders\Index as TendersIndex;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', JobsIndex::class)->name('jobs.index');

Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tenders', TendersIndex::class)->name('tenders.index');
    Route::get('/jobs', JobsIndex::class)->name('jobs.index');

    Route::get('/providers', ProvidersIndex::class)->name('admin.providers.index');
    Route::get('/providers/create', ProvidersCreate::class)->name('admin.providers.create');
    Route::get('/providers/{slug}/edit', ProvidersEdit::class)->name('admin.providers.edit');

    Route::get('/countries', CountriesIndex::class)->name('admin.countries.index');
    Route::get('/countries/create', CountriesCreate::class)->name('admin.countries.create');
    Route::get('/countries/{slug}/edit', CountriesEdit::class)->name('admin.countries.edit');

    Route::get('/cities', CitiesIndex::class)->name('admin.cities.index');
    Route::get('/cities/create', CitiesCreate::class)->name('admin.cities.create');
    Route::get('/cities/{slug}/edit', CitiesEdit::class)->name('admin.cities.edit');
});

Route::get('/test', function(){
   echo "testd";
});
require __DIR__.'/auth.php';

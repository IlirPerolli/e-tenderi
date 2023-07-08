<?php

use App\Http\Controllers\Livewire\Admin\Companies\Create as CompaniesCreate;
use App\Http\Controllers\Livewire\Admin\Companies\Edit as CompaniesEdit;
use App\Http\Controllers\Livewire\Admin\Companies\Index as CompaniesIndex;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tenders', TendersIndex::class)->name('tenders.index');
    Route::get('/companies', CompaniesIndex::class)->name('admin.companies.index');
    Route::get('/companies/create', CompaniesCreate::class)->name('admin.companies.create');
    Route::get('/companies/{slug}/edit', CompaniesEdit::class)->name('admin.companies.edit');
});


require __DIR__.'/auth.php';

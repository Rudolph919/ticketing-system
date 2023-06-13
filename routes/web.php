<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\FileManipulationController;

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [TicketController::class, 'index'])
    ->name('home')
    ->middleware(['auth', 'redirect.authenticated']);

Route::resource('tickets', TicketController::class);

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

Route::get('/reports/search', [ReportController::class, 'search'])->name('reports.search');

Route::get('/query', [QueryController::class, 'index'])->name('query.index');
Route::get('/animal-lovers', [QueryController::class, 'animalLovers'])->name('query.animal-lovers');
Route::get('/children-sport-lovers', [QueryController::class, 'childrenSportLovers'])->name('query.children-sport-lovers');
Route::get('/unique-interests-without-documents', [QueryController::class, 'uniqueInterestWithoutDocuments'])->name('query.unique-interests-without-documents');
Route::get('/people-with-multiple-documents', [QueryController::class, 'peopleWithMultipleDocuments'])->name('query.people-with-multiple-documents');

Route::get('/file-manipulation', [FileManipulationController::class, 'index'])->name('file.index');
Route::post('/file-manipulation', [FileManipulationController::class, 'upload'])->name('file.upload');

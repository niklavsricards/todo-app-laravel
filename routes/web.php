<?php

use App\Http\Controllers\ToDoItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('todoitems', ToDoItemController::class);

Route::post('/todoitems/{todoitem}/complete', [ToDoItemController::class, 'complete'])
    ->middleware('auth')
    ->name('todoitems.complete');

require __DIR__.'/auth.php';

<?php

use App\Livewire\ContactsIndex;
use App\Livewire\ContactsModal;
use App\Livewire\Modal;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\EnviarCorreo;

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

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('contacts',ContactsIndex::class)
->middleware(['auth'])
->name('contacts');

Route::get('enviar',function () {
    Mail::to('thiagomeseg@gmail.com')->send(new EnviarCorreo('Markito'));
});

Route::view('modal', 'livewire.modal');
    
require __DIR__.'/auth.php';

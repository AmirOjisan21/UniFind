<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\KsasController;
use App\Http\Controllers\KsajsController;
use App\Http\Controllers\EventsController;
use App\Models\Ksas;
use App\Models\Ksajs;
use App\Models\Events;

// use Illuminate\Http\Request;

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
})->name('welcome');
Route::get('/location/{id}', function (Request $request) {
    $ksas = Ksas::find($request->id);
    return view('location', compact('ksas'));
})->name('location');
Route::get('/navigation/{ksas}', function (Ksas $ksas) {
    return view('navigation', compact('ksas'));
})->name('navigation');

Route::get('/ksajslocation/{id}', function (Request $request) {
    $ksajs = Ksajs::find($request->id);
    return view('ksajslocation', compact('ksajs'));
})->name('ksajslocation');
Route::get('/ksajsnav/{ksajs}', function (Ksajs $ksajs) {
    return view('ksajsnav', compact('ksajs'));
})->name('ksajsnav');

Route::get('/eventlocation/{id}', function (Request $request) {
    $event = events::find($request->id);
    return view('eventlocation', compact('event'));
})->name('eventlocation');
Route::get('/eventnav/{event}', function (Events $event) {
    return view('eventnav', compact('event'));
})->name('eventnav');

Route::get('/login', function () {
    return view('login');
})->name('auth.login');
// ni ke?
Route::get('/register', function () {
    return view('register');
})->name('auth.register');
Route::get('/register2', function () {
    return view('auth.register');
})->name('register2');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'admin'], function () {
    Route::resource('ksas', KsasController::class)->names('ksas');
    Route::resource('ksajs', KsajsController::class)->names('ksajs');
    Route::resource('events', EventsController::class)->names('events');
});

// tak, lain gilak route dia haa
Route::get('/ksaspub', function () {
    $ksass = Ksas::all();
    return view('ksaspub', compact('ksass'));
})->name('ksaspub');

Route::get('/ksajs', function () {
    $ksajss = Ksajs::all();
    return view('ksajs', compact('ksajss'));
})->name('ksajs');

Route::get('/events', function () {
    $events = events::all();
    $cevents = EventsController::createCalendarEvents($events);
    return view('events', compact('events', 'cevents'));
})->name('events');


require __DIR__.'/auth.php';

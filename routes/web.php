<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceRequestController;

Route::get('/', function () {
    $workflow = [
        ['name' => 'Plan',    'tool' => 'README / Documentation', 'security' => 'No credentials in docs'],
        ['name' => 'Code',    'tool' => 'Laravel, Composer',      'security' => '.env kept local'],
        ['name' => 'Build',   'tool' => 'Artisan migrate',        'security' => 'Local testing only'],
        ['name' => 'Version', 'tool' => 'Git',                    'security' => '.gitignore excludes .env'],
        ['name' => 'Review',  'tool' => 'Pull requests',          'security' => 'Peer approval before merge'],
        ['name' => 'Release', 'tool' => 'GitHub',                 'security' => 'Sanitized .env.example'],
        ['name' => 'Deploy',  'tool' => 'Hosting (optional)',     'security' => 'HTTPS, env variables'],
        ['name' => 'Monitor', 'tool' => 'Laravel logs',           'security' => 'Restricted log access'],
    ];
    return view('home', ['workflow' => $workflow]);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->get('/requests', fn () => 'Coming soon')->name('requests.index');
Route::middleware('auth')->get('/requests/create', fn () => 'Coming soon')->name('requests.create');

Route::middleware('auth')->group(function () {
    Route::get('/requests', [ServiceRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/create', [ServiceRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [ServiceRequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/{serviceRequest}', [ServiceRequestController::class, 'show'])
        ->whereNumber('serviceRequest')->name('requests.show');
    Route::patch('/requests/{serviceRequest}/status', [ServiceRequestController::class, 'updateStatus'])
        ->whereNumber('serviceRequest')->name('requests.status');
});
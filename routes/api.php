<?php

use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/new_message', [WhatsAppController::class, 'newMessage'])
    ->name('new_message');

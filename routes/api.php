<?php

use App\Http\Controllers\Developer\DeveloperController;
use Illuminate\Support\Facades\Route;

Route::get('/get-developers-with-uuid', [DeveloperController::class, 'index']);
Route::get('/get-developers-with-uuid-improvement', [DeveloperController::class, 'indexImproved']);

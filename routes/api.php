<?php

use App\Http\Controllers\Boilerplate\CandidateController;
use App\Http\Controllers\Boilerplate\InstituteController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/institute-list', [InstituteController::class, 'getInstituteList']);
Route::get('/candidate-list', [CandidateController::class, 'getCandidateListWithInstitutes']);



Route::post('/add-institute', [InstituteController::class, 'AddInstituteAPI']);
Route::post('/add-candidate', [CandidateController::class, 'AddCandidateAPI']);


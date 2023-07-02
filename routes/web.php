<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Boilerplate\Institute;

Route::get('/', function () {
    $institutes = Institute::where('status',1)->get();
    return view('add_candidate.candidate_create',[
        'institutes'=>$institutes
    ]);
});
Route::post('/create_candidate', 'Boilerplate\CandidateController@create_candidate')->name('add_candidate');

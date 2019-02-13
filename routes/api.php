<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->namespace('v1')->group(function(){
    Route::post('login/user','UsersController@login');
    Route::post('login/candidate','CandidatesController@login');
    Route::post('candidates','CandidatesController@store');
});


Route::middleware(['auth.admin'])->prefix('v1')->namespace('v1')->group(function(){
    Route::resource('jobs','JobsController');
    Route::resource('candidates','CandidatesController');
    Route::get('subscription/job/{job_id}','JobsController@getAllSubscriptionByJob');
});


Route::middleware(['auth.candidate'])->prefix('v1')->namespace('v1')->group(function(){
    Route::get('candidate','CandidatesController@showCandidate');
    Route::put('candidate','CandidatesController@updateCandidate');
    Route::post('subscription/job/{job_id}/candidate','JobsController@subscription');
    Route::get('subscription/candidate','CandidatesController@getAllSubscriptionByCandidates');
});



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

Route::middleware([])->prefix('v1')->namespace('v1')->group(function(){
    Route::resource('jobs','JobsController');
    Route::resource('candidates','CandidatesController');
    Route::post('subscription/job/{job_id}/candidate/{candidate_id}','JobsController@subscription');
});
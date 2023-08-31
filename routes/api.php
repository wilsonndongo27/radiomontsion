<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthAPI;
use App\Http\Controllers\Api\HomeAPI;
use App\Http\Controllers\Api\BannerAPI;
use App\Http\Controllers\Api\NewsAPI;
use App\Http\Controllers\Api\ProgramAPI;
use App\Http\Controllers\Api\PodcastAPI;
use App\Http\Controllers\Api\RadioAPI;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/auth', [AuthAPI::class, 'login']);
Route::post('/register', [AuthAPI::class, 'register']);

Route::group(['middleware' => 'auth:api'], function() {

    /**Banner */
    Route::get('home', [HomeAPI::class, 'index']);
    
    /**Banner */
    Route::get('banner', [BannerAPI::class, 'index']);

    /**News */
    Route::get('news', [NewsAPI::class, 'index']);

    /**Program */
    Route::get('program', [ProgramAPI::class, 'index']);

    /**Podcast */
    Route::get('podcast', [PodcastAPI::class, 'index']);
    Route::get('podcast-program/{program}/', [PodcastAPI::class, 'podcast_program']);

    /**Radio */
    Route::get('radio', [RadioAPI::class, 'index']);
});
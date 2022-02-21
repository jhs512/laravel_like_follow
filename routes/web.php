<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ReactionPointController;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('articles', ArticleController::class);

Route::prefix('reaction-points/')->middleware('auth')->group(function () {
    Route::post('good/{reactionPointableType}/{reactionPointableId}', [ReactionPointController::class, 'makeGood']); // 임시로 get, 원래는 post
    Route::delete('good/{reactionPointableType}/{reactionPointableId}', [ReactionPointController::class, 'cancelGood']);
    Route::post('bad/{reactionPointableType}/{reactionPointableId}', [ReactionPointController::class, 'makeBad']); // 임시로 get, 원래는 post
    Route::delete('bad/{reactionPointableType}/{reactionPointableId}', [ReactionPointController::class, 'cancelBad']);

    /*
    개발용
    */
    Route::get('make-good/{reactionPointableType}/{reactionPointableId}', [ReactionPointController::class, 'makeGood']); // 임시로 get, 원래는 post
    Route::get('cancel-good/{reactionPointableType}/{reactionPointableId}', [ReactionPointController::class, 'cancelGood']);
    Route::get('make-bad/{reactionPointableType}/{reactionPointableId}', [ReactionPointController::class, 'makeBad']); // 임시로 get, 원래는 post
    Route::get('cancel-bad/{reactionPointableType}/{reactionPointableId}', [ReactionPointController::class, 'cancelBad']);
});

Auth::routes();

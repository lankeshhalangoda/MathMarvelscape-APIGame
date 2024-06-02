<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

//Main
Route::get('/',[HomeController::class,'index'])->name('index');

Route::get('/game',[HomeController::class,'game'])->middleware(['auth', 'verified'])->name('home');

// Menu Items
Route::get('/start-game',[HomeController::class,'startGame'])->middleware(['auth', 'verified'])->name('start-game');
Route::get('/leader-board',[HomeController::class,'leaderBoard'])->middleware(['auth', 'verified'])->name('leader-board');
Route::get('/tutorial',[HomeController::class,'tutorial'])->middleware(['auth', 'verified'])->name('tutorial');
Route::get('/levels',[HomeController::class,'levels'])->middleware(['auth', 'verified'])->name('levels');

// Levels
Route::get('/level1',[HomeController::class,'level1'])->middleware(['auth', 'verified'])->name('level1');
Route::get('/level2',[HomeController::class,'level2'])->middleware(['auth', 'verified'])->name('level2');
Route::get('/level3',[HomeController::class,'level3'])->middleware(['auth', 'verified'])->name('level3');
Route::get('/level4',[HomeController::class,'level4'])->middleware(['auth', 'verified'])->name('level4');
Route::get('/level5',[HomeController::class,'level5'])->middleware(['auth', 'verified'])->name('level5');
Route::get('/level6',[HomeController::class,'level6'])->middleware(['auth', 'verified'])->name('level6');
Route::get('/level7',[HomeController::class,'level7'])->middleware(['auth', 'verified'])->name('level7');
Route::get('/level8',[HomeController::class,'level8'])->middleware(['auth', 'verified'])->name('level8');
Route::get('/level9',[HomeController::class,'level9'])->middleware(['auth', 'verified'])->name('level9');
Route::get('/level10',[HomeController::class,'level10'])->middleware(['auth', 'verified'])->name('level10');

Route::get('/get/question', [HomeController::class, 'getQuestions'])->middleware('cors')->name('get-question');

Route::post('/save-score', [HomeController::class, 'saveScore'])->middleware(['auth', 'verified'])->name('save-score');

Route::get('/get/leaderboard', [HomeController::class, 'getleaderboard'])->middleware(['auth', 'verified'])->name('get-leaderboard');

Route::get('/tomato/api', [HomeController::class, 'tomatoApi'])->name('tomato-api');
Route::get('/smile/api', [HomeController::class, 'smileApi'])->name('smile-api');

Route::get('/get/scores', [HomeController::class, 'getScores'])->name('get-scores');

Route::get(('/all/users'), [HomeController::class, 'allUsers'])->name('all-users');

// Route::delete('/delete/user/{id}', [HomeController::class, 'deleteUser'])->name('delete-user');

require __DIR__.'/auth.php';

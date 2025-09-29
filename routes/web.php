<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CandidatController;

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

//Route::get('/',[HomeController::class, 'index'])->name("home");


Route::resource('categorie', CategorieController::class);
Route::resource('candidat', CandidatController::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [HomeController::class,'allCandidat'])->name("vote");
Route::post('/voter', [HomeController::class,'voter'])->name("store.vote");

Route::post('/vote', [HomeController::class,'candidatByCategorie'])->name("candidatByCategorie");

Route::get('/liste/vote', [VoteController::class,'index'])->name("liste.vote");

Route::post('/rts', [HomeController::class,'rtsByCategorie'])->name("rtsByCategorie");

Route::post('/social-popup-seen', function () {
    session(['social_popup_seen' => true]);
    return response()->json(['status' => 'ok']);
})->name('social.popup.seen');

Route::get('/candidat/categorie/{id}', [HomeController::class,'candidatByCategorieId'])->name("candidatByCategorieId");



Route::get('/update/show/{id}', [CategorieController::class,'updateShow'])->name("updateShow");

Route::get('/voter', [HomeController::class,'allCandidat']);

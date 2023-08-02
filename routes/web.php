<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

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

//Route qui pointe vers la méthode index du controlleur ArticleController pour afficher la liste des articles
Route::get('/', [ArticleController::class, 'index'])->name('articles');
//Route qui pointe vers la méthode create du controlleur ArticleController pour afficher le formulaire d'enregistrement
Route::get('/create', [ArticleController::class, 'create'])->name('create');
//Route de type post qui pointe vers la méthode store du controlleur ArticleController effectuer l'enregistrement
Route::post('/article', [ArticleController::class, 'store'])->name('store');

Route::put('/article/{id}', [ArticleController::class, 'update'])->name('update');

Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('destroy');
//Route qui affiche un texte
Route::get('/hello', function() {
    return 'Hello world!';
});
//Route qui retourne un json
Route::get('/message', function() {
    return response()->json(['statut'=>200, 'message'=>'Message Json']);
});
//Route qui pointe vers la méthode show du controlleur ArticleController
//Cette route attend un paramètre {id} qui est une valeur dynamique
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('single');

Route::get('/edit/{id}', [ArticleController::class, 'edit'])->name('edit');
//Route attend deux paramètre : {debut} et {fin}
Route::get('/reservation/{debut}/{fin}', function($debut, $fin) {
    return 'Date début : '.$debut.' | Date fin : '.$fin;
});


Route::resource('comments', CommentController::class);


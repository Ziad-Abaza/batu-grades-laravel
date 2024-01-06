<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/', function () {
//         return view('welcome');
//     });
Route::controller(GradesController::class)->group(function(){
    // Route::post('uploadFile', 'uploadFile')->name('grades.uploadfile');
    Route::get('/', [GradesController::class, 'index']);
    Route::get('/upload', [GradesController::class, 'upload']);
    Route::post('/pages.upload', [GradesController::class, 'store'])->name('store.file');
    Route::post('/pages.grades',[GradesController::class,'show'])->name('view.grades');
});

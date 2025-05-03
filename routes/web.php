<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/form/{surveyId}', [SurveyController::class, 'show'])->name('surveys.show');
Route::post('/form/{surveyId}', [SurveyController::class, 'submit'])->name('surveys.submit');
Route::get('/finish', [SurveyController::class, 'finish'])->name('finish');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [SurveyController::class, 'index'])->name('survey.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('surveys', SurveyController::class); // Automatically handles CRUD (index, create, store, show, etc.)
    Route::get('/survey/add-question', [SurveyController::class, 'addQuestion'])->name('surveys.add-question');
    Route::get('/survey/{surveyId}/add-question', [QuestionController::class, 'addQuestion'])->name('questions.add-question');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/form/{surveyId}/statistic', [SurveyController::class, 'showStatistics'])->name('surveys.statistic');
});
require __DIR__ . '/auth.php';

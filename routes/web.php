<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
  LandingController, PagesController, DashboardController, CertificationController, ExamController, ResultController, QuestionImportController, EnsureAdmin
};
use App\Http\Controllers\Admin\{
  AdminController, UserAdminController, CertificationAdminController, DomainAdminController, TopicAdminController, QuestionAdminController, AnswerAdminController, ImportController
};

// Public pages
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/pricing', [PagesController::class, 'pricing'])->name('pricing');
Route::get('/faq', [PagesController::class, 'faq'])->name('faq');
Route::get('/blog', [PagesController::class, 'blog'])->name('blog');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact', [PagesController::class, 'submitContact'])->name('contact.submit');

// Auth-required
Route::middleware(['auth'])->group(function () {
    Route::get('/results', [ResultController::class, 'index'])->name('results.index');
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Admin area
Route::middleware(['auth', EnsureAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => redirect()->route('admin.certifications.index'))->name('index');

    Route::resource('certifications', AdminCertificationController::class)->except(['show']);
    Route::get('questions/import', [QuestionImportController::class, 'showForm'])->name('questions.import.form');
    Route::post('questions/import', [QuestionImportController::class, 'import'])->name('questions.import');
});

// May need delete

// Replace the current root route:
Route::get('/', function () { return view('landing'); })->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::view('/', 'landing')->name('landing');

Route::get('/', function () {
    return view('landing');
});

require __DIR__.'/auth.php';

Route::get('/certifications/{slug}', [CertificationController::class, 'show'])
    ->name('certifications.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/certifications/{slug}/exam', [ExamController::class, 'start'])
        ->name('certifications.exam.start');
    Route::post('/certifications/{slug}/exam/submit', [ExamController::class, 'submit'])
        ->name('certifications.exam.submit');
});

Route::middleware(['auth','verified'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  // Certifications
  Route::get('/certifications', [CertificationController::class, 'index'])->name('certifications.index');
  Route::get('/certifications/{certification}', [CertificationController::class, 'show'])->name('certifications.show');
  Route::post('/certifications/{certification}/activate', [CertificationController::class, 'activate'])->name('certifications.activate');

  // Exams
  Route::post('/exam/{certification}/start/{type}', [ExamController::class, 'start'])->name('exam.start'); // diagnostic|practice|full
  Route::get('/exam/{attempt}/take', [ExamController::class, 'take'])->name('exam.take');
  Route::post('/exam/{attempt}/submit', [ExamController::class, 'submit'])->name('exam.submit');
  //Added - 20.08.2025
  Route::post('/exam/{certification}/{type}', [ExamController::class, 'start'])->name('exam.start');
  Route::get('/results/{attempt}', [ResultController::class, 'show'])->name('results.show');
 // Route::post('/exam/{attempt}/submit', [ExamController::class, 'submit'])->name('exam.submit');
  

  // Results
  Route::get('/results/{attempt}', [ResultController::class, 'show'])->name('results.show');

  // Admin (very lean)
  Route::prefix('admin')->middleware('ensure.admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('users', UserAdminController::class)->only(['index','edit','update']);

    // Paste JSON importer
    Route::view('/import', 'admin.import')->name('admin.import');
    Route::post('/import/json', [ImportController::class, 'jsonPaste'])->name('admin.import.json');

	// Admin import (protected by EnsureAdmin) //Added - 20.08.2025
Route::middleware(['ensure.admin'])->group(function () {
    Route::get('/admin/import', [ImportController::class, 'showForm'])->name('admin.import');
    Route::post('/admin/import/json', [ImportController::class, 'importJson'])->name('admin.import.json');
});

Route::middleware(['auth','ensure.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [CertificationAdminController::class, 'index'])->name('home');
	
	Route::resource('certifications', CertificationAdminController::class);
	Route::resource('domains', DomainAdminController::class)->except(['show']);
    Route::resource('topics', TopicAdminController::class)->except(['show']);
    Route::resource('questions', QuestionAdminController::class)->except(['show']);
    Route::resource('answers', AnswerAdminController::class)->only(['index','edit','update','destroy']);

    Route::resource('users', UserAdminController::class)->only(['index','edit','update']);
    Route::get('import', [ImportController::class, 'showForm'])->name('import.show');
    Route::post('import/json', [ImportController::class, 'importJson'])->name('import.json');
  });
  
  Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/import', [ImportController::class, 'show'])->name('admin.import.show');
    Route::post('/import', [ImportController::class, 'import'])->name('admin.import.json');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});

Route::middleware(['auth', 'pro'])->group(function () {
    Route::get('/pro/certifications', [CertificationController::class, 'index']);
});

Route::middleware(['auth', 'free'])->group(function () {
    Route::get('/free/dashboard', [DashboardController::class, 'index']);
});

});

});
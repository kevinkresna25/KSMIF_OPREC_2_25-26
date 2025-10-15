<?php

use App\Http\Controllers\AdminSnippetController;
use App\Http\Controllers\AdminTeamController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use App\Models\Team;
use App\Models\TeamSubmission;
use App\Models\Snippet;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $stats = [
        'teams' => Team::count(),
        'submissions' => TeamSubmission::count(),
        'snippets' => Snippet::count(),
    ];
    return view('welcome', compact('stats'));
})->name('home');

/*
|--------------------------------------------------------------------------
| Crypto Tools
|--------------------------------------------------------------------------
*/

// Decrypt tool (hanya untuk team yang login)
Route::controller(CryptoController::class)->middleware('team')->prefix('decrypt')->name('decrypt.')->group(function () {
    Route::get('/', 'showDecrypt')->name('show');
    Route::post('/', 'decrypt')->name('process');
});

// Encrypt tool (hanya untuk operator)
Route::controller(CryptoController::class)->middleware(['auth', 'operator'])->prefix('encrypt')->name('encrypt.')->group(function () {
    Route::get('/', 'showEncrypt')->name('show');
    Route::post('/', 'encrypt')->name('process');
});

Route::controller(SubmissionController::class)->middleware('team')->group(function () {
    Route::get('/input', 'create')->name('submission.create');
    Route::post('/input', 'store')->name('submission.store');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    // Profile Management
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    // Operator Dashboard
    Route::get('/dashboard', [OperatorController::class, 'dashboard'])->name('dashboard');

    // Operator - Team Management
    Route::controller(OperatorController::class)->prefix('operator')->name('operator.')->group(function () {
        Route::get('teams/{team}/confirm', 'showConfirm')->name('confirm.show');
        Route::post('teams/{team}/confirm', 'processConfirm')->name('confirm.process');
        
        // Arrangement for ALL confirmed submissions
        Route::get('arrange', 'showArrange')->name('arrange.show');
        Route::post('arrange/check', 'checkOrder')->name('arrange.check');
    });

    // Operator - CRUD Management (Only Operators)
    Route::middleware('operator')->prefix('operator/manage')->name('operator.manage.')->group(function () {
        Route::resource('teams', AdminTeamController::class)->except(['show']);
        Route::resource('snippets', AdminSnippetController::class)->except(['show']);
        
        // Submissions management (delete only, no edit)
        Route::get('submissions', [App\Http\Controllers\AdminSubmissionController::class, 'index'])->name('submissions.index');
        Route::delete('submissions/{submission}', [App\Http\Controllers\AdminSubmissionController::class, 'destroy'])->name('submissions.destroy');
        Route::post('submissions/bulk-destroy', [App\Http\Controllers\AdminSubmissionController::class, 'bulkDestroy'])->name('submissions.bulk-destroy');
    });
});

require __DIR__ . '/auth.php';

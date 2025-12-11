<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Onboarding\AssociationOnboardingController;
use App\Http\Controllers\Onboarding\CompanyOnboardingController;
use App\Http\Controllers\Onboarding\StudentOnboardingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/onboarding/student', [StudentOnboardingController::class, 'create'])
        ->middleware('role:student')
        ->name('onboarding.student.create');
    Route::post('/onboarding/student', [StudentOnboardingController::class, 'store'])
        ->middleware('role:student')
        ->name('onboarding.student.store');

    Route::get('/onboarding/association', [AssociationOnboardingController::class, 'create'])
        ->middleware('role:association')
        ->name('onboarding.association.create');
    Route::post('/onboarding/association', [AssociationOnboardingController::class, 'store'])
        ->middleware('role:association')
        ->name('onboarding.association.store');

    Route::get('/onboarding/company', [CompanyOnboardingController::class, 'create'])
        ->middleware('role:company')
        ->name('onboarding.company.create');
    Route::post('/onboarding/company', [CompanyOnboardingController::class, 'store'])
        ->middleware('role:company')
        ->name('onboarding.company.store');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/student', [DashboardController::class, 'student'])
        ->middleware('role:student')
        ->name('dashboard.student');
    Route::get('/dashboard/association', [DashboardController::class, 'association'])
        ->middleware('role:association')
        ->name('dashboard.association');
    Route::get('/dashboard/company', [DashboardController::class, 'company'])
        ->middleware('role:company')
        ->name('dashboard.company');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    Route::view('/students', 'placeholders.coming-soon', ['title' => 'Students'])->name('students');
    Route::view('/groups', 'placeholders.coming-soon', ['title' => 'Groups'])->name('groups');
    Route::view('/messages', 'placeholders.coming-soon', ['title' => 'Messages'])->name('messages');
});

Route::view('/home', 'placeholders.coming-soon', ['title' => 'Home'])->name('home');

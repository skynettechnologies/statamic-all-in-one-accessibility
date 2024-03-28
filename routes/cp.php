<?php
use Illuminate\Support\Facades\Route;
use Skynettechnologies\AllInOneAccessibility\Http\Controllers\SettingsController;

Route::prefix('skynettechnologies/all-in-one-accessibility')->name('skynettechnologies/all-in-one-accessibility.')->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('settings');
});

<?php
use Illuminate\Support\Facades\Route;
use Skynettechnologies\AllInOneAccessibility\Http\Controllers\SettingsController;

Route::prefix('skynettechnologies/statamic-all-in-one-accessibility')->name('skynettechnologies/statamic-all-in-one-accessibility.')->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('settings');
});

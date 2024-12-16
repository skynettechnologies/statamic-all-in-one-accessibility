<?php
use Skynettechnologies\AllInOneAccessibility\Http\Controllers\SettingsController;

Route::middleware(['web', 'cp'])->prefix('cp/settings')->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/store', [SettingsController::class, 'store'])->name('settings.store');
    Route::get('/fetch', [SettingsController::class, 'fetch'])->name('settings.fetch');
});
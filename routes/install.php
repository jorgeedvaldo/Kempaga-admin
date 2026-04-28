<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;

Route::get('/', [InstallController::class, 'step5'])->name('step5');
Route::get('/step5', [InstallController::class, 'step5'])->name('step5_old');

Route::post('/database_installation', [InstallController::class, 'databaseInstallation'])
    ->name('install.db')
    ->middleware('installation-check');

Route::get('import_sql', [InstallController::class, 'importSql'])
    ->name('import_sql')
    ->middleware('installation-check');

Route::get('force-import-sql', [InstallController::class, 'forceImportSql'])
    ->name('force-import-sql')
    ->middleware('installation-check');

Route::post('system_settings', [InstallController::class, 'systemSettings'])->name('system_settings');
Route::post('purchase_code', [InstallController::class, 'purchaseCode'])->name('purchase.code');

Route::fallback(function () {
    return redirect('/');
});

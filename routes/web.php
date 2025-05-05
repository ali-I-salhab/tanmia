<?php

use App\Http\Controllers\BenifiteController;
use App\Models\benifites;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Exports\BenifiteExport;
use App\Http\Controllers\PlanController;
use App\Http\Middleware\AuthAdmin;
use Maatwebsite\Excel\Facades\Excel;
Route::get('/', function () {
    return view('benifites.index');
})->name('index');

Auth::routes();
Route::middleware(['auth',AuthAdmin::class])->group(function () {
    Route::get('/benifites', action: [BenifiteController::class, 'index'])->name('benifites.benifites');
    Route::get('/benifites/{id}/edit', [BenifiteController::class, 'edit'])->name('benifites.edit');
    Route::put('/benifites/{id}', [BenifiteController::class, 'update'])->name('benifites.update');
    
    Route::get('/benifites/create', [BenifiteController::class, 'create'])->name('benifites.create');
    Route::post('/benifites', [BenifiteController::class, 'store'])->name('benifites.store');
    Route::get('/benifites/{id}/edit', [BenifiteController::class, 'edit'])->name('benifites.edit');
    Route::put('/benifites/{id}', [BenifiteController::class, 'update'])->name('benifites.update');
    Route::delete('/benifites/{id}', [BenifiteController::class, 'destroy'])->name('benifites.destroy');
    
    Route::get('/benifites/export', function (Illuminate\Http\Request $request) {
        return Excel::download(new BenifiteExport($request->all()), 'benifites.xlsx');
    })->name('benifites.export');

});
Route::get('/locations', [BenifiteController::class, 'index'])->name('locations.index');
Route::get('/get-units', [BenifiteController::class, 'getUnits'])->name('get.units');
Route::get('/get-villages', [BenifiteController::class, 'getVillages'])->name('get.villages');

Route::get('/benifites/export', [BenifiteController::class, 'export'])->name('benifites.export');
Route::get('/benifites/export/pdf', [BenifiteController::class, 'exportPdf'])->name('benifites.export.pdf');

Route::post('logout', function () {
    Auth::logout();
    return redirect('/');  // Redirect to homepage or any page after logout
})->name('logout');
use App\Http\Controllers\SupporterController;

Route::get('/supporters', [SupporterController::class, 'index'])->name('supporters.index');
Route::resource('supporters', SupporterController::class);
Route::resource('plans', PlanController::class);
Route::get('/plans/{plan}/select-beneficiaries', [PlanController::class, 'selectBeneficiaries'])->name('plans.select.beneficiaries');
Route::post('/plans/{plan}/attach-beneficiaries', [PlanController::class, 'attachBeneficiaries'])->name('plans.attach.beneficiaries');
Route::get('/plans/{id}', [PlanController::class, 'show'])->name('plans.show');
Route::get('/get-units', [BenifiteController::class, 'getUnits'])->name('get.units');
Route::get('/get-villages', [BenifiteController::class, 'getVillages'])->name('get.villages');
Route::get('/benifites/get-villages/{adminUnitId}', [BenifiteController::class, 'getVillagesByAdminUnit']);

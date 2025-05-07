<?php

use App\Http\Controllers\BenifiteController;
use App\Models\benifites;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Exports\BenifiteExport;
use App\Http\Controllers\PlanController;
use App\Http\Middleware\AuthAdmin;
use Maatwebsite\Excel\Facades\Excel;
Route::post('/plans/save-selection', [PlanController::class, 'saveSelection'])
     ->name('plans.save-selection');
     
Route::get('/plans/get-selected', [PlanController::class, 'getSelected'])
     ->name('plans.get-selected');
Route::get('/', function () {
    return view('benifites.index');
})->name('index');
Route::get('/plans/select-beneficiaries', [PlanController::class, 'selectBeneficiaries'])
     ->name('plans.select-beneficiaries');
     Route::post('/plans/save-selection', [PlanController::class, 'saveSelection'])
     ->name('plans.save-selection');
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
use App\Models\Benifite;
use Illuminate\Http\Request;

Route::get('/supporters', [SupporterController::class, 'index'])->name('supporters.index');
Route::resource('supporters', SupporterController::class);
Route::resource('plans', PlanController::class);
Route::get('/plans/{id}', [PlanController::class, 'show'])->name('plans.show');
Route::get('/get-units', [BenifiteController::class, 'getUnits'])->name('get.units');
Route::get('/get-villages', [BenifiteController::class, 'getVillages'])->name('get.villages');
Route::get('/benifites/get-villages/{adminUnitId}', [BenifiteController::class, 'getVillagesByAdminUnit']);
Route::post('plans/{plan}/assign-beneficiaries', [PlanController::class, 'assignBeneficiaries'])->name('plans.assign-beneficiaries');
Route::get('plans/{plan}', [PlanController::class, 'show'])->name('plans.show');

// plans
Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
Route::post('/plans/store-step1', [PlanController::class, 'storeStep1'])->name('plans.store-step1');
Route::post('/plans/store-step2', [PlanController::class, 'storeStep2'])->name('plans.store-step2');
Route::get('/plans/{plan}', [PlanController::class, 'show'])->name('plans.show');




     Route::get('/test-redirect', function() {
        return redirect()->route('plans.select-beneficiaries');
    });     
Route::get('/test', function() {
    return view('plans.select-beneficiaries');
 });

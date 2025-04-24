<?php

use App\Http\Controllers\MostafedController;
use App\Models\Mostafed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Exports\MostafedExport;
use App\Http\Middleware\AuthAdmin;
use Maatwebsite\Excel\Facades\Excel;
Route::get('/', function () {
    return view('mostafed.index');
})->name('index');

Auth::routes();
Route::middleware(['auth',AuthAdmin::class])->group(function () {
    Route::get('/mostafed', action: [MostafedController::class, 'index'])->name('mostafed.mostafed');
    Route::get('/mostafed/{id}/edit', [MostafedController::class, 'edit'])->name('mostafed.edit');
    Route::put('/mostafed/{id}', [MostafedController::class, 'update'])->name('mostafed.update');
    
    Route::get('/mostafed/create', [MostafedController::class, 'create'])->name('mostafed.create');
    Route::post('/mostafed', [MostafedController::class, 'store'])->name('mostafed.store');
    Route::get('/mostafed/{id}/edit', [MostafedController::class, 'edit'])->name('mostafed.edit');
    Route::put('/mostafed/{id}', [MostafedController::class, 'update'])->name('mostafed.update');
    Route::delete('/mostafed/{id}', [MostafedController::class, 'destroy'])->name('mostafed.destroy');
    
    Route::get('/mostafed/export', function (Illuminate\Http\Request $request) {
        return Excel::download(new MostafedExport($request->all()), 'mostafed.xlsx');
    })->name('mostafed.export');

});
Route::resource('plans', \App\Http\Controllers\PlanController::class);




Route::post('logout', function () {
    Auth::logout();
    return redirect('/');  // Redirect to homepage or any page after logout
})->name('logout');
use App\Http\Controllers\SupporterController;

Route::get('/supporters', [SupporterController::class, 'index'])->name('supporters.index');

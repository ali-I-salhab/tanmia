<?php

use App\Models\Benifite;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

Route::post('/beneficiaries/filter', function(Request $request) {
    $beneficiaries = Benifite::filter($request)->get();
    return response()->json($beneficiaries);
});
<?php

namespace App\Http\Controllers;

use App\Models\Supporter;
use Illuminate\Http\Request;

class SupporterController extends Controller
{
    public function index()
    {
        $supporters = Supporter::all();  // Fetch all supporters
        return view('supporters.index', compact('supporters'));
    }
}

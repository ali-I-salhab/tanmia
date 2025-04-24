<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Supporter;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::with('supporter')->paginate(10);
        return view('plans.index', compact('plans'));
    }

    public function create()
    {
        $supporters = Supporter::all();
        return view('plans.create', compact('supporters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type_of_support' => 'required',
            'supporter_id' => 'required|exists:supporters,id',
        ]);

        Plan::create($request->all());
        return redirect()->route('plans.index')->with('success', 'Plan created successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Benifite;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanBenifiteController extends Controller
{
    public function index(Plan $plan)
    {
        $benifites = Benifite::whereDoesntHave('plans', function($query) use ($plan) {
            $query->where('plan_id', $plan->id);
        })->paginate(20);

        return view('plans.benifites', compact('plan', 'benifites'));
    }

    public function store(Request $request, Plan $plan)
    {
        $request->validate([
            'benifites' => 'required|array',
            'benifites.*' => 'exists:benifites,id'
        ]);

        $plan->benifites()->attach($request->benifites);

        return redirect()->route('plans.show', $plan)->with('success', 'Beneficiaries added to plan successfully');
    }

    public function destroy(Plan $plan, Benifite $benifite)
    {
        $plan->benifites()->detach($benifite->id);
        return back()->with('success', 'Beneficiary removed from plan');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Benifite;
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
        $supporters = Supporter::all(); // To populate dropdown
        return view('plans.create', compact('supporters'));
    }
    
    public function store(Request $request)
    {
        $plan = Plan::create([
            'name' => $request->name,
            'type_of_support' => $request->type_of_support,
            'supporter_id' => $request->supporter_id,
        ]);
        $benifites = Benifite::all(); // You can filter here if needed

        return redirect()->route('plans.select.beneficiaries', ['plan' => $plan->id,]);
    }
    public function selectBeneficiaries(Plan $plan)
{
    $benifites = Benifite::all(); // You can filter here if needed
    return view('plans.select-beneficiaries', compact('plan', 'benifites'));
}
public function attachBeneficiaries(Request $request, Plan $plan)
{
    $request->validate([
        'benifites' => 'required|array',
        'benifites.*' => 'exists:benifites,id',
    ]);

    $plan->benifites()->sync($request->benifites); // sync removes old and adds new

    return redirect()->route('plans.index')->with('success', 'تم حفظ المستفيدين بنجاح');
}



public function show($id)
{
    // Fetch the plan based on the provided ID
    $plan = Plan::findOrFail($id);

    // Fetch beneficiaries (Benifites) related to the plan
    $benifites = Benifite::where('id', $plan->id)
        ->when(request('plan_id'), function($query) {
            return $query->where('plan_id', request('plan_id'));
        })
        ->paginate(10);

    // Return the view with the specific plan and its beneficiaries
    return view('plans.show', compact('plan', 'benifites'));
}
    
}

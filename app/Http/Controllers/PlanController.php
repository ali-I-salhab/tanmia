<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Benifite;
use App\Models\Plan;
use App\Models\Supporter;
use Illuminate\Http\Request;

class PlanController extends Controller
{public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type_of_support' => 'required|string',
            'supporter_id' => 'required|exists:supporters,id',
            'beneficiaries_count' => 'required|integer|min:1'
        ]);
    
        // Store in session for step 2
        $request->session()->put('plan_data', $validated);
    
        return redirect()->route('plans.select-beneficiaries');
    }
    public function saveSelection(Request $request)
    {
        $selected = $request->beneficiaries ?? [];
        $action = $request->action ?? 'replace';
    
        if ($action === 'add') {
            $current = $request->session()->get('selected_beneficiaries', []);
            $selected = array_unique(array_merge($current, $selected));
        } elseif ($action === 'remove') {
            $current = $request->session()->get('selected_beneficiaries', []);
            $selected = array_diff($current, $selected);
        }
    
        $request->session()->put('selected_beneficiaries', $selected);
    
        return response()->json(['status' => 'success']);
    }
    

public function getSelected(Request $request)
{
    $selected = $request->session()->get('selected_beneficiaries', []);
    $beneficiaries = Benifite::whereIn('id', $selected)->get();
    
    $html = view('plans.partials.selected-list', compact('beneficiaries'))->render();
    
    return response()->json(['html' => $html]);
}
    public function show(Plan $plan)
    {
        // Load the plan with its relationships
        $plan->load(['supporter', 'beneficiaries']);

        return view('plans.show', compact('plan'));
    }
    public function create()
    {
        $supporters = \App\Models\Supporter::all();
        return view('plans.create', compact('supporters'));
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type_of_support' => 'required|string',
            'supporter_id' => 'required|exists:supporters,id',
            'beneficiaries_count' => 'required|integer|min:1'
        ]);

        $request->session()->put('plan_data', $validated);

         return redirect()->route('plans.select-beneficiaries');
    }

    public function selectBeneficiaries(Request $request)
    {
        if (!$request->session()->has('plan_data')) {
            return redirect()->route('plans.create')->with('error', 'الرجاء إدخال بيانات الخطة أولاً');
        }
    
        $beneficiaries = Benifite::query()
            ->when($request->administrative_unit, function($query, $unit) {
                $query->where('adminstratour_unit', $unit);
            })
            ->when($request->disease_type, function($query, $diseaseType) {
                $query->where('sick_type', $diseaseType);
            })
            ->when($request->status, function($query, $status) {
                $query->where('status', $status);
            })
            ->paginate(10);
    
        $selectedBeneficiaries = $request->session()->get('selected_beneficiaries', []);
    
        return view('plans.select-beneficiaries', [
            'beneficiaries' => $beneficiaries,
            'required_count' => $request->session()->get('plan_data.beneficiaries_count'),
            'selected_count' => count($selectedBeneficiaries),
            'administrative_units' => Benifite::distinct('adminstratour_unit')->pluck('adminstratour_unit'),
            'disease_types' => Benifite::distinct('sick_type')->pluck('sick_type'),
            'statuses' => ['active', 'inactive'],
            'selected_beneficiaries' => $selectedBeneficiaries
        ]);
    }

    public function storeStep2(Request $request)
    {
        $planData = $request->session()->get('plan_data');
        $selectedCount = count($request->input('beneficiaries', []));
        
        if ($selectedCount != $planData['beneficiaries_count']) {
            return back()->with('error', 'يجب اختيار ' . $planData['beneficiaries_count'] . ' مستفيدين بالضبط');
        }
        
        $plan = Plan::create($planData);
        $plan->beneficiaries()->attach($request->beneficiaries);
        
        // Clear session data
        $request->session()->forget(['plan_data', 'selected_beneficiaries']);
        
        return redirect()->route('plans.index')->with('success', 'تم إنشاء الخطة بنجاح');
    }
    public function index()
    {
        $plans = Plan::with(['supporter', 'beneficiaries'])
            ->latest()
            ->paginate(10);

        return view('plans.index', compact('plans'));
    }
}

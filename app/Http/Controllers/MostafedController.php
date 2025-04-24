<?php

namespace App\Http\Controllers;

use App\Models\Mostafed;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MostafedController extends Controller
{
    //
    public function index(Request $request)
    {  $villages = Mostafed::select('village')
        ->distinct()
        ->orderBy('village', 'asc')
        ->pluck('village');
        $query = Mostafed::query();
        $mainvillages = Mostafed::select('main_village')
        ->distinct()
        ->orderBy('main_village', 'asc')
        ->pluck('main_village');
        $query = Mostafed::query();
    
        // Apply dropdown filters
        if ($request->filled('village')) {
        
            $query->where('village', $request->village);
        }
        if ($request->filled('main_village')) {
        
            $query->where('main_village', $request->main_village);
        }
    
        if ($request->filled('min_age')) {
            $query->where('age', '>=', $request->min_age);
        }
    
        if ($request->filled('max_age')) {
            $query->where('age', '<=', $request->max_age);
        }
    
        // Apply search filter
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
    
        $data = $query->paginate(100); // paginated result
    
        return view('mostafed.mostafed', compact('data','villages','mainvillages'));
    }
    public function create()
{
    return view('mostafed.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'village' => 'required|string|max:255',
        'age' => 'required|integer|min:1',
    ]);

    Mostafed::create($validated);

    return redirect()->route('mostafed.mostafed')->with('success', 'تمت إضافة المستفيد بنجاح!');
}
public function edit($id)
{
    $mostafed = Mostafed::findOrFail($id);
    return view('mostafed.edit', compact('mostafed'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'village' => 'required|string|max:255',
        'age' => 'required|integer|min:1',
    ]);

    $mostafed =Mostafed::findOrFail($id);
    $mostafed->update($validated);

    return redirect()->route('mostafed.mostafed')->with('success', 'تم تحديث بيانات المستفيد بنجاح!');
}
public function destroy($id)
{
    $mostafed = Mostafed::findOrFail($id);
    $mostafed->delete();

    return redirect()->route('mostafed.mostafed')->with('success', 'تم حذف المستفيد بنجاح!');
}



}

<?php

namespace App\Http\Controllers;

use App\Models\AdLevelOne;
use App\Models\AdLevelThree;
use App\Models\AdLevelTwo;
use App\Models\Benifite;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BenifitesExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Str;

class BenifiteController extends Controller

{


    //
    // public function index(Request $request)

    public function getUnits(Request $request)
    {
        $units = AdLevelTwo::where('ad_level_one_id', $request->city_id)->get();
        return response()->json($units);
    }

    public function getVillages(Request $request)
    {
        $villages = AdLevelThree::where('ad_level_two_id', $request->unit_id)->get();
        return response()->json($villages);
    }

    // {
    //     $villages = AdLevelTwo::select('name')
    //         ->distinct()
    //         ->orderBy('name', 'asc')
    //         ->pluck('name');

    //     $query = Benifite::query();
    //     $mainvillages = Benifite::select('adminstratour_unit')
    //         ->distinct()
    //         ->orderBy('adminstratour_unit', 'asc')
    //         ->pluck('adminstratour_unit');
    //     $mainbigvillages = AdLevelOne::select('name')->distinct()
    //         ->orderBy('name', 'asc')
    //         ->pluck('name');


    //     $query = Benifite::query();

    //     // Apply dropdown filters
    //     if ($request->filled('village')) {

    //         $query->where('village', $request->village);
    //     }
    //     if ($request->filled('adminstratour_unit')) {

    //         $query->where('adminstratour_unit', $request->adminstratour_unit);
    //     }

    //     if ($request->filled('min_age')) {
    //         $query->where('age', '>=', $request->min_age);
    //     }

    //     if ($request->filled('max_age')) {
    //         $query->where('age', '<=', $request->max_age);
    //     }

    //     // Apply search filter
    //     if ($request->filled('name')) {
    //         $query->where('name', 'LIKE', '%' . $request->name . '%');
    //     }
    //     $cities = AdLevelOne::orderBy('name')->get();

    //     $data = $query->paginate(100); // paginated result

    //     return view('benifites.benifites', compact('data','cities', 'villages', 'mainvillages', 'mainbigvillages'));
    public function index(Request $request)
    {
        // Get dropdown values
        $villages = AdLevelThree::select('name')->distinct()->orderBy('name', 'asc')->pluck('name');
        $units = AdLevelTwo::select('name')->distinct()->orderBy('name', 'asc')->pluck('name');
        $mainbigvillages = AdLevelOne::select('name')->distinct()->orderBy('name', 'asc')->pluck('name');

        // Start query
        $query = Benifite::query();
        // Apply filters
        if ($request->filled('village')) {



            $nameofvillagebaseddonid = AdLevelThree::find($request->village)->name;
            // dd($nameofvillagebaseddonid);

            $query->where('village', operator: $nameofvillagebaseddonid);
        }

        if ($request->filled('unit')) {

            $nameofadmbaseddonid = AdLevelTwo::find($request->unit)->name;
            // dd($request->unit, $nameofadmbaseddonid);
            // $query->where('adminstratour_unit', $nameofadmbaseddonid);
            // dd(vars: $nameofadmbaseddonid);
            $query->where('adminstratour_unit', 'LIKE', '%' . $nameofadmbaseddonid . '%');
        }
        if ($request->filled('city')) {
            // $nameofleveltwo = AdLevelone::find($request->city)?->adLevelTwos->pluck('name');
            // if ($nameofleveltwo && $nameofleveltwo->isNotEmpty()) {
            //     $query->whereIn('adminstratour_unit', $nameofleveltwo);
            // }
            $normalizedNames = AdLevelone::find($request->city)?->adLevelTwos
    ->pluck('name')
    ->map(function ($name) {
        return strtolower(str_replace('_', ' ', $name)); // normalize
    });

$query->whereIn(
    DB::raw("LOWER(REPLACE(adminstratour_unit, '_', ' '))"),
    $normalizedNames->toArray()
);

        }
        
        if ($request->filled('min_age')) {
            $query->where('age', '>=', $request->min_age);
        }

        if ($request->filled('max_age')) {
            $query->where('age', '<=', $request->max_age);
        }

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->filled('sick_type')) {
            $query->where('sick_type', 'LIKE', '%' . $request->sick_type . '%');
        }

        // Paginate
        $data = $query->paginate(100);
        $perPage = $request->input('data_count', 10);  // Default to 10 if no value is provided

        $data = $query->paginate($perPage);
        $cities = AdLevelOne::all();
$querylenght=$query->count();
// dd($querylenght);

        // Pass all required variables to the view
        return view('benifites.benifites', compact('data','querylenght', 'cities', 'villages', 'units', 'mainbigvillages'));
    }
    public function export(Request $request)
    {
        return Excel::download(new BenifitesExport($request), 'benifites.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $query = Benifite::query();

        // Apply filters (copy logic from index)
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->filled('sick_type')) {
            $query->where('sick_type', 'LIKE', '%' . $request->sick_type . '%');
        }

        if ($request->filled('min_age')) {
            $query->where('age', '>=', $request->min_age);
        }

        if ($request->filled('max_age')) {
            $query->where('age', '<=', $request->max_age);
        }

        if ($request->filled('village')) {
            $query->where('village', $request->village);
        }

        $data = $query->get();

        $pdf = Pdf::loadView('benifites.pdf', compact('data'))
            ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

        return $pdf->download('benifites.pdf');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'village_id' => 'required|exists:ad_level_threes,id',
            'adminstrative_unit_id' => 'required|exists:ad_level_twos,id',
            'age' => 'nullable|integer|min:0',
            'national_id' => 'nullable|string|max:28',
            'mobile' => 'nullable|string|max:38',
            'location' => 'nullable|string|max:30',
            'social_status' => 'nullable|string',
            'childs_need_milk' => 'nullable|string|max:27',
            'childs_in_school' => 'nullable|string|max:17',
            'supporter' => 'nullable|string|max:2',
            'childs_in_univercity' => 'nullable|string|max:20',
            'sick_type' => 'nullable|string|max:59',
            'sickers_type' => 'nullable|string|max:136',
            'sickers_num' => 'nullable|string|max:190',
            'eaka' => 'nullable|string|max:136',
        ]);
        // dd($request->all());
        Benifite::create($request->all());

        return redirect()->route('benifites.benifites')->with('success', 'تمت إضافة المستفيد بنجاح');
    }
    public function create()
    {
        $villages = AdLevelThree::all();   // Get all villages (AdLevelThree)
        $adminUnits = AdLevelTwo::all();   // Get all admin units (AdLevelTwo)

        // Pass both variables to the view
        return view('benifites.create', compact('villages', 'adminUnits'));
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
        ]);

        $benifites = Benifite::findOrFail($id);
        $benifites->update($validated);

        return redirect()->route('benifites.benifites')->with('success', 'تم تحديث بيانات المستفيد بنجاح!');
    }
    public function destroy($id)
    {
        $benifites = Benifite::findOrFail($id);
        $benifites->delete();

        return redirect()->route('benifites.benifites')->with('success', 'تم حذف المستفيد بنجاح!');
    }

    public function getVillagesByAdminUnit($adminUnitId)
    {
        $villages = AdLevelThree::where('ad_level_two_id', $adminUnitId)->get();

        // Check if villages are found
        if ($villages->isEmpty()) {
            return response()->json([], 404); // Return empty array if no villages found
        }

        return response()->json($villages);
    }
    public function edit($id)
    {
        // Get the beneficiary by ID
        $benifites = Benifite::findOrFail($id);

        // Get all administrative units (you can modify this to fit your actual structure)
        $adminUnits = AdLevelTWo::all();  // Make sure the AdminUnit model is correctly defined

        // Pass both the beneficiary and the admin units to the view
        return view('benifites.edit', compact('benifites', 'adminUnits'));
    }
}

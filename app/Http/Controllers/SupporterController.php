<?php

namespace App\Http\Controllers;

use App\Models\Supporter;
use Illuminate\Http\Request;

class SupporterController extends Controller
{
    public function index(Request $request)
    {
        $query = Supporter::query();
    
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }
    
        $supporters = $query->orderBy('created_at', 'desc')->paginate(10);
    
        return view('supporters.index', compact('supporters'));
    }
    public function create()
{
    return view('supporters.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:supporters,email',
    ]);

    Supporter::create($validated);

    return redirect()->route('supporters.index')->with('success', 'تمت إضافة الداعم بنجاح.');
}
public function edit($id)
{
    $supporter = Supporter::findOrFail($id);
    return view('supporters.edit', compact('supporter'));
}

public function update(Request $request, $id)
{
    $supporter = Supporter::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:supporters,email,' . $id,
    ]);

    $supporter->update($validated);

    return redirect()->route('supporters.index')->with('success', 'تم التحديث بنجاح.');
}

public function destroy($id)
{
    $supporter = Supporter::findOrFail($id);
    $supporter->delete();

    return redirect()->route('supporters.index')->with('success', 'تم حذف الداعم بنجاح.');
}


    
}

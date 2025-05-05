<?php

namespace App\Exports;

use App\Models\Benifite;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class BenifitesExport implements FromView
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Benifite::query();

        if ($this->request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $this->request->name . '%');
        }

        if ($this->request->filled('sick_type')) {
            $query->where('sick_type', 'LIKE', '%' . $this->request->sick_type . '%');
        }

        if ($this->request->filled('min_age')) {
            $query->where('age', '>=', $this->request->min_age);
        }

        if ($this->request->filled('max_age')) {
            $query->where('age', '<=', $this->request->max_age);
        }

        if ($this->request->filled('village')) {
            $query->where('village', $this->request->village);
        }

        $data = $query->get();

        return view('benifites.export_excel', ['data' => $data]);
    }
}

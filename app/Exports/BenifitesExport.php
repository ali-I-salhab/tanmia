<?php

namespace App\Exports;

use App\Models\AdLevelThree;
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
        // http://127.0.0.1:8000/benifites?city=4&unit=66&village=4137&name=&sick_type=&min_age=&max_age=&data_count=
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
            // dd($this->request->filled('village'));
            // dd(AdLevelThree::find($this->request->village)->name);
            $nameofvillagebaseddonid=AdLevelThree::find($this->request->village)->name;
            
            $query->where('village', $nameofvillagebaseddonid);
            // dd($query);
        }

        $data = $query->get();

        return view('benifites.export_excel', ['data' => $data]);
    }
}

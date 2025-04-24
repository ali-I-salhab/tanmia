<?php

namespace App\Exports;

use App\Models\Mostafed;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MostafedExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Mostafed::query();

        if (!empty($this->filters['village'])) {
            $query->where('village', $this->filters['village']);
        }

        if (!empty($this->filters['search'])) {
            $query->where('name', 'LIKE', '%' . $this->filters['search'] . '%');
        }

        return $query->get(['name', 'village', 'created_at']);
    }

    public function headings(): array
    {
        return ['الاسم', 'القرية', 'تاريخ الإدخال'];
    }
}


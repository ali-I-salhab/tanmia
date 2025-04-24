<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        // Example data for chart
        $data = [
            'labels' => ['January', 'February', 'March', 'April', 'May'],
            'values' => [10, 25, 14, 30, 20]
        ];

        return view('reports.index', compact('data'));
    }
}

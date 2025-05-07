<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benifite extends Model
{
    //
    protected $fillable = [
        'mobile',
        'adminstratour_unit',
        'village',
        'name',
        'mother_name',
        'national_id',
        'age',
        'location',
        'social_status',
        'childs_need_milk',
        'childs_in_school',
        'supporter',
        'childs_in_univercity',
        'sick_type',
        'sickers_type',
        'sickers_num',
        'eaka',
        'adminstrative_unit_id',
        'village_id'
    ];
    protected $table = 'benifites';
    public function benifites()
    {
        return $this->belongsToMany(Benifite::class);
    }
    // app/Models/Benifite.php
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'benifite_plan');
    }

    public function scopeFilter($query, $request)
    {
        return $query->when($request->search, function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        })
            ->when($request->city, function ($q) use ($request) {
                $q->where('city', $request->city);
            })
            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type_of_support', 'supporter_id','description', 'start_date', 'end_date', 'status'];

    public function supporter()
    {
        return $this->belongsTo(Supporter::class);
    }
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
  
    public function beneficiaries()
    {
        return $this->belongsToMany(Benifite::class, 'benifite_plan');
    }
}

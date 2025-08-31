<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaternalHealthRecord extends Model
{
      protected $fillable = ['user_id', 'created_by', 'visit_date', 'gestational_age', 'weight', 'blood_pressure', 'notes'];

    protected $casts = [
        'visit_date' => 'date',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildHealthRecord extends Model
{
      protected $fillable = ['user_id', 'created_by', 'child_name', 'birth_date', 'weight', 'height', 'notes'];

    protected $casts = [
        'birth_date' => 'date',
    ];
}

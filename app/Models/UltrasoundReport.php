<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UltrasoundReport extends Model
{
      protected $fillable = ['user_id', 'uploaded_by', 'file_path', 'scan_date', 'notes'];

    protected $casts = [
        'scan_date' => 'date',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Medicamento extends Model
{
    use HasFactory;

    protected $table = 'medicamentos';

    protected $fillable = [
        'name',
        'dosage',
        'frequency',
        'schedule_time',
        'instructions',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function getScheduleTimeAttribute($value)
    {
        if (!$value) {
        return null;
    }

    return Carbon::parse($value);
    }


}

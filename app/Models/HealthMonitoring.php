<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthMonitoring extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'student_id',
        'check_date',
        'weight',
        'height',
        'temperature',
        'spo2',
        'heart_rate',
        'stress_level',
        'imt'
    ];
}

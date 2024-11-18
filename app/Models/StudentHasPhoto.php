<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentHasPhoto extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'student_id',
        'url',
        'is_featured'
    ];
}

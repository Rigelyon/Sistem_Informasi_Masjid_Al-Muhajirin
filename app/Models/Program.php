<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'emoji',
        'title',
        'description',
        'schedule_type',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'day_of_week',
        'custom_text',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'day_of_week' => 'array',
    ];
}

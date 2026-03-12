<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'task_name',
        'start_time',
        'end_time',
        'status',
        'description'
    ];

    protected $casts = [
        'start_time' => 'date',
        'end_time' => 'date',
    ];

    // Relationship ke User (nanti kalo udah ada authentication)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
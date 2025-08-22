<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResumeView extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_id',
        'ip_address',
        'user_agent',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}



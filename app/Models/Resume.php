<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'template',
        'personal_info',
        'education',
        'experience',
        'skills',
        'certifications',
        'social_links',
        'additional_sections',
    ];

    protected $casts = [
        'personal_info' => 'array',
        'education' => 'array',
        'experience' => 'array',
        'skills' => 'array',
        'certifications' => 'array',
        'social_links' => 'array',
        'additional_sections' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(ResumeView::class);
    }
}

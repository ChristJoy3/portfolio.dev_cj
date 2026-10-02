<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SidebarSkill extends Model
{
    public const GROUPS = [
        'language' => 'Language (circle)',
        'core' => 'Core skills (top bars)',
        'extended' => 'More skills (scrolling bars)',
    ];

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'level' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}

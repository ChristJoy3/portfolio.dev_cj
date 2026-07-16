<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasImageUrl;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function iconSrc(): ?string
    {
        return $this->resolveUrl($this->icon_url);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}

<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasImageUrl;

    protected $guarded = [];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
    ];

    public function imageSrc(): ?string
    {
        return $this->resolveUrl($this->image_url);
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

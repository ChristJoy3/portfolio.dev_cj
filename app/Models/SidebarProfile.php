<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;

/**
 * Singleton — the sidebar profile card is a single row, edited in place from the admin panel.
 */
class SidebarProfile extends Model
{
    use HasImageUrl;

    protected $guarded = [];

    protected $casts = [
        'links' => 'array',
    ];

    public static function current(): self
    {
        return static::firstOrCreate([]);
    }

    public function imageSrc(): ?string
    {
        return $this->resolveUrl($this->image_url);
    }
}

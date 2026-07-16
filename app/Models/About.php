<?php

namespace App\Models;

use App\Models\Concerns\HasImageUrl;
use Illuminate\Database\Eloquent\Model;

/**
 * Singleton — the About Me section is a single row, edited in place from the admin panel.
 */
class About extends Model
{
    use HasImageUrl;

    protected $guarded = [];

    protected $casts = [
        'chips' => 'array',
    ];

    /**
     * The one row, created empty on first access so the admin form always has something to edit.
     */
    public static function current(): self
    {
        return static::firstOrCreate([]);
    }

    public function imageSrc(): ?string
    {
        return $this->resolveUrl($this->image_url);
    }

    /**
     * Body text split into paragraphs on blank lines, so the admin edits one textarea
     * instead of a fixed number of paragraph fields.
     *
     * @return array<int, string>
     */
    public function paragraphs(): array
    {
        return array_values(array_filter(array_map(
            'trim',
            preg_split('/\R{2,}/', (string) $this->body) ?: []
        ), fn ($p) => $p !== ''));
    }
}

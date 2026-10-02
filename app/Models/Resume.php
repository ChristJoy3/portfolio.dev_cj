<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Singleton — the CV page is a single row, edited in place from the admin panel.
 */
class Resume extends Model
{
    protected $guarded = [];

    protected $casts = [
        'skills' => 'array',
        'experience' => 'array',
        'education' => 'array',
        'soft_skills' => 'array',
    ];

    public static function current(): self
    {
        return static::firstOrCreate([]);
    }

    /**
     * Bullet text is edited as one textarea, one bullet per line.
     *
     * @return array<int, string>
     */
    public static function lines(?string $text): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\R/', (string) $text) ?: []), fn ($l) => $l !== ''));
    }

    /** The website with the scheme added when missing, so the link works. */
    public function websiteUrl(): ?string
    {
        $site = trim((string) $this->website);

        if ($site === '') {
            return null;
        }

        return preg_match('#^https?://#i', $site) ? $site : 'https://'.$site;
    }
}

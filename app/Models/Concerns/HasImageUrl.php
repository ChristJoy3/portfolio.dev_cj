<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasImageUrl
{
    /**
     * Accepts either a full URL (Unsplash, a CDN) or a path to a file committed under public/
     * (e.g. "assets/cjsheesh.png"), so the admin can use whichever suits.
     */
    protected function resolveUrl(?string $url): ?string
    {
        $url = trim((string) $url);

        if ($url === '') {
            return null;
        }

        return Str::startsWith($url, ['http://', 'https://', '//'])
            ? $url
            : asset($url);
    }
}

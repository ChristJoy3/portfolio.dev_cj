<?php

namespace App\Filament\Forms;

use App\Models\Media;
use App\Support\ImageStore;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * An image upload field for an `*_url` string column.
 *
 * The file is compressed and stored in the `media` table (see ImageStore); the column receives
 * "/media/{id}". Columns that already hold an external URL or a public/ path still preview fine.
 */
class ImageUpload
{
    public static function make(string $name = 'image_url'): FileUpload
    {
        return FileUpload::make($name)
            ->image()
            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
            // Vercel rejects request bodies over 4.5 MB, so a bigger file could not arrive anyway.
            ->maxSize(4096)
            ->imagePreviewHeight('160')
            ->saveUploadedFileUsing(
                fn (TemporaryUploadedFile $file): string => ImageStore::store($file)->path()
            )
            ->getUploadedFileUsing(function (string $file): ?array {
                $url = Str::startsWith($file, ['http://', 'https://', '//']) ? $file : asset($file);

                $media = Str::startsWith($file, '/media/') ? Media::find((int) Str::after($file, '/media/')) : null;

                return [
                    'name' => $media ? 'Uploaded image' : basename(parse_url($file, PHP_URL_PATH) ?: $file),
                    'size' => $media?->size ?? 0,
                    'type' => $media?->mime,
                    'url' => $url,
                ];
            })
            // Never touch the old file on disk: an external URL is not ours, and an old Media row
            // is harmless to keep.
            ->deleteUploadedFileUsing(fn () => null)
            ->helperText('JPG, PNG or WebP, up to 4 MB. It is compressed automatically with no visible quality loss.');
    }
}

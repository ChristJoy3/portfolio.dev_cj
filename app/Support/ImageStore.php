<?php

namespace App\Support;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use RuntimeException;

/**
 * Turns an uploaded image into a compact Media row.
 *
 * Photos are downscaled to MAX_SIDE (never upscaled) and re-encoded as WebP at QUALITY, which is
 * visually indistinguishable from the original at a fraction of the size. Transparency survives.
 * If re-encoding would not make the file smaller, the original bytes are kept untouched.
 */
class ImageStore
{
    private const MAX_SIDE = 1600;

    private const QUALITY = 90;

    public static function store(UploadedFile $file): Media
    {
        $path = $file->getRealPath();
        $info = @getimagesize($path);

        if (! $info || ! in_array($info[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WEBP], true)) {
            throw new RuntimeException('Only JPG, PNG or WebP images can be uploaded.');
        }

        [$width, $height, $type] = $info;
        $original = file_get_contents($path);

        $image = match ($type) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($path),
            IMAGETYPE_PNG => imagecreatefrompng($path),
            IMAGETYPE_WEBP => imagecreatefromwebp($path),
        };

        if ($type === IMAGETYPE_JPEG) {
            $image = self::applyExifOrientation($image, $path);
            $width = imagesx($image);
            $height = imagesy($image);
        }

        $scale = min(1, self::MAX_SIDE / max($width, $height));
        if ($scale < 1) {
            $image = imagescale($image, (int) round($width * $scale), (int) round($height * $scale), IMG_BICUBIC);
            $width = imagesx($image);
            $height = imagesy($image);
        }

        imagepalettetotruecolor($image);
        imagealphablending($image, false);
        imagesavealpha($image, true);

        ob_start();
        imagewebp($image, null, self::QUALITY);
        $webp = (string) ob_get_clean();

        // Keep the original only when it is already smaller and did not need resizing.
        $useOriginal = $scale === 1 && strlen($original) <= strlen($webp);
        $bytes = $useOriginal ? $original : $webp;

        return Media::create([
            'mime' => $useOriginal ? image_type_to_mime_type($type) : 'image/webp',
            'data' => base64_encode($bytes),
            'size' => strlen($bytes),
            'width' => $width,
            'height' => $height,
        ]);
    }

    private static function applyExifOrientation(\GdImage $image, string $path): \GdImage
    {
        if (! function_exists('exif_read_data')) {
            return $image;
        }

        $orientation = @exif_read_data($path)['Orientation'] ?? 1;
        $rotated = match ($orientation) {
            3 => imagerotate($image, 180, 0),
            6 => imagerotate($image, -90, 0),
            8 => imagerotate($image, 90, 0),
            default => $image,
        };

        return $rotated ?: $image;
    }
}

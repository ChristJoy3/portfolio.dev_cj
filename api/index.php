<?php

// Vercel's filesystem is read-only except for /tmp. Redirect every path
// Laravel needs to write (bootstrap/package manifests, compiled views) into
// /tmp and make sure those directories exist before the framework boots.
$writablePaths = [
    'APP_CONFIG_CACHE'   => '/tmp/bootstrap/cache/config.php',
    'APP_PACKAGES_CACHE' => '/tmp/bootstrap/cache/packages.php',
    'APP_SERVICES_CACHE' => '/tmp/bootstrap/cache/services.php',
    'APP_ROUTES_CACHE'   => '/tmp/bootstrap/cache/routes.php',
    'APP_EVENTS_CACHE'   => '/tmp/bootstrap/cache/events.php',
    'VIEW_COMPILED_PATH' => '/tmp/storage/framework/views',
];

// Filament/Livewire stage uploaded files under storage/app before we move them into the
// database, so storage has to be somewhere writable too.
$writablePaths['LARAVEL_STORAGE_PATH'] = '/tmp/storage';

foreach ($writablePaths as $key => $value) {
    putenv("{$key}={$value}");
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

foreach (['/tmp/bootstrap/cache', '/tmp/storage/framework/views', '/tmp/storage/app/private', '/tmp/storage/framework/cache'] as $dir) {
    if (! is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Bootstrap Laravel for Vercel's PHP runtime
require __DIR__ . '/../public/index.php';

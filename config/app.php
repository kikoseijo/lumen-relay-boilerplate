<?php

return [
    'version' => '0.0.1',
    'name' => env('APP_NAME', 'React Lumen Boileplate'),
    'url' => env('APP_URL', 'http://www.sunnyface.com'),
    'host' => env('APP_HOST', 'sunnyface.dev'),
    'support_email' => env('SUPPORT_EMAIL', 'kiko[[@]]sunnyface.com'),
    'timezone' => 'utc',
    'locale' => 'es',
    'fallback_locale' => 'en',
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', false),
    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',
    // 'log' => env('APP_LOG', 'single'),
    'log_level' => env('APP_LOG_LEVEL', 'debug'),
];

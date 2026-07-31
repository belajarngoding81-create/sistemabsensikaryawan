<?php

// Vercel PHP entrypoint for Laravel.
// Routes all requests through the existing Laravel public front controller.

$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['DOCUMENT_ROOT'] = __DIR__ . '/../public';

require __DIR__ . '/../public/index.php';

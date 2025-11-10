<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Use CHANGE since some MySQL/MariaDB versions don't support RENAME COLUMN.
// Keep type as INT and NOT NULL to match current schema (checked via SHOW FULL COLUMNS).
$sql = "ALTER TABLE products CHANGE `estoque` `stock` INT NOT NULL";
try {
    DB::statement($sql);
    echo "OK: column renamed\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}

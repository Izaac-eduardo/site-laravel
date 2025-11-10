<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $res = DB::select('SELECT * FROM products LIMIT 1');
    if (empty($res)) {
        echo "No rows in products\n";
    } else {
        $row = (array)$res[0];
        echo "Row columns:\n";
        foreach (array_keys($row) as $k) {
            echo "- [$k]\n";
        }
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}

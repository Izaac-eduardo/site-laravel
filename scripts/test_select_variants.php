<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$queries = [
    'SELECT estoque FROM products LIMIT 1',
    'SELECT `estoque` FROM products LIMIT 1',
    'SELECT products.estoque FROM products LIMIT 1',
    'SELECT `products`.`estoque` FROM products LIMIT 1',
    'SELECT `estoque` as s FROM products LIMIT 1'
];

foreach ($queries as $q) {
    echo "QUERY: $q\n";
    try {
        $res = DB::select($q);
        echo "OK: returned " . count($res) . " rows\n";
    } catch (\Exception $e) {
        echo "ERROR: " . $e->getMessage() . PHP_EOL;
    }
    echo str_repeat('-', 40) . PHP_EOL;
}

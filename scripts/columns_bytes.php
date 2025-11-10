<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $cols = DB::select('SHOW FULL COLUMNS FROM products');
    foreach ($cols as $c) {
        $field = $c->Field;
        $bytes = '';
        for ($i = 0; $i < strlen($field); $i++) {
            $bytes .= ord($field[$i]) . ' ';
        }
        echo "Field: [{$field}] | bytes: {$bytes}\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}

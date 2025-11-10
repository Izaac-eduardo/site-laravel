<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $cols = DB::select('SHOW FULL COLUMNS FROM products');
    foreach ($cols as $c) {
        echo $c->Field . ' | ' . $c->Type . ' | Null: ' . $c->Null . ' | Default: ' . $c->Default . ' | Extra: ' . $c->Extra . PHP_EOL;
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}

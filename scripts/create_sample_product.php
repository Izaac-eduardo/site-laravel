<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

try {
    $p = Product::create([
        'name' => 'Teste Bot',
        'description' => 'Descrição de teste',
        'price' => 9.99,
        'stock' => 5,
    ]);
    echo "Created product id: {$p->id}\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}

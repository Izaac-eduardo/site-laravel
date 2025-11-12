<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ensure `stock` column exists with default 0
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'stock')) {
                $table->unsignedInteger('stock')->default(0)->after('price');
            }
        });

        // If legacy `estoque` exists, copy values and drop it
        if (Schema::hasColumn('products', 'estoque')) {
            DB::statement('UPDATE products SET stock = COALESCE(estoque, 0) WHERE estoque IS NOT NULL');
            Schema::table('products', function (Blueprint $table) {
                if (Schema::hasColumn('products', 'estoque')) {
                    $table->dropColumn('estoque');
                }
            });
        }
    }

    public function down(): void
    {
        // Reverse: recreate `estoque` from `stock` if necessary
        if (! Schema::hasColumn('products', 'estoque')) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('estoque')->default(0)->after('price');
            });
            DB::statement('UPDATE products SET estoque = COALESCE(stock, 0) WHERE stock IS NOT NULL');
        }
    }
};

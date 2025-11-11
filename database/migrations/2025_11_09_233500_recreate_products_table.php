<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    // Ensure no leftover temporary table exists from a previous failed run
    Schema::dropIfExists('products_new');

    // Create a fresh temporary table with the desired schema
    Schema::create('products_new', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
        });

        // Copy data from old table to new table. Prefer 'stock' if present, fall back to 0.
        // Only run the copy/drop if the original `products` table exists.
        if (Schema::hasTable('products')) {
            // We avoid referencing 'estoque' directly because the DB showed inconsistent behavior.
            DB::statement('INSERT INTO products_new (`id`, `name`, `description`, `price`, `stock`, `created_at`, `updated_at`) '
                . 'SELECT `id`, `name`, `description`, `price`, COALESCE(`stock`, 0) as stock, `created_at`, `updated_at` FROM `products`');

            // Drop old table and rename new to products
            Schema::drop('products');
        }

        // Rename the new table into place (if it wasn't already)
        if (! Schema::hasTable('products')) {
            Schema::rename('products_new', 'products');
        } else {
            // If products already exists for some reason, ensure products_new is removed to avoid leftover
            if (Schema::hasTable('products_new')) {
                Schema::dropIfExists('products_new');
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // In down, recreate the original-ish table with 'estoque' to restore previous state
        Schema::create('products_old', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('estoque')->default(0);
        });

        // Copy back (map stock -> estoque) only if current `products` exists
        if (Schema::hasTable('products')) {
            DB::statement('INSERT INTO products_old (`id`, `name`, `description`, `price`, `estoque`, `created_at`, `updated_at`) '
                . 'SELECT `id`, `name`, `description`, `price`, COALESCE(`stock`, 0) as estoque, `created_at`, `updated_at` FROM `products`');

            Schema::drop('products');
        }

        // Rename back
        if (! Schema::hasTable('products')) {
            Schema::rename('products_old', 'products');
        } else {
            if (Schema::hasTable('products_old')) {
                Schema::dropIfExists('products_old');
            }
        }
    }
};

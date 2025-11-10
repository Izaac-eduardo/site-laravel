<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Renomear colunas em português para nomes em inglês usados pelo código
            if (Schema::hasColumn('products', 'nome')) {
                $table->renameColumn('nome', 'name');
            }
            if (Schema::hasColumn('products', 'descrição')) {
                $table->renameColumn('descrição', 'description');
            }
            if (Schema::hasColumn('products', 'preço')) {
                $table->renameColumn('preço', 'price');
            }
            if (Schema::hasColumn('products', 'estoque')) {
                $table->renameColumn('estoque', 'stock');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'name')) {
                $table->renameColumn('name', 'nome');
            }
            if (Schema::hasColumn('products', 'description')) {
                $table->renameColumn('description', 'descrição');
            }
            if (Schema::hasColumn('products', 'price')) {
                $table->renameColumn('price', 'preço');
            }
            if (Schema::hasColumn('products', 'stock')) {
                $table->renameColumn('stock', 'estoque');
            }
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'cpf_cnpj')) {
                $table->string('cpf_cnpj', 18)->nullable()->after('password');
            }
            if (! Schema::hasColumn('users', 'type')) {
                $table->enum('type', ['admin','customer'])->default('customer')->after('cpf_cnpj');
            }
            // Ensure email unique index exists
            if (! Schema::hasColumn('users', 'email')) {
                $table->string('email')->unique()->after('name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // do not drop columns automatically
        });
    }
};

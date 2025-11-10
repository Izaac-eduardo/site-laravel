<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // Keep both 'stock' and legacy 'estoque' in fillable to support the DB state.
    protected $fillable = ['name', 'description', 'price', 'stock', 'estoque'];

    // Default for legacy column to avoid insertion errors while we normalize the schema.
    protected $attributes = [
        'estoque' => 0,
    ];
}

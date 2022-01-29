<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'size',
        'observations',
        'id_brand',
        'quantity_inventory',
        'boarding_date'
    ];
}

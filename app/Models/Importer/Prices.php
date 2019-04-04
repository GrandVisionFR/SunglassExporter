<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    protected $table = 'prices';
    protected $primaryKey = 'id';

    protected $fillable = [
        'catalog_version',
        'product',
        'start_time',
        'end_time',
        'original_price',
        'price'
    ];
}

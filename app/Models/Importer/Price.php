<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'price';
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

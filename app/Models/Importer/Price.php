<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'price';
    protected $primaryKey = 'price_id';

    protected $fillable = [
        'price_catalog_version',
        'price_product',
        'price_start_time',
        'price_end_time',
        'price_original_price',
        'price_price'
    ];
}

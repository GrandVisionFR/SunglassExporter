<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    protected $table = 'export_stocks';
    protected $primaryKey = 'export_stock_id';


    protected $fillable = [
        'productCode',
        'stock_text'
    ];
}

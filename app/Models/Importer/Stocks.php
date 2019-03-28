<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    protected $table = 'stocks';
    protected $primaryKey = 'stock_id';


    protected $fillable = [
        'productCode',
        'stock_text'
    ];
}

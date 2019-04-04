<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class FramesVariant extends Model
{
    protected $table = 'frames_variant';
    protected $primaryKey = 'id';

    protected $fillable = [
        'catalog_version',
        'code',
        'base_product',
        'sapid',
        'online_date',
        'offline_date',
        'synergie_name_fr',
        'macro_univers',
        'supercategories',
        'frame_incontournable',
        'description_fr',
        'caliber_size',
        'frame_web_colour',
        'ean',
        'promo_stickers',
    ];
}

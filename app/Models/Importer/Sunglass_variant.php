<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class Sunglass_variant extends Model
{
    protected $table = 'sunglass_variant';
    protected $primaryKey = 'sunglass_variant_id';

    protected $fillable = [
        'sunglass_variant_catalog_version',
        'sunglass_variant_code',
        'sunglass_variant_base_product',
        'sunglass_variant_sapid',
        'sunglass_variant_online_date',
        'sunglass_variant_offline_date',
        'sunglass_variant_synergie_name_fr',
        'sunglass_variant_macro_univers',
        'sunglass_variant_supercategories',
        'sunglass_variant_frame_incontournable',
        'sunglass_variant_description_fr',
        'sunglass_variant_caliber_size',
        'sunglass_variant_frame_web_colour',
        'sunglass_variant_ean',
        'sunglass_variant_promo_stickers',
    ];
}

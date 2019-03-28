<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class Sunglass extends Model
{
    protected $table = 'sunglass';
    protected $primaryKey = 'sunglass_id';

    protected $fillable = [
        'sunglass_catalog_version',
        'sunglass_code',
        'sunglass_sapid',
        'sunglass_online_date',
        'sunglass_offline_date',
        'sunglass_synergie_name_fr',
        'sunglass_frame_genre',
        'sunglass_description_fr',
        'sunglass_age_range',
        'sunglass_frame_material',
        'sunglass_frame_model',
        'sunglass_frame_shape',
        'sunglass_frame_mounting',
        'sunglass_nose_size',
        'sunglass_nose_size',
        'sunglass_brand_name',
        'sunglass_promo_stickers',
        'sunglass_temple_length',
        'sunglass_lens_protection_index',
    ];
}

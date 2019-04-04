<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class Frames extends Model
{
    protected $table = 'frames';
    protected $primaryKey = 'id';

    protected $fillable = [
        'catalog_version',
        'code',
        'sapid',
        'online_date',
        'offline_date',
        'synergie_name_fr',
        'frame_genre',
        'description_fr',
        'age_range',
        'frame_material',
        'frame_model',
        'frame_shape',
        'frame_mounting',
        'nose_size',
        'nose_size',
        'brand_name',
        'promo_stickers',
        'temple_length',
        'lens_protection_index',
    ];
}

<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class ContactLenses extends Model
{
    protected $table = 'contact_lenses';
    protected $primaryKey = 'id';

    protected $fillable = [
        'catalog_version',
        'code',
        'sapid',
        'online_date',
        'offline_date',
        'synergie_name_fr',
        'brand_name',
        'lens_colour',
        'lens_type',
        'vision_type',
        'contact_supplier',
        'contact_duration',
    ];
}

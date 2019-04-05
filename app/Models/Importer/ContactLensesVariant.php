<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class ContactLensesVariant extends Model
{
    protected $table = 'contact_lenses_variant';
    protected $primaryKey = 'id';

    protected $fillable = [
        'catalog_version',
        'code',
        'base_product',
        'sapid',
        'online_date',
        'offline_date',
        'synergie_name_fr',
        'description_fr',
    ];
}

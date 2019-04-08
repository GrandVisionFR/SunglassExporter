<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class ContactLenses extends Model
{
    protected $table = 'contact_lenses';
    protected $primaryKey = 'pk';

    protected $fillable = [
        'id',
        'title',
        'description',
        'price',
        'sale_price',
        'sale_price_effective_date',
        'link',
        'condition',
        'product_type',
        'brand',
        'gtin',
        'image_link',
        'google_product_category',
        'shipping',
        'availability',
        'material',
        'color',
        'size',
        'shape',
        'gender',
        'age_group',
        'custom_label_0',
        'custom_label_1',
        'custom_label_2',
        'custom_label_3',
        'custom_label_4',
        'catalog_version',
    ];
}

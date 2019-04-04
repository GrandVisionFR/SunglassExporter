<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Exporter\ExportProducts;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SunglassGdoExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ExportProducts::select([
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
            'age_group',
            'gender',
            'promosticker',
            ])->where('export_type', '=', getenv("GDO_CATALOG_CODE"))->get();
    }

    public function headings(): array
    {
        return [
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
            'image link',
            'google_product_category',
            'shipping',
            'availability',
            'material',
            'color',
            'size',
            'age_group',
            'gender',
            'custom_label_0',
        ];
    }
}

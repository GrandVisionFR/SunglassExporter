<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Exporter\Export_sunglass;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SunglassGdoExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Export_sunglass::select([
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
            'age_group',
        ])->where('export_type', 'NOT LIKE', "%gop%")->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'title',
            'Description',
            'Price',
            'Sale_price',
            'Sale_price_effective_date',
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
            'shape',
            'age group'
        ];
    }
}

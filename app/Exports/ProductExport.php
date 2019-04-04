<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Exporter\ExportProducts;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
     * The name of the type of the export.
     *
     * @var string
     */
    protected $exportType = '';

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
            ])->where('export_type', '=', $this->exportType)->get();
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

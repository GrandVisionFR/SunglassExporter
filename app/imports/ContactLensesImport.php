<?php
namespace App\Imports;

use App\Models\Importer\ContactLenses;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ContactLensesImport implements ToModel, WithCustomCsvSettings
{
    /**
     * The name of the type of the export.
     *
     * @var string
     */
    protected $catalog_version = '';

    public function model(Array $row)
    {
        return new ContactLenses([
            'id'                        => $row['0'],
            'title'                     => $row['1'],
            'description'               => $row['2'],
            'price'                     => $row['3'],
            'sale_price'                => $row['4'],
            'sale_price_effective_date' => $row['5'],
            'link'                      => $row['6'],
            'condition'                 => $row['7'],
            'product_type'              => $row['8'],
            'brand'                     => $row['9'],
            'gtin'                      => $row['10'],
            'image_link'                => $row['11'],
            'google_product_category'   => $row['12'],
            'shipping'                  => $row['13'],
            'availability'              => $row['14'],
            'material'                  => $row['15'],
            'color'                     => $row['16'],
            'size'                      => $row['17'],
            'shape'                     => $row['18'],
            'gender'                    => $row['19'],
            'age_group'                 => $row['20'],
            'custom_label_0'            => $row['21'],
            'custom_label_1'            => $row['22'],
            'custom_label_2'            => $row['23'],
            'custom_label_3'            => $row['24'],
            'custom_label_4'            => $row['25'],
            'catalog_version'           => $this->catalog_version,
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'UTF-8',
            'delimiter' => ','
        ];
    }
}
<?php
namespace App\Imports;

use App\Models\Importer\Sunglass_variant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class SunglassVariantImport implements ToModel, WithCustomCsvSettings
{
    public function model(Array $row)
    {
        return new Sunglass_variant([
            'sunglass_variant_catalog_version' => $row['1'],
            'sunglass_variant_code' => $row['2'],
            'sunglass_variant_base_product' => $row['3'],
            'sunglass_variant_sapid' => $row['4'],
            'sunglass_variant_online_date' => $row['5'],
            'sunglass_variant_offline_date' => $row['6'],
            'sunglass_variant_synergie_name_fr' => $row['7'],
            'sunglass_variant_macro_univers' => $row['8'],
            'sunglass_variant_supercategories' => $row['9'],
            'sunglass_variant_frame_incontournable' => $row['10'],
            'sunglass_variant_description_fr' => $row['11'],
            'sunglass_variant_caliber_size' => $row['12'],
            'sunglass_variant_frame_web_colour' => $row['13'],
            'sunglass_variant_ean' => $row['14'],
            'sunglass_variant_promo_stickers' => $row['15'],
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1',
            'delimiter' => ';'
        ];
    }
}
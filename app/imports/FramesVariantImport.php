<?php
namespace App\Imports;

use App\Models\Importer\FramesVariant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class FramesVariantImport implements ToModel, WithCustomCsvSettings
{
    public function model(Array $row)
    {
        return new FramesVariant([
            'catalog_version' => $row['1'],
            'code' => $row['2'],
            'base_product' => $row['3'],
            'sapid' => $row['4'],
            'online_date' => $row['5'],
            'offline_date' => $row['6'],
            'synergie_name_fr' => $row['7'],
            'macro_univers' => $row['8'],
            'supercategories' => $row['9'],
            'frame_incontournable' => $row['10'],
            'description_fr' => $row['11'],
            'caliber_size' => $row['12'],
            'frame_web_colour' => $row['13'],
            'ean' => $row['14'],
            'promo_stickers' => $row['15'],
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'UTF-8',
            'delimiter' => ';'
        ];
    }
}
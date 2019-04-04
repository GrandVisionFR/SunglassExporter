<?php
namespace App\Imports;

use App\Models\Importer\Frames;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class FramesImport implements ToModel, WithCustomCsvSettings
{
    public function model(Array $row)
    {
        return new Frames([
            'catalog_version' => $row['1'],
            'code' => $row['2'],
            'sapid' => $row['3'],
            'online_date' => $row['4'],
            'offline_date' => $row['5'],
            'synergie_name_fr' => $row['6'],
            'frame_genre' => $row['7'],
            'description_fr' => $row['8'],
            'age_range' => $row['9'],
            'frame_material' => $row['10'],
            'frame_model' => $row['11'],
            'frame_shape' => $row['12'],
            'frame_mounting' => $row['13'],
            'nose_size' => $row['14'],
            'brand_name' => $row['15'],
            'promo_stickers' => $row['16'],
            'temple_length' => $row['17'],
            'lens_protection_index' => $row['18'],
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
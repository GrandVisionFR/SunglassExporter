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
            'sunglass_catalog_version' => $row['1'],
            'sunglass_code' => $row['2'],
            'sunglass_sapid' => $row['3'],
            'sunglass_online_date' => $row['4'],
            'sunglass_offline_date' => $row['5'],
            'sunglass_synergie_name_fr' => $row['6'],
            'sunglass_frame_genre' => $row['7'],
            'sunglass_description_fr' => $row['8'],
            'sunglass_age_range' => $row['9'],
            'sunglass_frame_material' => $row['10'],
            'sunglass_frame_model' => $row['11'],
            'sunglass_frame_shape' => $row['12'],
            'sunglass_frame_mounting' => $row['13'],
            'sunglass_nose_size' => $row['14'],
            'sunglass_brand_name' => $row['15'],
            'sunglass_promo_stickers' => $row['16'],
            'sunglass_temple_length' => $row['17'],
            'sunglass_lens_protection_index' => $row['18'],
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
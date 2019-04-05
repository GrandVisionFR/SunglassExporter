<?php
namespace App\Imports;

use App\Models\Importer\ContactLenses;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ContactLensesImport implements ToModel, WithCustomCsvSettings
{
    public function model(Array $row)
    {
        return new ContactLenses([
            'catalog_version' => $row['1'],
            'code' => $row['2'],
            'sapid' => $row['3'],
            'online_date' => $row['4'],
            'offline_date' => $row['5'],
            'synergie_name_fr' => $row['6'],
            'brand_name' => $row['7'],
            'lens_colour' => $row['8'],
            'lens_type' => $row['9'],
            'vision_type' => $row['10'],
            'contact_supplier' => $row['11'],
            'contact_duration' => $row['12'],
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
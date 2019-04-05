<?php
namespace App\Imports;

use App\Models\Importer\ContactLensesVariant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ContactLensesVariantImport implements ToModel, WithCustomCsvSettings
{
    public function model(Array $row)
    {
        return new ContactLensesVariant([
            'catalog_version' => $row['1'],
            'code' => $row['2'],
            'base_product' => $row['3'],
            'sapid' => $row['4'],
            'online_date' => $row['5'],
            'offline_date' => $row['6'],
            'synergie_name_fr' => $row['7'],
            'description_fr' => $row['8'],
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
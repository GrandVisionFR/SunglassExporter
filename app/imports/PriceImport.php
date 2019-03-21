<?php
namespace App\Imports;

use App\Models\Importer\Price;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class PriceImport implements ToModel, WithCustomCsvSettings
{
    public function model(Array $row)
    {
        return new Price([
            'price_catalog_version' => $row['1'],
            'price_product' => $row['2'],
            'price_start_time' => $row['3'],
            'price_end_time' => $row['4'],
            'price_original_price' => $row['5'],
            'price_price' => $row['6'],
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
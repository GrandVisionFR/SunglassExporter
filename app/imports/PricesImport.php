<?php
namespace App\Imports;

use App\Models\Importer\Prices;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class PricesImport implements ToModel, WithCustomCsvSettings
{
    public function model(Array $row)
    {
        return new Prices([
            'catalog_version' => $row['1'],
            'product' => $row['2'],
            'start_time' => $row['3'],
            'end_time' => $row['4'],
            'original_price' => $row['5'],
            'price' => $row['6'],
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
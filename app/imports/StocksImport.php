<?php

namespace App\Imports;

use App\Models\Importer\Stocks;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class StocksImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $stock = trim(str_replace("\x00","", $row[2]));
        if($stock > 0){
            $stock = 'in stock';
        } else{
            $stock = 'out of stock';
        }
        return new Stocks([
            'productCode' => trim(str_replace("\x00","", $row[1])),
            'stock_text' => $stock
        ]);
    }

    public function startRow() : int{
        return 14;
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1',
            'delimiter' => ';'
        ];
    }
}

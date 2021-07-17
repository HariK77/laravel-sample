<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductsWithSheetsExport implements WithMultipleSheets
{
    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $count = 1;

        $skip = 0;

        $take = 1000;

        $sheet_number = 1;

        while ($count != 0) {

            $count = Product::skip($skip)->take($take)->get()->count();

            if ($count != 0) {

                $sheets[] = new ProductsSheetExport($skip, $take, 'Sheet'.$sheet_number);

                $skip += $take;

                $sheet_number++;
            }

        }

        return $sheets;
    }
}

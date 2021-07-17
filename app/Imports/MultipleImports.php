<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;

class MultipleImports implements WithMultipleSheets, WithEvents
{
    use Importable;

    private $sheets;

    private $sheetNames;

    private $failures = [];

    private $inserted_rows_count_individual_sheets = [];


    /**
    * @param Array $array
    */
    public function sheets(): array
    {
        $this->sheets = [
            0 => new ProductsImport(),
            1 => new CategoryImport(),
        ];

        return $this->sheets;
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) {
                $this->sheetNames[] = $event->getSheet()->getTitle();
            }
        ];
    }

    public function insertedRowsCountIndividualSheets(): array
    {
        foreach($this->sheets as $key => $sheet)
        {
            ++$key;
            $this->inserted_rows_count_individual_sheets['Sheet'.$key] = $sheet->insertedRowsCount();
        }
        return $this->inserted_rows_count_individual_sheets;
    }

    public function failures(): array
    {
        foreach($this->sheets as $key => $sheet)
        {
            ++$key;
            $this->failures['Sheet'.$key] = $sheet->failures();
        }
        return $this->failures;
    }

    public function getSheetNames(): array
    {
        foreach($this->sheets as $key => $sheet)
        {
            ++$key;
            $this->sheetNames[] = $sheet->sheetName;
        }
        return $this->sheetNames;
    }

}

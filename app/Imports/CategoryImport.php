<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;

class CategoryImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithBatchInserts, WithChunkReading, WithEvents
{
    use Importable, SkipsFailures;

    private $inserted_rows_count = 0;

    public $sheetName;

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) {
                $this->sheetName = $event->getSheet()->getTitle();
            }
        ];
    }

    /**
    * @param Array $row
    */
    public function model(array $row)
    {
        // Calculating how many rows got inserted
        ++$this->inserted_rows_count;

        $validated_data['name'] = $row['name'];

        return new Category($validated_data);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:25|unique:categories,name',

        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'name.required' => 'The :attribute column is required',
            'name.string' => 'The :attribute column should be in text',
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function insertedRowsCount(): int
    {
        return $this->inserted_rows_count;
    }
}

<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Str;
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

class ProductsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithBatchInserts, WithChunkReading, WithEvents
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
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Calculating how many rows got inserted
        ++$this->inserted_rows_count;

        $validated_data['product_name'] = $row['product_name'];
        $validated_data['product_slug'] = Str::slug($row['product_name']);
        $validated_data['brand'] = $row['brand'];
        $validated_data['price'] = $row['price'];
        $validated_data['model_name'] = $row['model_name'];
        $validated_data['short_desc'] = $row['short_desc'];
        $validated_data['description'] = $row['description'];
        $validated_data['featured'] = $row['featured'];
        $validated_data['available'] = $row['available'];
        $validated_data['active_flag'] = $row['active_flag'];

        // dd('FInal Stop');
        // return new Product($validated_data);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|string|min:3|max:25',
            'brand' => 'required|string|min:3|max:25',
            'price' => 'required|numeric',
            'model_name' => 'required|string|min:3|max:25',
            'short_desc' => 'required|min:5|max:1000',
            'description' => 'required|min:5|max:1000',
            'featured' => 'required|numeric',
            'available' => 'required|numeric',
            'active_flag' => 'required|numeric',
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'product_name.required' => 'The :attribute column is required',
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

<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use DB;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping, WithColumnFormatting
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
        // limit(1)->get()
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->product_name,
            $product->product_slug,
            $product->brand,
            $product->price,
            $product->model_name,
            $product->short_desc,
            $product->description,
            $product->featured ? 'Yes' : 'No',
            $product->available ? 'Available' : 'Not Available',
            $product->active_flag ? 'Active' : 'Not Active',
            dateFormat($product->created_at),
            dateFormat($product->updated_at),
        ];
    }

    public function columnFormats(): array
    {
        // Add below line in Number Format Class
        // const FORMAT_CURRENCY_IND_SIMPLE = '"₹"#,##,##0.00_-';
        return [
            'E' => '"₹ "#,##,##0.00_-',
        ];
    }

    public function headings(): array
    {
        // return [
        //     'id',
        //     'product_name',
        //     'product_slug',
        //     'brand',
        //     'price',
        //     'model_name',
        //     'short_desc',
        //     'description',
        //     'featured',
        //     'available',
        //     'active_flag',
        //     'created_at',
        //     'updated_at'
        // ];

        return DB::getSchemaBuilder()->getColumnListing('products');
        // return $columns;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $column_length = $event->sheet->getHighestColumn() . 1;
                $row_length = $event->sheet->getHighestRow();

                // Making the headings bold
                $event->sheet->getStyle('A1:'.$column_length)->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);

                // Colouring a column
                $background_style = [
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => [
                            'rgb' => 'FFED4F',
                        ],
                    ]
                ];

                $event->sheet->getStyle('D1:D'.$row_length)->applyFromArray($background_style);
            },
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Product;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductsSheetExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithMapping, WithColumnFormatting, WithTitle
{
    private $skip;
    private $take;
    private $title;

    public function __construct($skip, $take, $title)
    {
        $this->skip = $skip;
        $this->take = $take;
        $this->title = $title;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::skip($this->skip)->take($this->take)->get();
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
            $product->featured,
            $product->available,
            $product->active_flag,
            $product->created_at,
            $product->updated_at,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => '"₹ "#,##,##0.00_-',
        ];
    }

    public function headings(): array
    {
        return DB::getSchemaBuilder()->getColumnListing('products');
    }

    public function title(): string
    {
        return $this->title;
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

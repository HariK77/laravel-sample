<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Exports\ProductsWithSheetsExport;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Http\Controllers\Controller;
use App\Imports\MultipleImports;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        return view('dashboard.excel.index', compact('products'));
    }

    public function export()
    {
        // Calculating how much time a script took to execute
        // $start = microtime(true);
        // while (...) {

        // }
        // $time_elapsed_secs = microtime(true) - $start;

        // ini_set('memory_limit', '-1');
        // ini_set('max_execution_time', '300'); //300 seconds = 5 minutes

        // return Excel::download(new ProductsExport, 'products_' . currentDateTime() . '.xlsx');

        $export = new ProductsExport();

        return Excel::download($export, 'products_' . currentDateTime() . '.xlsx');

    }

    public function exportMultipleSheets()
    {
        $export = new ProductsWithSheetsExport();

        return Excel::download($export, 'products_with_sheets_' . currentDateTime() . '.xlsx');
    }

    public function import(Request $request)
    {
        $rules = [
            'file' => 'required|mimes:xlsx,xls|max:2000',
        ];
        $messages = [
            'file.required' => 'Please upload a Excel File',
            'file.mimes' => 'The file type must be xlsx or xls',
            'file.max' => 'File size should not be more than 2000 KiB',
        ];

        $this->validate($request, $rules, $messages);

        // Checking Whether the columns in uploaded excel match with our table column names or not
        $headings = (new HeadingRowImport)->toArray($request->file);

        $excel_columns = array_filter($headings[0][0]);

        $required_columns = [
            'product_name',
            'brand',
            'price',
            'model_name',
            'short_desc',
            'description',
            'featured',
            'available',
            'active_flag'
        ];

        $wrong_columns = array_diff($excel_columns, $required_columns);

        if (count($wrong_columns) != 0) {

            $column_names = implode(', ', $wrong_columns);

            return redirect()->back()->with('error', 'Please check these columns: "'. $column_names .'", in the excel that you have uploaded');
        }

        // To get data as an array
        // $array = Excel::toArray(new ProductsImport, $request->file);
        // $array = (new UsersImport)->toArray('users.xlsx');
        // To get data as an collection
        // $collection = (new UsersImport)->toCollection('users.xlsx');
        // dd($array);

        $import = new ProductsImport();

        // When we don't use importables class we need to access methods like this
            // Excel::import($import, $request->file);

            // When we want to stop the importing and show whre the error has occurred
            // try {
            //     $import->import($request->file);
            //     // Excel::import($import, $request->file);

            // } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            //      $failures = $e->failures();

            //     //  foreach ($failures as $failure) {
            //     //      $failure->row(); // row that went wrong
            //     //      $failure->attribute(); // either heading key (if using heading row concern) or column index
            //     //      $failure->errors(); // Actual error messages from Laravel validator
            //     //      $failure->values(); // The values of the row that has failed.
            //     //  }
            // }

        $import->import($request->file);

        $failures = $import->failures();

        // dd($failures);

        $inserted_rows_count = $import->insertedRowsCount();

        // dd($inserted_rows_count);

        if (count($failures) == 0) {
            return redirect()->back()->with('success', $inserted_rows_count . ' rows has been inserted Successfully !!');
        } else {
            return redirect()->back()->with('import_stats', [$inserted_rows_count, $failures]);
        }

    }

    public function importMultipleSheets(Request $request)
    {

        $rules = [
            'file_two' => 'required|mimes:xlsx,xls|max:2000',
        ];
        $messages = [
            'file_two.required' => 'Please upload a Excel File',
            'file_two.mimes' => 'The file type must be xlsx or xls',
            'file_two.max' => 'File size should not be more than 2000 KiB',
        ];

        $this->validate($request, $rules, $messages);

        // Checking Whether the columns in uploaded excel match with our table column names or not
        $headings = (new HeadingRowImport)->toArray($request->file_two);

        $sheet_one_columns = array_filter($headings[0][0]);

        $sheet_two_columns = array_filter($headings[1][0]);

        $required_sheet_one_columns = [
            'product_name',
            'brand',
            'price',
            'model_name',
            'short_desc',
            'description',
            'featured',
            'available',
            'active_flag'
        ];

        $required_sheet_two_columns = [
            'name'
        ];

        $sheet_one_wrong_columns = array_diff($sheet_one_columns, $required_sheet_one_columns);

        $sheet_two_wrong_columns = array_diff($sheet_two_columns, $required_sheet_two_columns);

        if (count($sheet_one_wrong_columns) != 0 && count($sheet_two_wrong_columns) != 0) {

            $sheet_one_column_names = implode(', ',$sheet_one_wrong_columns);
            $sheet_two_column_names = implode(', ',$sheet_two_wrong_columns);

            return redirect()->back()->with('error', 'Check these columns in sheet one: "'. $sheet_one_column_names .'", and these columns in sheet two: "'. $sheet_two_column_names .'"');
        }

        $import = new MultipleImports;

        $import->import($request->file_two);

        $sheets = $import->getSheetNames();

        // dd($sheets);

        $failures = $import->failures();

        // dd($failures);

        $inserted_rows_count = $import->insertedRowsCountIndividualSheets();

        // dd($inserted_rows_count);

        if (count($failures['Sheet1']) == 0 && count($failures['Sheet2']) == 0) {

            // dd('No Erros Found');

            return redirect()->back()->with('success', $inserted_rows_count . ' rows has been inserted Successfully !!');

        } else {

            // dd('Errors found');

            return redirect()->back()->with('import_multi_stats', [$inserted_rows_count, $failures]);
        }
    }
}

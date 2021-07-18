<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    public function index()
    {
        return view('dashboard.ajax.index');
    }

    public function getProducts()
    {
        $products = Product::limit(15)->get();
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $rules = array(
            'product_name' => 'required|min:3|max:25',
            'brand' => 'required|min:3|max:25',
            'price' => 'required',
            'model_name' => 'required|min:3|max:25',
            'featured' => 'required',
            'available' => 'required',
            'active_flag' => 'required',
            'description' => 'required|min:10'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            $data =  $validator->errors()->toArray();
            return response()->json($data, 422);
        }

        $requestData = $request->all();

        unset($requestData['_token']);

        $requestData['product_slug'] = Str::slug($requestData['product_name'], '-');
        $requestData['short_desc'] = Str::limit($requestData['description'], 10, '');

        Product::create($requestData);

        $data = array(
            'message' => "Product Added Successfully !!"
        );
        return response()->json($data, 200);
    }

    public function edit(Request $request, Product $product)
    {
        return response()->json($product, 200);
    }
}

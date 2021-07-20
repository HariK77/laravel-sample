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
        $products = Product::latest()->paginate(10);
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

    public function edit(Product $product)
    {
        return response()->json($product, 200);
    }

    public function update(Request $request, Product $product)
    {
        // dd($request->all());

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
        unset($requestData['product_id']);

        $requestData['product_slug'] = Str::slug($requestData['product_name'], '-');
        $requestData['short_desc'] = Str::limit($requestData['description'], 10, '');

        $product->update($requestData);

        $data = array(
            'message' => "Product Updated Successfully !!"
        );

        return response()->json($data, 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        $data = array(
            'message' => "Product deleted Successfully !!"
        );
        return response()->json($data, 200);
    }
}

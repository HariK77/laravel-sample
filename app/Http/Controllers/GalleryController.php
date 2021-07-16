<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::paginate(10);
        return view('dashboard.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.gallery.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //server validation
        $rules = [
            'category_id' => 'required|numeric',
            'file' => 'required|mimes:jpeg,png,jpg|image|max:2000|dimensions:width=1920,height=1080',
            'description' => 'required|min:3|max:1000'
        ];
        $messages = [
            'category_id.required' => 'Please select a category',
            'file.required' => 'Please upload a image',
            'file.mimes' => 'The image must be a file of type: jpeg, jpg, png',
            'file.max' => 'Image size should not be more than 2 MB',
        ];

        $request_data = request()->validate($rules, $messages);

        unset($request_data['file']);

        $request_data['file_path'] = Helper::moveFile($request->file);

        Gallery::create($request_data);

        return redirect()->route('gallery.index')->with('success', 'Gallery Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $categories = Category::all();
        return view('dashboard.gallery.edit', compact('categories', 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //server validation
        $rules = [
            'category_id' => 'required|numeric',
            'file' => 'sometimes|required|mimes:jpeg,png,jpg|image|max:2000|dimensions:width=1920,height=1080',
            'description' => 'required|min:3|max:1000'
        ];
        $messages = [
            'category_id.required' => 'Please select a category',
            'file.required' => 'Please upload a image',
            'file.mimes' => 'The image must be a file of type: jpeg, jpg, png',
            'file.max' => 'Image size should not be more than 2 MB',
        ];

        $request_data = request()->validate($rules, $messages);

        if ($request->hasFile('file')) {

            $request_data['file_path'] = Helper::moveFileAndDeleteOld($request->file, $gallery->image);

        }

        $gallery->update($request_data);

        return redirect()->route('gallery.index')->with('success', 'Gallery Image Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {

        // Helper::deleteFile($gallery->file_path);

        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Gallery Image Deleted Successfully');
    }
}

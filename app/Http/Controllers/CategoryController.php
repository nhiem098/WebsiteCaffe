<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Str;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'messeger'  => 'Get list category successfully',
            'result'    => $categories
        ], 200);
    }

    public function show($category)
    {
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'messeger'  => 'Get category successfully',
            'result'    => Category::with('product')->find($category)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $request['slug'] = Str::slug($request->name);
            $request->has('active') ? $request['active'] = true : $request['active'] = false;
            Category::create($request->all());
            return response()->json([
                'code'      => 200,
                'status'    => 'success',
                'messeger'  => 'Add category successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code'      => 200,
                'status'    => 'failed',
                'messeger'  => 'Add category failed',
            ], 200);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request)
    {
        $request['slug'] = Str::slug($request->slug);
        $request->has('active') ? $request['active'] = true : $request['active'] = false;
        $category = Category::find($request->id)->update($request->all());
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'messeger'  => 'Update category successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        if (Category::find($category)->delete())
            return response()->json([
                'code'      => 200,
                'status'    => 'success',
                'messeger'  => 'Delete category successfully',
            ], 200);
        else
            return response()->json([
                'code'      => 400,
                'status'    => 'failed',
                'messeger'  => 'Delete category failed',
            ], 400);
    }
}

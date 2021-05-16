<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product, Category};
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Str;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $category = $request->get('category',null);
        $pageLength = $request->get('length',5);
        $pageLength = (int)$pageLength;
        $products = Product::where('category_id', $category)->paginate($pageLength,'*','page',$page);
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'messeger'  => 'Get list product successfully',
            'result'    => $products
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $request['slug'] = Str::slug($request->name);
            $request->has('active') ? $request['active'] = true : $request['active'] = false;
            Product::create($request->all());
            return response()->json([
                'code'      => 200,
                'status'    => 'success',
                'messeger'  => 'Add product successfully',
            ], 200);
        } catch (\Throwable $th) {
            return $th;
        }

    }

    protected function saveImage($request){
        $data = $request->except('avatar');
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $fileName = Carbon::now()->format('YmdHis').'_'.$file->getClientOriginalName();
            $path = base_path() . '/public/storage/images/avatar';
            $file->move($path, $fileName);
            $fullName = 'storage/images/avatar/' . $fileName;
            $data['avatar'] = $fullName;
            return $data;
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'messeger'  => 'Get product successfully',
            'result'    => Product::find($product)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request)
    {
        $request['slug'] = Str::slug($request->slug);
        $request->has('active') ? $request['active'] = true : $request['active'] = false;
        Product::find($request->id)->update($request->all());
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'messeger'  => 'Update product successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        if(Product::find($product)->delete())
            return response()->json([
                'code'      => 200,
                'status'    => 'success',
                'messeger'  => 'Delete product successfully',
            ], 200);
        else
            return response()->json([
                'code'      => 200,
                'status'    => 'failed',
                'messeger'  => 'Delete product failed',
            ], 200);
    }
}

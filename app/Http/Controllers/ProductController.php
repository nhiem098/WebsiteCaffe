<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product, Category};
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::get();
        return view('backend.product.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['categories'] = Category::where('parent_id',0)->get();
        foreach($data['categories'] as $category){
            $category['child'] = false;
            $category['children'] = $category->children;
            if($category['children']->count() !=0) $category['child'] = true;
        }
        return view('backend.product.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request['slug'] = Str::slug($request->name);
        $request->has('active') ? $request['active'] = true : $request['active'] = false;
        Product::create($this->saveImage($request));
        return back();
    }

    protected function saveImage($request){
        $data = $request->except('avatar');
        //delete old img if any
        // if(Auth::user()->avatar && File::exists(base_path().'/public/'.Auth::user()->avatar)){
        //     File::delete(base_path().'/public/'.Auth::user()->avatar);
        // }
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $data['categories'] = Category::where('parent_id',0)->get();
        foreach($data['categories'] as $category){
            $category['child'] = false;
            $category['children'] = $category->children;
            if($category['children']->count() !=0) $category['child'] = true;
        }
        $data['product'] = Product::find($product);
        return view('backend.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        $request['slug'] = Str::slug($request->slug);
        $request->has('active') ? $request['active'] = true : $request['active'] = false;
        if($request->hasFile('avatar')){
            Product::find($product)->update($this->saveImage($request));
        }else{
            unset($request['avatar']);
            Product::find($product)->update($request->all());
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        Product::find($product)->delete();
        return redirect()->route('product.index');
    }
}

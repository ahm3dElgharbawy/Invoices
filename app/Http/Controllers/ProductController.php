<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::get();
        $sections = Section::get();
        return view('products.product',compact('products','sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'product_name' => 'required|unique:products|max:255',
                'section_id' => 'required',
            ],
            $messages = [
                'product_name.required' => 'اسم المنتج مطلوب',
                'product_name.unique' => 'المنتج موجود بالفعل',
                'section_id.required' => 'اسم القسم مطلوب'
            ]
        );

        if ($validator->fails()) {
            return redirect('products')
                ->withErrors($validator)
                ->withInput();
        }

        Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $request->section_id,

        ]);
        return redirect('products')->with('add', 'تم اضافة المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'product_name' => 'required|max:255|unique:products,product_name,'.$id,
                'section_id' => 'required',
            ],
            $messages = [
                'product_name.required' => 'اسم المنتج مطلوب',
                'product_name.unique' => 'المنتج موجود بالفعل',
                'section_id.required' => 'اسم القسم مطلوب'
            ]
        );

        if ($validator->fails()) {
            return redirect('products')
                ->withErrors($validator)
                ->withInput();
        }

        Product::find($id)->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $request->section_id,

        ]);
        return redirect('products')->with('add', 'تم تعديل المنتج بنجاح');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request -> id;
        $exist = Product::where('id','=',$id)->exists();
        if(!$exist){
            return redirect('/404');
        }
        Product::find($id)->delete();
        return redirect('products')->with('delete', 'تم حذف المنتج بنجاح');
    }
}

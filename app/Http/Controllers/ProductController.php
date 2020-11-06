<?php

namespace App\Http\Controllers;

use App\product;
use App\section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=section::all();
        $products=product::all();
        return view('products.products',compact('products','sections'));
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
              ////first check the section already exists or no 
              $input=$request->all();
              $exists=product::where('Product_name','=',$input['Product_name'])->exists();
              if($exists){
                       /////messages
              toastr()->error('هذا المنتج موجود بالفعل');
              ///////////
              return redirect()->back();
              }
              
              //validation befor store
            $this->validate($request,[
      'Product_name' => 'required',

      
              ]);
              ///store sections
      
       $section=product::create([
      'Product_name' => $request->Product_name,
      'description' => $request->description,
      'section_name' => $request->section_name,
              ]);
              /////messages
              toastr()->success('اتم اضافه القسم بنجاح');
              ///////////
              return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = product::where('section_name', $request->section_name)->first()->id;

        $Products = Product::findOrFail($request->pro_id);
 
        $Products->update([
        'Product_name' => $request->Product_name,
        'description' => $request->description,
        'section_id' => $id,
        ]);
             
             //////alert
    
      toastr()->success('تم تعديل القسم بنجاح');
      /////return
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        product::destroy($id);
        
        ////alert
        toastr()->success('تم مسح القسم بنجاح');
        return redirect()->back();

    }
}

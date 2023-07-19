<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','store']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);


        }

    public function index(Request $request)
    {

        $data = Product::query()->get();
        $word = $request->search;

        return view('layouts.dashboard.products.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $categories=Category::all();
        return view('layouts.dashboard.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name_en' => 'required|unique:products,name',
            'name_ar' => 'required|unique:products,name',
            'stock' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'image' => 'required|mimes:png,jpg',
            'category_id' => 'required'

        ]);



        $image = $request->file('image');
        $imagename = $image->getClientOriginalName();
        $image->move(public_path('uploads/product_images'), $imagename);
        $product = new Product();

        $product->setTranslation('name', 'en', $request->name_en);
        $product->setTranslation('name', 'ar', $request->name_ar);
        $product->stock = $request->stock;
        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->sale_price;
        $product->category_id = $request->category_id;
        $product->image = $imagename;
        $product->save();
        return redirect()->route('products.index')
            ->with('success', 'product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('layouts.dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  $categories=Category::all();
        $product = Product::find($id);
        return view('layouts.dashboard.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        if ($request->file('image')) {

            $rules = [
                'image' => 'required|'

            ];

            $request->validate($rules);
            //delete old image
            Storage::delete($product->image_path);
            //save new image
            $image = $request->file('image');
            $imagename = $image->getClientOriginalName();
            $image->move(public_path('uploads/product_images'), $imagename);
        }


     //   $input = $request->except('name_en', 'name_ar');

        $product->update([
            'name' =>
            [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'stock' => $request->stock,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'image' => $imagename,
            'category_id' => $request->category_id

        ]);

        return redirect()->route('products.index')
            ->with('success', 'product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = Product::find($id);
        //delete image
        $destination=public_path('uploads/product_images/'.$product->image);

        if(File::exists($destination)){
            File::delete($destination);
        }

        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'products deleted successfully');
    }
}

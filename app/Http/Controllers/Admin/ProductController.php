<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Query Builder
        //    $product = DB::table('products')->join('product_category','products.product_category_id','=','product_category.id')
        //    ->select('products.*','product_category.name as product_category_name')
        //    ->paginate(10);
        
        $product = Product::query();

        if ($request->keyword) {
            
            $product = $product->where('name','like','%'.$request->keyword.'%');
        }

        $product = Product::paginate(2);
        return view('admin.pages.product.list', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $categoryList = DB::table('product_category')->where('status',1)->get();
        $categoryList = ProductCategory::where('status', 1)->get();
        return view('admin.pages.product.create', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->product_category);
        $params = Arr::except($request->all(), ['_token', 'image_url']);
        // $params = Arr::add($params,'product_category_id',1);

        $params = Arr::add($params, 'image_url', 'empty');
        if ($request->hasFile('image_url')) {
            $originName = $request->file('image_url')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('image_url')->move(public_path('images'), $fileName);
            $params = Arr::except($params, ['image_url']);
            $params = Arr::add($params, 'image_url', $fileName);
        }
        $check = Product::create($params);
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //$product = Product::find($id);
        $categoryList = ProductCategory::where('status', 1)->get();
        return view('admin.pages.product.edit', compact('product', 'categoryList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $params = Arr::except($request->all(), ['_token']);
        // $params = Arr::add($params,'product_category_id',1);
        //$product = Product::find($id);

        $params = Arr::add($params, 'image_url', $product->image_url);
        if ($request->hasFile('image_url')) {
            $originName = $request->file('image_url')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('image_url')->move(public_path('images'), $fileName);
            $params = Arr::except($params, ['image_url']);
            $params = Arr::add($params, 'image_url', $fileName);

            if (!is_null($product->image_url) && file_exists('images/' . $product->image_url)) {
                unlink('images/' . $product->image_url);
            }
        }
        $check = $product->update($params);
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        //$product = Product::find($id);
        $check = $product->delete();

        return redirect()->route('admin.product.index');
    }
}

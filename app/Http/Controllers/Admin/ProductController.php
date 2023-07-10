<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $pipelines = [
            \App\Filters\ByKeyword::class,
            \App\Filters\ByStatus::class,
            \App\Filters\ByMinMax::class,
        ];

        $pipeline = Pipeline::send(Product::query())
        ->through($pipelines)
        ->thenReturn();

        // $product = Product::query();
        // $filter = [];
        
        // if ($request->keyword) {
        //     $filter[] = ['name','like','%'.$request->keyword.'%'];
        // }
        // if($request->status != ""){
        //     $filter[] = ['status',$request->status];
        // }
        // if($request->amount_start && $request->amount_end){
        //     // $filter[] = ['price','>=',$request->amount_start];
        //     // $filter[] = ['price','<=',$request->amount_end];
        //     $product = $product->whereBetween('price',[$request->amount_start,$request->amount_end]);
        // }
        // if($request->sort){
        //     $sortBy = ['id', 'desc'];
        //     switch($request->sort){
        //         case 1:
        //             $sortBy = ['price','asc'];
        //             break;
        //         case 2:
        //             $sortBy = ['price','desc'];
        //             break;
        //         default: 
        //             $sortBy = ['id', 'desc'];
        //             break;
        //     }
        //     $product = $product->orderBy($sortBy[0],$sortBy[1]);
        // }

        $product = $pipeline->paginate(5);
        // dd($product->toSql(),$product->getBindings());  
        $maxPrice = Product::max('price');
        return view('admin.pages.product.list', compact('product','maxPrice'));
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
        if($check){
            toastr()->success("Delete product successfull");
        }
        
        return redirect()->route('admin.product.index');
    }

    public function restore(string $product){
        $products = Product::withTrashed()->find($product);
        // $products->deleted_at = null;
        // $products->save();
        $products->restore();
        return redirect()->route('admin.product.index');
    }
}

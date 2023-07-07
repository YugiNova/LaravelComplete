<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    //
    public function store(Request $request)
    {
        // dd($request->name);
        $request->validate(
            [
                'name' => 'required|min:3|string|unique:product_category,name',
                'slug' => 'required|min:3|string',
                'status' => 'required|boolean',
            ],
            [
                'name.required' => 'Name is required',
                'name.min' => 'Name have to least 3 character',
                'slug.required' => 'Slug is required',
                'slug.min' => 'Slug have to least 3 character', 
                'status.required' => 'Status is required',
                'status.boolean' => 'Status is required',
            ],
        );
            //$check = DB::insert('INSERT INTO product_category (name,slug,status) VALUES (?,?,?)',[$request->name,$request->slug,$request->status]);
            $check = DB::table('product_category')->insertGetId([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'status' => $request->status
            ]);
            $msg = $check ? "Create product category successfull" : "Create product category fail";
            
            toastr()->success($msg);
        return redirect()->route('admin.product_category');
    }

    public function getSlug (Request $request) {
        $slug = Str::slug($request->name);
        return response()->json(['slug'=>$slug]);
    }

    public function index (Request $request) {
        // $page = $request->page ?? 1;
        // $itemPerPage = 2;

        // $offset = ($page-1) * $itemPerPage;
        
        // $total = DB::select('SELECT * FROM product_category');
        // $numberOfPage = ceil(count($total) / $itemPerPage);

        // $productCategory = DB::select('SELECT * FROM product_category limit ?,?',[$offset,$itemPerPage]);
        // return view('admin.pages.product_category.list', compact('productCategory','numberOfPage'));
        // $productCategory = DB::table('product_category')->paginate(5);
        $productCategory = ProductCategory::paginate(5);
        return view('admin.pages.product_category.list', compact('productCategory'));
    }

    public function detail ($id) {
        $productCategory = DB::select('SELECT * FROM product_category where id = ?',[$id])[0];
        
        return view('admin.pages.product_category.detail', ['productCategory'=>$productCategory]);
    }

    public function update (UpdateProductCategoryRequest $request, $id) {

        // $check = DB::update('UPDATE product_category set name = ?, slug = ?, status = ?  where id = ?',[$request->name,$request->slug,$request->status,$id]);
        $check = DB::table('product_category')->where(['id'=>$id])
        ->update([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'status'=>$request->status
        ]);
        $msg = $check > 1 ? "Update product category successfull" : "Update product category fail";
            
        toastr()->success($msg);

        return redirect()->route('admin.product_category');
    }

    public function destroy ($id) {
        $check = DB::delete('DELETE FROM product_category WHERE id = ?',[$id]);
        $msg = $check? "Delete product category successfull" : "Delete product category fail";
            
        toastr()->success($msg);

        return redirect()->route('admin.product_category');
    }
}

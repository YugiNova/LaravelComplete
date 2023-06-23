<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
                'name' => 'required|min:3|string',
                //'slug' => 'required|min:3|string',
                'status' => 'required|boolean',
            ],
            [
                'name.required' => 'Name is required',
                'name.min' => 'Name have to least 3 character',
                'slug.required' => 'Slug is required',
                //'slug.min' => 'Slug have to least 3 character', 
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
}

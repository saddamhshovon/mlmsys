<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use Illuminate\Support\Facades\File;

use Image;

class ProductController extends Controller
{
    public function allProduct()
    {
        $products = Product::latest()->get();
        return view('admin.products.all_product', compact('products'));
    }

    public function addProduct()
    {
        return view('admin.products.add_product');
    }

    public function storeProduct(Request $request)
    {
        $request->validate(
            [
                'product_name' => 'required',
                'product_category' => 'required',
                'product_code' => 'required',
                'product_price' => 'required',
                'product_image' => 'required|mimes:jpg,jpeg,png,webp',
                'product_pdf' => 'mimes:pdf',
            ],
            [
                'product_pdf.mimes' => 'Please Input a pdf File..',
            ]
        );

        $image = $request->file('product_image');
        $size = $request->file('product_image')->getSize();
        $prod_pdf = $request->file('product_pdf');
        $pdf_name_gen = hexdec(uniqid()) . '.' . $prod_pdf;
        $save_pdf = 'pdf_file' . $pdf_name_gen;
        if ($size > 500000) {
            return redirect()->back()->with('error', 'Image Size Should Not be Greater Than 500 KB');
        } else {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'images/product/' . $name_gen;
            Image::make($image)->resize(200, 200)->save($save_url);
            Product::insert(
                [
                    'product_name' => $request->product_name,
                    'product_category' => $request->product_category,
                    'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                    'product_code' => $request->product_code,
                    'product_price' => $request->product_price,
                    'product_description' => $request->product_description,
                    'product_image' => $save_url,
                    'product_pdf' => $save_pdf,
                ]
            );
            return redirect()->back()->with('success', 'Product Added Successfully..!');
        }
    }
}

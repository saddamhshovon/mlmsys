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
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'images/product/' . $name_gen;
        Image::make($image)->save($save_url);
        $prod_pdf = $request->file('product_pdf');

        if (($size <= 500000) && (empty($prod_pdf))) {
            Product::insert(
                [
                    'product_name' => $request->product_name,
                    'product_category' => $request->product_category,
                    'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                    'product_code' => $request->product_code,
                    'product_price' => $request->product_price,
                    'product_description' => $request->product_description,
                    'product_image' => $save_url
                ]
            );
            return redirect()->back()->with('success', 'Product Added Successfully..!');
        } else if (($size <= 500000) && (!empty($prod_pdf))) {
            $pdf_name_gen = hexdec(uniqid()) . '.' . 'pdf';
            $save_pdf = 'pdf_file/' . $pdf_name_gen;
            $prod_pdf->move(public_path('pdf_file/'), $pdf_name_gen);
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
        } else {
            return redirect()->back()->with('error', 'Image Size Should Not be Greater Than 500 KB');
        }
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit_product', compact('product'));
    }

    /////          PRODUCT UPDATE         /////

    public function updateProduct(Request $request)
    {
        $product_id = $request->id;
        $old_image = $request->old_image;
        $old_pdf = $request->old_pdf;

        $request->validate(
            [
                'product_name' => 'required',
                'product_category' => 'required',
                'product_code' => 'required',
                'product_price' => 'required',
                'product_image' => 'required',
                'product_pdf' => 'mimes:pdf'
            ],
            [
                'product_pdf.mimes' => 'Please Input a pdf File..'
            ]
        );

        if (($request->file('product_image')) || ($request->file('product_pdf'))) {
            if ($request->file('product_image')) {
                unlink($old_image);
                $image = $request->file('product_image');
                $size = $request->file('product_image')->getSize();
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'images/product/' . $name_gen;
                Image::make($image)->save($save_url);

                if ($size > 500000) {
                    return redirect()->back()->with('error', 'Image Size Should Not be Greater Than 500 KB');
                } else {
                    Product::findOrFail($product_id)->update(
                        [
                            'product_name' => $request->product_name,
                            'product_category' => $request->product_category,
                            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                            'product_code' => $request->product_code,
                            'product_price' => $request->product_price,
                            'product_description' => $request->product_description,
                            'product_image' => $save_url,
                        ]
                    );
                    return redirect()->route('product.all')->with('success', 'Product Updated Successfully..!');
                }
            } elseif ($request->file('product_pdf')) {
                $tmp_pdf = $old_pdf;
                $prod_pdf = $request->file('product_pdf');
                $pdf_name_gen = hexdec(uniqid()) . '.' . 'pdf';
                $save_pdf = 'pdf_file/' . $pdf_name_gen;
                $prod_pdf->move(public_path('pdf_file/'), $pdf_name_gen);
                if ($tmp_pdf == "N/A") {
                    Product::findOrFail($product_id)->update(
                        [
                            'product_name' => $request->product_name,
                            'product_category' => $request->product_category,
                            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                            'product_code' => $request->product_code,
                            'product_price' => $request->product_price,
                            'product_description' => $request->product_description,
                            'product_pdf' => $save_pdf,
                        ]
                    );
                    return redirect()->route('product.all')->with('success', 'Product Updated Successfully..!');
                } else {
                    unlink($old_pdf);
                    Product::findOrFail($product_id)->update(
                        [
                            'product_name' => $request->product_name,
                            'product_category' => $request->product_category,
                            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                            'product_code' => $request->product_code,
                            'product_price' => $request->product_price,
                            'product_description' => $request->product_description,
                            'product_pdf' => $save_pdf,
                        ]
                    );
                    return redirect()->route('product.all')->with('success', 'Product Updated Successfully..!');
                }
            } else {
                //2nd if block's else for image
                unlink($old_image);
                unlink($old_pdf);
                $image = $request->file('product_image');
                $size = $request->file('product_image')->getSize();
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'images/product/' . $name_gen;
                Image::make($image)->save($save_url);
                $tmp_pdf = $old_pdf;
                $prod_pdf = $request->file('product_pdf');
                $pdf_name_gen = hexdec(uniqid()) . '.' . 'pdf';
                $save_pdf = 'pdf_file/' . $pdf_name_gen;
                $prod_pdf->move(public_path('pdf_file/'), $pdf_name_gen);

                Product::findOrFail($product_id)->update(
                    [
                        'product_name' => $request->product_name,
                        'product_category' => $request->product_category,
                        'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                        'product_code' => $request->product_code,
                        'product_price' => $request->product_price,
                        'product_description' => $request->product_description,
                        'product_image' => $save_url,
                        'product_pdf' => $save_pdf
                    ]
                );
                return redirect()->route('product.all')->with('success', 'Product Updated Successfully..!');
            }
        } else {
            // 1st if block's else
            Product::findOrFail($product_id)->update(
                [
                    'product_name' => $request->product_name,
                    'product_category' => $request->product_category,
                    'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                    'product_code' => $request->product_code,
                    'product_price' => $request->product_price,
                    'product_description' => $request->product_description
                ]
            );
            return redirect()->route('product.all')->with('success', 'Product Updated Successfully..!');
        }
    }

    /////          PRODUCT UPDATE END         /////

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $image = $product->product_image;
        $pdfFile = $product->product_pdf;
        if ($pdfFile != "N/A") {
            unlink($image);
            unlink($pdfFile);
            Product::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Product Deleted Successfully..');
        } else {
            unlink($image);
            Product::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Product Deleted Successfully..');
        }
    }
}

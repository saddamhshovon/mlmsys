<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Carbon;
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
        $name_gen = date('YmdHis') . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/product'), $name_gen);
        $save_url = 'images/product/' . $name_gen;
        //Image::make($image)->resize(300, 300)->save($save_url);
        $prod_pdf = $request->file('product_pdf');

        if (($size <= 10000000) && (empty($prod_pdf))) {
            Product::insert(
                [
                    'product_name' => $request->product_name,
                    'product_category' => $request->product_category,
                    'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                    'product_code' => $request->product_code,
                    'product_price' => $request->product_price,
                    'product_description' => $request->product_description,
                    'product_image' => $save_url,
                    'created_at' => Carbon::now()
                ]
            );
            return redirect()->back()->with('success', 'Product Added Successfully..!');
        } else if (($size <= 100000000) && (!empty($prod_pdf))) {
            $pdf_name_gen = hexdec(uniqid()) . '.' . 'pdf';
            $save_pdf = 'pdf_file/' . $pdf_name_gen;
            $prod_pdf->move(public_path('pdf_file'), $pdf_name_gen);
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
                    'created_at' => Carbon::now()
                ]
            );
            return redirect()->back()->with('success', 'Product Added Successfully..!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Image Size Should Not be Greater Than 10 MB & PDF 100MB');
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
        $old_image = public_path($request->old_image);
        $old_pdf = public_path($request->old_pdf);

        $request->validate(
            [
                'product_name' => 'required',
                'product_category' => 'required',
                'product_code' => 'required',
                'product_price' => 'required',
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
                $name_gen = date('YmdHis') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/product'), $name_gen);
                $save_url = 'images/product/' . $name_gen;
                //Image::make($image)->resize(300, 300)->save($save_url);

                if ($size > 10000000) {
                    return redirect()->back()->with('error', 'Image Size Should Not be Greater Than 10 MB');
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
                $tmp_pdf = $request->old_pdf;
                $prod_pdf = $request->file('product_pdf');
                $pdf_name_gen = hexdec(uniqid()) . '.' . 'pdf';
                $save_pdf = 'pdf_file/' . $pdf_name_gen;
                $prod_pdf->move(public_path('pdf_file'), $pdf_name_gen);
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
                //Image::make($image)->resize(300, 300)->save($save_url);
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

    public function activeProduct($id)
    {
        $status = Product::findOrFail($id);
        $status->status = 1;
        $status->save();
        return redirect()->back();
    }

    public function inactiveProduct($id)
    {
        $status = Product::findOrFail($id);
        $status->status = 0;
        $status->save();
        return redirect()->back();
    }

    public function userAllProduct()
    {
        $products = Product::latest()->where('status', '1')->paginate(8);
        return view('member.product.all', compact('products'));
    }

    public function buyProduct($name, $id)
    {
        $member_id = session('MEMBER_ID');
        $product_id = $id;

        $member = Member::findOrFail($member_id);
        $product = Product::findOrFail($product_id);
        // dd($product_id);
        return view('member.product.order', compact('member', 'product'));
    }

    public function orderProduct(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'pin' => 'required',
            ]
        );
        // dd($request->all());
        $member_id = session('MEMBER_ID');
        // dd($member_id);
        $pin = Member::where('id', $member_id)->get('pin');
        // dd($pin);
        $balance = Member::where('id', $member_id)->get('account_balance');
        // dd($balance->all());

        $product_id = $request->product_id;
        $price = Product::where('id', $product_id)->get('product_price');
        // $price = $product->product_price;
        // dd($price->all());
        $order = new Order;
        $order->member_id = $member_id;
        $order->product_id = $product_id;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->country = $request->country;
        $order->price = $price[0]->product_price;
        // dd($order->all());
        if ($request->pin == $pin[0]->pin) {
            if ($balance[0]->account_balance < $price[0]->product_price) {
                return redirect()->back()->withInput()->with('error', 'Insufficient Balance');
            } else {
                $order->save();

                $newBalance = $balance[0]->account_balance - $price[0]->product_price;
                $member = Member::findOrFail($member_id);
                $member->account_balance = $newBalance;
                $member->update();

                return redirect()->back()->withInput()->with('success', 'Order Placed Successfully, please check your order history');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Pin Did not match');
        }
    }

    public function memberProductOrderHistory()
    {
        $member_id = session('MEMBER_ID');
        $history = Order::where('member_id', $member_id)->latest()->paginate(8);
        return view('member.history.product-order', compact('history'));
    }

    public function allProductOrderHistory()
    {
        $history = Order::latest()->get();
        return view('admin.products.all-order', compact('history'));
    }

    public function approveProductOrderHistory($id)
    {
        $status = Order::findOrFail($id);
        $status->is_delivered = 1;
        $status->update();
        return redirect()->back()->with('success', 'Approved Order Successfully..');
    }

    public function deleteProductOrderHistory($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Order History Deleted Successfully..');
    }
}

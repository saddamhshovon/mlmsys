<?php

namespace App\Http\Controllers;

use App\Models\homestart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeStartSection()
    {
        $homestart = homestart::first();
        return view('admin.home.start', compact('homestart'));
    }

    public function homeStartSubmit(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:width=500,height=500',
                'title' => 'required',
                'subtitle' => 'required',
            ]
        );

        $homestart = new homestart();
        $homestart->title = $request->title;
        $homestart->subtitle = $request->subtitle;

        if (empty(homestart::first())) {

            $file = $request->file('image');
            $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('images/home'), $filename);
            $homestart->image = $filename;
            $homestart->save();
            return redirect()->back()->with('success', 'Home Start Section Added Successfully');
        } elseif (!empty(homestart::first())) {

            $homestart = homestart::first();
            $image = homestart::first()->image;
            if (!empty($image)) {
                $file = $request->file('image');
                @unlink(public_path('images/home/' . $homestart->image));

                $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('images/home'), $filename);
                $homestart->image = $filename;
                $homestart->save();
                return redirect()->back()->with('success', 'Home Start Section Changed Successfully');
            } elseif (empty($image)) {
                $file = $request->file('image');
                $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('images/home'), $filename);
                $homestart->image = $filename;
                $homestart->save();
                return redirect()->back()->with('success', 'Home Start Section Added Successfully');
            } else {
                return redirect()->back()->with('success', 'Uploading Failed');
            }
        }
    }
}

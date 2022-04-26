<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use App\Models\HomeFooter;
use App\Models\HomeGoal;
use App\Models\HomeOurWork;
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
                'image' => 'image|mimes:jpeg,png,jpg,svg,webp|max:10240',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:10240|dimensions:width=500,height=500',
                'logo_title' => 'required',
                'title' => 'required',
                'subtitle' => 'required',
            ]
        );

        $homestart = new homestart();
        $homestart->logo_title = $request->logo_title;
        $homestart->title = $request->title;
        $homestart->subtitle = $request->subtitle;

        $file = $request->file('image');

        if (empty(homestart::first())) {

            $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/home'), $filename);
            $file_path = 'images/home/' . $filename;
            $homestart->image = $file_path;
            $homestart->save();
            return redirect()->back()->with('success', 'Home Start Section Added Successfully');
        } elseif (!empty(homestart::first())) {

            $homestart = homestart::first();
            $image = homestart::first()->image;
            $image_path = public_path('images/home/' . $homestart->image);

            if (!empty($image) && ($request->image)) {
                // $file = $request->file('image');
                @unlink($image_path);

                $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file_path = 'images/home/' . $filename;

                $file->move(public_path('images/home'), $filename);
                $homestart->image = $file_path;
                $homestart->logo_title = $request->logo_title;
                $homestart->title = $request->title;
                $homestart->subtitle = $request->subtitle;
                $homestart->update();
                return redirect()->back()->with('success', 'Home Start Section Changed Successfully');
            } elseif (!empty($image) && (empty($request->image))) {
                $homestart->logo_title = $request->logo_title;
                $homestart->title = $request->title;
                $homestart->subtitle = $request->subtitle;
                $homestart->update();
                return redirect()->back()->with('success', 'Home Start Section Added Successfully');
            } else {
                return redirect()->back()->with('success', 'Uploading Failed');
            }
        }
    }

    /////////       HOME ABOUT Section          ///////////

    public function homeAboutSection()
    {
        $homeAbout = HomeAbout::first();
        return view('admin.home.about', compact('homeAbout'));
    }

    public function homeAboutSubmit(Request $request)
    {
        $request->validate(
            [
                'image' => 'image|mimes:jpeg,png,jpg,svg,webp|max:10240',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:10240|dimensions:width=500,height=500',
                'title' => 'required',
                'subtitle' => 'required',
            ]
        );

        $homeAbout = new HomeAbout();
        $homeAbout->title = $request->title;
        $homeAbout->subtitle = $request->subtitle;

        $file = $request->file('image');

        if (empty(HomeAbout::first())) {

            $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/home'), $filename);
            $homeAbout->image = $filename;
            $homeAbout->save();
            return redirect()->back()->with('success', 'Home About Section Added Successfully');
        } elseif (!empty(HomeAbout::first())) {

            $homeAbout = HomeAbout::first();
            $image = HomeAbout::first()->image;
            $image_path = public_path('images/home/' . $homeAbout->image);
            if (!empty($image) && ($request->image)) {
                // $file = $request->file('image');
                @unlink($image_path);

                $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('images/home'), $filename);
                $homeAbout->image = $filename;
                $homeAbout->title = $request->title;
                $homeAbout->subtitle = $request->subtitle;
                $homeAbout->update();
                return redirect()->back()->with('success', 'Home About Section Changed Successfully');
            } elseif (!empty($image) && (empty($request->image))) {
                $homeAbout->title = $request->title;
                $homeAbout->subtitle = $request->subtitle;
                $homeAbout->update();
                return redirect()->back()->with('success', 'Home About Section Added Successfully');
            } else {
                return redirect()->back()->with('success', 'Uploading Failed');
            }
        }
    }

    //////////                HOME WORK SECTION              /////////////

    public function homeWorkSection()
    {
        $homeWork = HomeOurWork::first();
        return view('admin.home.work', compact('homeWork'));
    }

    public function homeWorkSubmit(Request $request)
    {
        $request->validate(
            [
                'image' => 'image|mimes:jpeg,png,jpg,svg,webp|max:10240',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:10240|dimensions:width=500,height=500',
                'title' => 'required',
                'subtitle' => 'required',
            ]
        );

        $homeWork = new HomeOurWork();
        $homeWork->title = $request->title;
        $homeWork->subtitle = $request->subtitle;

        $file = $request->file('image');

        if (empty(HomeOurWork::first())) {

            $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/home'), $filename);
            $homeWork->image = $filename;
            $homeWork->save();
            return redirect()->back()->with('success', 'Home Work Section Added Successfully');
        } elseif (!empty(HomeOurWork::first())) {

            $homeWork = HomeOurWork::first();
            $image = HomeOurWork::first()->image;
            $image_path = public_path('images/home/' . $homeWork->image);
            if (!empty($image) && ($request->image)) {
                // $file = $request->file('image');
                @unlink($image_path);

                $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('images/home'), $filename);
                $homeWork->image = $filename;
                $homeWork->title = $request->title;
                $homeWork->subtitle = $request->subtitle;
                $homeWork->update();
                return redirect()->back()->with('success', 'Home Work Section Changed Successfully');
            } elseif (!empty($image) && (empty($request->image))) {
                $homeWork->title = $request->title;
                $homeWork->subtitle = $request->subtitle;
                $homeWork->update();
                return redirect()->back()->with('success', 'Home Work Section Added Successfully');
            } else {
                return redirect()->back()->with('success', 'Uploading Failed');
            }
        }
    }

    //////////                HOME GOAL SECTION              /////////////

    public function homeGoalSection()
    {
        $homeGoal = HomeGoal::first();
        return view('admin.home.goal', compact('homeGoal'));
    }

    public function homeGoalSubmit(Request $request)
    {
        $request->validate(
            [
                'image' => 'image|mimes:jpeg,png,jpg,svg,webp|max:10240',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:10240|dimensions:width=500,height=500',
                'title' => 'required',
                'subtitle' => 'required',
            ]
        );

        $homeGoal = new HomeGoal();
        $homeGoal->title = $request->title;
        $homeGoal->subtitle = $request->subtitle;

        $file = $request->file('image');

        if (empty(HomeGoal::first())) {

            $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/home'), $filename);
            $homeGoal->image = $filename;
            $homeGoal->save();
            return redirect()->back()->with('success', 'Home Goal Section Added Successfully');
        } elseif (!empty(HomeGoal::first())) {

            $homeGoal = HomeGoal::first();
            $image = HomeGoal::first()->image;
            $image_path = public_path('images/home/' . $homeGoal->image);
            if (!empty($image) && ($request->image)) {
                // $file = $request->file('image');
                @unlink($image_path);

                $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('images/home'), $filename);
                $homeGoal->image = $filename;
                $homeGoal->title = $request->title;
                $homeGoal->subtitle = $request->subtitle;
                $homeGoal->update();
                return redirect()->back()->with('success', 'Home Goal Section Changed Successfully');
            } elseif (!empty($image) && (empty($request->image))) {
                $homeGoal->title = $request->title;
                $homeGoal->subtitle = $request->subtitle;
                $homeGoal->update();
                return redirect()->back()->with('success', 'Home Goal Section Added Successfully');
            } else {
                return redirect()->back()->with('success', 'Uploading Failed');
            }
        }
    }

    //////////            HOME FOOTER SECTION            //////////////

    public function homeFooterSection()
    {
        $homeFooter = HomeFooter::first();
        return view('admin.home.footer', compact('homeFooter'));
    }

    public function homeFooterSubmit(Request $request)
    {
        $homeFooter = new HomeFooter();
        $homeFooter->address = $request->address;
        $homeFooter->email = $request->email;
        $homeFooter->phone = $request->phone;
        $homeFooter->twitter = $request->twitter;
        $homeFooter->facebook = $request->facebook;
        $homeFooter->instagram = $request->instagram;

        if (empty(HomeFooter::first())) {
            $homeFooter->save();
            return redirect()->back()->with('success', 'Footer Section Created Successfully!');
        } elseif (!empty(HomeFooter::first())) {
            $homeFooter = HomeFooter::first();
            $homeFooter->address = $request->address;
            $homeFooter->email = $request->email;
            $homeFooter->phone = $request->phone;
            $homeFooter->twitter = $request->twitter;
            $homeFooter->facebook = $request->facebook;
            $homeFooter->instagram = $request->instagram;
            $homeFooter->update();
            // dd($homeFooter);
            return redirect()->back()->with('success', 'Footer Section Updated Successfully!');
        }
    }

    //////////              Home Notice               /////////////

    public function homeNoticeSection()
    {
        $homeNotice = HomeFooter::first();
        return view('admin.home.notice', compact('homeNotice'));
    }

    public function homeNoticeSubmit(Request $request)
    {
        $homeNotice = new HomeFooter();
        $homeNotice->notice = $request->notice;


        if (empty(HomeFooter::first())) {
            $homeNotice->save();
            return redirect()->back()->with('success', 'Notice Created Successfully!');
        } elseif (!empty(HomeFooter::first())) {

            $homeNotice = HomeFooter::first();
            $homeNotice->notice = $request->notice;

            $homeNotice->update();
            // dd($homeFooter);
            return redirect()->back()->with('success', 'Notice Updated Successfully!');
        }
    }
}

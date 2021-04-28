<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function socialLogin()
    {
        return view('dashboard.pages.settings.social_login');
    } //end of socialLogin

    public function socialLinks()
    {
        return view('dashboard.pages.settings.social_links');
    } //end of socialLinks

    public function store(Request $request)
    {
        setting($request->all())->save();

        alert()->success('Settings Added Successfully');

        return redirect()->back();
    } //end of store
}

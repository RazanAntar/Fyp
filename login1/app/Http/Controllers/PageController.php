<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.welcome');
    }

    public function uploadCv()
    {
        return view('pages.uploadCv');
    }

    public function manageProfile()
    {
        return view('pages.profile');
    }
}


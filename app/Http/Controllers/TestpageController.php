<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestpageController extends Controller
{
    public function showPage()
    {
        return view('frontend.pages.test-start');
    }
}

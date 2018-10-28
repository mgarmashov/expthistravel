<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showPage()
    {
        return view('frontend.pages.profile');
    }
}

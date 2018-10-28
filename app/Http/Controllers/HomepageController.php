<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function showPage()
    {
        return view('frontend.pages.home');
    }

    public function showContacts()
    {
        return view('frontend.pages.contacts');
    }

    public function showHowWeWork()
    {
        return view('frontend.pages.howWeWork');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use App\Notifications\NewMessageNotification;
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

    public function showAbout()
    {
        $about = Page::about();
        return view('frontend.layouts.infoPage-template', [
            'title' => $about->name,
            'content' => $about->content
        ]);
    }

    public function sendContacts(Request $request)
    {
        $admin = User::where('login', env('USER_NOTIFY', 'root'))->first();
        $admin->notify(new NewMessageNotification($request));

    }
}

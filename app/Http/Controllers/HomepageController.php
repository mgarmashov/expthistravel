<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use App\Services\AdminNotifications;
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
        $page = Page::about();
        return view('frontend.layouts.infoPage-template', [
            'title' => $page->name,
            'content' => $page->content
        ]);
    }

    public function showPrivacy()
    {
        $page = Page::privacy();
        return view('frontend.layouts.infoPage-template', [
            'title' => $page->name,
            'content' => $page->content
        ]);
    }

    public function showTerms()
    {
        $page = Page::terms();
        return view('frontend.layouts.infoPage-template', [
            'title' => $page->name,
            'content' => $page->content
        ]);
    }

    public function sendContacts(Request $request)
    {
        AdminNotifications::AdminNotify(new NewMessageNotification($request));
    }
}

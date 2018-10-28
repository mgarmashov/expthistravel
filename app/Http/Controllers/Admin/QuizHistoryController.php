<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use App\Models\QuizHistory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizHistoryController extends Controller
{
    public function showList()
    {

        $sessionList = QuizHistory::all();
        $output = [];
        foreach ($sessionList as $session) {
            $output[$session->session]['user'] = User::find($session->user)->email ?? '';
            $output[$session->session]['date'] = $session->updated_at ?? $session->created_at ?? '';
            $output[$session->session][$session->answer][] = $session->activity;

        }

        $activities = Activity::all();

        return view('admin.pages.quizStatistic', ['data' => $output, 'activities' => $activities]);
    }
}

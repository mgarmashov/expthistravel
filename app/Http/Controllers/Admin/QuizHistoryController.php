<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use App\Models\QuizHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizHistoryController extends Controller
{
    public function showList()
    {
//        $sessionList = QuizHistory::query()->select('session')->distinct('session')->get()->toArray();
//        $sessionList = array_pluck($sessionList, 'session');

        $sessionList = QuizHistory::all();
        $output = [];
        foreach ($sessionList as $session) {
            $output[$session->session][$session->answer][] = $session->activity;

        }

        $activities = Activity::all();

        return view('admin.pages.quizStatistic', ['data' => $output, 'activities' => $activities]);
    }
}

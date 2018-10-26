<?php

namespace App\Http\Controllers;

use App\Models\QuizHistory;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TestpageController extends Controller
{
    public function showPage()
    {
        return view('frontend.pages.test-start');
    }


    public function getQuestion(Request $request)
    {
        $this->writeQuizHistory();

        return $this->nextQuestion();
    }

    protected function writeQuizHistory()
    {
        $session = request()->session()->getId();
        $data = request()->answers;
        foreach ($data as $answer) {

            $query['activity'] = $answer['activity'];
            Auth::check() ? $query['user'] = Auth::user()->id : $query['session'] = $session;

            $newRow = QuizHistory::firstOrCreate($query);
            $newRow->answer = $answer['answer'];
            $newRow->session = $session;
            $newRow->save();

        }
    }

    protected function nextQuestion()
    {
        $excludeList = [];
        foreach (request()->answers as $answer) {
            $excludeList[] = $answer['activity'];
        }
        ;
        $activity = Activity::query()->whereNotIn('id', $excludeList)->inRandomOrder()->first();

        $response = [
            'id' => $activity->id,
            'image' => asset(cropImage($activity->image, 700, 400)),
            'name' => $activity->name
        ];

        return response()->json($response);
    }
}

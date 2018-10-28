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
        return view('frontend.pages.test-part1');
    }


    public function getQuestion()
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

        if ( count($activity) == 0 ) {
            return response()->json(['redirect'=>'part2']);
        }

        $response = [
            'id' => $activity->id,
            'image' => asset(cropImage($activity->image, 700, 400)),
            'name' => $activity->name
        ];

        return response()->json($response);
    }


    public function showPart2()
    {
        return view('frontend.pages.test-part2');
    }

    public function showPart3(Request $request)
    {
        $data = array_only($request->all(), ['q1', 'q2', 'q3']);
        $dataDotted = array_dot($data);

        $request->session()->forget(['q1', 'q2', 'q3']);
        foreach ($dataDotted as $key => $value) {

            $request->session()->push($key, $value);
        }

        return view('frontend.pages.test-part3');
    }

    public function register(Request $request)
    {
        dd($request->all());
    }
}

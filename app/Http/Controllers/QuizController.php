<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\QuizHistory;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class QuizController extends Controller
{
    public function showPage()
    {
        return view('frontend.pages.quiz-part1');
    }


    public function getQuestion(Request $request)
    {
        $this->writeQuizHistory($request);
        $this->writeAnswersToSession($request);

        return $this->nextQuestion($request);
    }

    protected function writeAnswersToSession($request)
    {
        $answers = $request->answers;
        foreach ($answers as $key => $answer) {
            $request->session()->put('answers.'.$answer['activity'], $answer['answer']);
        }

    }

    protected function writeQuizHistory($request)
    {
        $session = $request->session()->getId();
        $answers = $request->answers;
        foreach ($answers as $answer) {

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

        $activity = Activity::query()->whereNotIn('id', $excludeList)->inRandomOrder()->first();

        if ( !$activity ) {
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
        return view('frontend.pages.quiz-part2');
    }

    public function showPart3(Request $request)
    {
        $data = array_only($request->all(), ['q1', 'q2', 'q3']);
        $dataDotted = array_dot($data);

        $request->session()->forget(['q1', 'q2', 'q3']);
        foreach ($dataDotted as $key => $value) {
            $request->session()->push($key, $value);
        }


        $urlWithAttributes = $this->createUrlWithAttributes($request);

        if(Auth::guest()) {
            return view('frontend.pages.quiz-part3', ['dataUrl' => $urlWithAttributes]);
        } else {
            return $this->showResultsAuth($urlWithAttributes);
        }

    }

    protected function createUrlWithAttributes($request)
    {
        $likedAnswers = array_where($request->session()->get('answers'), function ($value, $key) {
            return $value === 'like';
        });


        if($likedAnswers) {
            $usefulAttributes['a'] = array_divide($likedAnswers)[0];
        }
        if($request->session()->get('q1')) {
            $usefulAttributes['q1'] = array_divide($request->session()->get('q1'))[0];
        }
        if($request->session()->get('q2')) {
            $usefulAttributes['q2'] = array_divide($request->session()->get('q2'))[0];
        }
        if($request->session()->get('q3')) {
            $usefulAttributes['q3'] = array_divide($request->session()->get('q3'))[0];
        }

        return http_build_query($usefulAttributes);
    }

    public function showResults(Request $request)
    {
        return $this->showResultsPage($request->query());
    }

    protected function showResultsAuth($urlWithAttributes)
    {
        return $this->showResultsPage($urlWithAttributes);
    }

    protected function showResultsPage($userAnswers)
    {
        if (empty($userAnswers)) {
            return redirect()->route('quiz-part1');
        }

        $answers = [];
        if(is_string($userAnswers)) {
            parse_str($userAnswers, $answers);
        } else {
            $answers = $userAnswers;
        }


        $totalScores = $this->updateUserAnswers($answers);

        $scoresForView = $this->transformScoresForView($totalScores);

        $filteredProducts = Product::filterByDuration($answers['q2'] ?? '');

        $bestProducts = Product::findBestProducts($scoresForView);


        return view('frontend.pages.quiz-results', [
            'scores' => $scoresForView->slice(0,4),
            'bestProducts' => $bestProducts,
            'filter' =>[
                'applyScores' => true,
                'duration' => $answers['q2'] ?? ''
            ]
        ]);
    }

    protected function countTotalScores ($answers)
    {
        $likedActivities = Activity::whereIn('id', $answers)->get();
        $totalScores = [];

        foreach (config('categories') as $key => $category) {
            $totalScores[$key] = 0;

            foreach ($likedActivities as $activity) {
                $totalScores[$key] += $activity->scores[$key];
            }
        }

        return $totalScores;
    }

    protected function updateUserAnswers($answers)
    {
        if (Auth::guest()) {
            return $this->countTotalScores($answers['a']) ?? '';
        }

        $currentUser = Auth::user();

        if (isset($answers['a'])) {
            $totalScores = $this->countTotalScores($answers['a']);
            $currentUser->totalScores = $totalScores;
        }

        if (isset($answers['q1'])) {
            $currentUser->q1 = $answers['q1'];
        }
        if (isset($answers['q2'])) {
            $currentUser->q2 = $answers['q2'];
        }
        if (isset($answers['q3'])) {
            $currentUser->q3 = $answers['q3'];
        }

        $currentUser->save();

        return $totalScores ?? '';
    }

    public static function transformScoresForView($totalScores)
    {
//        dd($totalScores);
        $outputScores = collect();

        foreach ($totalScores as $id => $score) {
            $outputScores[$id] = [
                'name' => config('activities')[$id]['name'],
                'score' => $score
            ];
        }
        $outputScores = $outputScores->sortBy('score')->reverse();

        $top = (int) $outputScores->max('score');

//        $top = $outputScores->sum('score');

        $outputScores = $outputScores->map(function($item, $key) use ($top) {
            $item['percent'] = round($item['score'] / $top *100);
            return $item;
        });

        return $outputScores;
    }





}

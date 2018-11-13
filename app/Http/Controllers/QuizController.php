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


    public function showPart2(Request $request)
    {
        if(!$request->session()->has('answers')) {
            return redirect()->route('quiz-part1');
        }

        return view('frontend.pages.quiz-part2');
    }

    public function showPart3(Request $request)
    {

        if(!$request->session()->has('answers')) {
            return redirect()->route('quiz-part1');
        }

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

        $allAnswersAsArray = [];
        if(is_string($userAnswers)) {
            parse_str($userAnswers, $allAnswersAsArray);
        } else {
            $allAnswersAsArray = $userAnswers;
        }


        $totalScoresOfCategories = $this->countTotalScores($allAnswersAsArray['a'] ?? []);

        $this->updateUserAnswers($allAnswersAsArray);

        $scoresForView = self::transformScoresForView($totalScoresOfCategories);

        Product::filterByDuration($allAnswersAsArray['q2'] ?? '');
        Product::filterByMonth($allAnswersAsArray['q3']);

        $bestProducts = Product::findBestProducts($scoresForView);


        return view('frontend.pages.quiz-results', [
            'bestProducts' => $bestProducts,
            'filter' =>[
                'applyScores' => true,
                'month' => $allAnswersAsArray['q3'] ?? null,
                'duration' => $allAnswersAsArray['q2'] ?? null
            ]
        ]);
    }



    protected function countTotalScores ($answersActivitiesAsArray)
    {
        $likedActivities = Activity::whereIn('id', $answersActivitiesAsArray)->get();
        $totalScores = [];

        foreach (config('categories') as $key => $category) {
            $totalScores[$key] = 0;

            foreach ($likedActivities as $activity) {
                $totalScores[$key] += $activity->scores[$key];
            }
        }

        return $totalScores;
    }

    protected function updateUserAnswers($allAnswersAsArray)
    {
        if (Auth::guest()) {
            return $this->countTotalScores($allAnswersAsArray['a']) ?? '';
        }

        $currentUser = Auth::user();

        if (isset($allAnswersAsArray['a'])) {
            $totalScores = $this->countTotalScores($allAnswersAsArray['a']);
            $currentUser->totalScores = $totalScores;
        }

        if (isset($allAnswersAsArray['q1'])) {
            $currentUser->q1 = $allAnswersAsArray['q1'];
        }
        if (isset($allAnswersAsArray['q2'])) {
            $currentUser->q2 = $allAnswersAsArray['q2'];
        }
        if (isset($allAnswersAsArray['q3'])) {
            $currentUser->q3 = $allAnswersAsArray['q3'];
        }

        $currentUser->save();
    }

    public static function transformScoresForView($totalScoresOfCategories)
    {
        $outputScores = collect();

        foreach ($totalScoresOfCategories as $id => $score) {
            $outputScores[$id] = [
                'name' => config('categories')[$id]['name'],
                'score' => $score
            ];
        }
        $outputScores = $outputScores->sortBy('score')->reverse();

        $top = (int) $outputScores->max('score');
        if ($top ==0) {
            $top = 100;
        }

//        $top = $outputScores->sum('score');

        $outputScores = $outputScores->map(function($item, $key) use ($top) {
            $item['percent'] = round($item['score'] / $top *100);
            return $item;
        });

        return $outputScores;
    }





}

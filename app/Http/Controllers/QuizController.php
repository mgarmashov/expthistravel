<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use App\Models\Product;
use App\Models\QuizHistory;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class QuizController extends Controller
{
    private $arrayAttributes = ['q3', 'q_countries'];
    private $nonArrayAttributes = ['q_who_travels', 'q_how_many_adults', 'q_how_many_child', 'q_how_long_from', 'q_how_long_to', 'q_how_many_age', 'q_travel_style', 'q_how_long', 'q_preferred_sight'];


    public function showStep1(Request $request)
    {
        /*if (isset($request->experience)) {
            $request->session()->put('experience', $request->experience);
            if ($request->experience == 0) {
                $request->session()->forget('q_experiences');
                return view('frontend.pages.quiz-step1');
            } else {
                $request->session()->put('q_experiences', $request->q_experiences);
            }
        }

        if (!$request->session()->has('experience')) {
            return redirect()->route('quiz-step1');
        }

        return redirect()->route('quiz-step2');*/
        return view('frontend.pages.quiz-step1');
    }


    public function saveAnswers(Request $request)
    {
        $this->writeQuizHistory($request);
        $this->writeAnswersToSession($request);
        return response()->json('success', 200);
    }

    protected function writeAnswersToSession($request)
    {
        $request->session()->forget('answers');
        $likes = $request->likes ?? [];
        foreach (Activity::all() as $activity) {
            $answer = in_array($activity->id, $likes) ? 'like' : 'dislike';
            $request->session()->put('answers.'.$activity->id, $answer);
        }

    }

    protected function writeQuizHistory($request)
    {
        $session = $request->session()->getId();
        $likes = $request->likes ?? [];

        foreach (Activity::all() as $activity) {
            $answer = in_array($activity->id, $likes) ? 'like' : 'dislike';
            $query['activity'] = $activity->id;
            Auth::check() ? $query['user'] = Auth::user()->id : $query['session'] = $session;

            $newRow = QuizHistory::firstOrCreate($query);
            $newRow->answer = $answer;
            $newRow->session = $session;
            $newRow->save();
        }
    }



    public function showStep2(Request $request)
    {

        if(!$request->session()->has('answers') && !$request->session()->has('experience')) {
            return redirect()->route('quiz-step1');
        }

        return view('frontend.pages.quiz-step2');
    }

    public function showStep3(Request $request)
    {

        if(!$request->session()->has('answers')) {
            return redirect()->route('quiz-step1');
        }
        $this->saveApplicationQuestionsToSession($request);
        $urlWithAttributes = $this->createUrlWithAttributes($request);

        if(Auth::guest()) {
            return view('frontend.pages.quiz-step3', ['dataUrl' => $urlWithAttributes]);
        } else {
            return $this->showResultsAuth($urlWithAttributes);
        }

    }

    protected function saveApplicationQuestionsToSession($request)
    {
        $request->session()->forget($this->arrayAttributes);
        $request->session()->forget($this->nonArrayAttributes);

        $arrayData = array_only($request->all(), $this->arrayAttributes);
        $dataDotted = array_dot($arrayData);

        foreach ($dataDotted as $key => $value) {
            $request->session()->push($key, $value);
        }

        foreach ($this->nonArrayAttributes as $alias) {
            $request->session()->put($alias, $request->$alias);
        }
    }

    protected function createUrlWithAttributes($request)
    {
        if($request->session()->get('answers')) {
            $likedAnswers = array_where($request->session()->get('answers'), function ($value, $key) {
                return $value === 'like';
            });
        }


        $usefulAttributes = [];
        if(isset($likedAnswers)) {
            $usefulAttributes['a'] = array_divide($likedAnswers)[0];
        }

        foreach ($this->arrayAttributes as $alias) {
            if($request->session()->get($alias)) {
                $usefulAttributes[$alias] = array_divide($request->session()->get($alias))[0];
            }
        }

        foreach ($this->nonArrayAttributes as $alias) {
            if($request->session()->get($alias)) {
                $usefulAttributes[$alias] = $request->session()->get($alias);
            }
        }
        return http_build_query($usefulAttributes);
    }

    public function showResults(Request $request)
    {
        return $this->showResultsPage($request->query());
    }

    protected function showResultsAuth($urlWithAttributes)
    {
        $arr = [];
        parse_str($urlWithAttributes,$arr);
        return redirect()->route('quiz-results', $arr);
    }





    protected function showResultsPage($userAnswers)
    {
        if (empty($userAnswers)) {
            return redirect()->route('quiz-step1');
        }

        $allAnswersAsArray = [];
        if(is_string($userAnswers)) {
            parse_str($userAnswers, $allAnswersAsArray);
        } else {
            $allAnswersAsArray = $userAnswers;
        }


        $totalScoresOfCategories = $this->countTotalScores($allAnswersAsArray['a'] ?? []);

        if(Auth::check()) {
            $this->updateUserAnswers($allAnswersAsArray);
        }

        $scoresForView = self::transformScoresForView($totalScoresOfCategories);


        $this->filterRows($allAnswersAsArray, 'App\Models\Product');
        $this->filterRows($allAnswersAsArray, 'App\Models\Itinerary');

        $bestProducts = Product::findBestProducts($scoresForView);
        $bestItineraries = Itinerary::findBestItineraries($scoresForView);


        return view('frontend.pages.search-results', [
            'products' => $bestProducts,
            'itineraries' => $bestItineraries,
            'filter' =>[
                'applyScores' => 'yes',
                'country' => $allAnswersAsArray['q_countries'] ?? null,
                'month' => $allAnswersAsArray['q3'] ?? null,
                'q_how_long_from' => $allAnswersAsArray['q_how_long_from'] ?? null,
                'q_how_long_to' => $allAnswersAsArray['q_how_long_to'] ?? null,
                'travel_styles' => $allAnswersAsArray['q_travel_style'] ?? null,
                'sights' => $allAnswersAsArray['q_preferred_sight'] ?? null,
            ]
        ]);
    }

    protected function filterRows ($allAnswersAsArray, $model) {
        if (request()->session()->has('experience') && request()->session()->get('experience') != '0') {
            $model::filterByExperience(request()->session()->get('q_experiences'));
        }

        if (isset($allAnswersAsArray['q_countries'])) {
            $model::filterByCountry($allAnswersAsArray['q_countries'] ?? '');
        }
        if (isset($allAnswersAsArray['q_how_long_from']) || isset($allAnswersAsArray['q_how_long_to'])) {
            $model::filterByDuration([$allAnswersAsArray['q_how_long_from'] ?? 1, $allAnswersAsArray['q_how_long_to'] ?? 29]);
        }

        if (isset($allAnswersAsArray['q3'])) {
            $model::filterByMonth($allAnswersAsArray['q3']);
        }

        if (isset($allAnswersAsArray['q_preferred_sight'])) {
            $model::filterBySights([$allAnswersAsArray['q_preferred_sight']]);
        }
        if (isset($allAnswersAsArray['q_travel_style'])) {
            $model::filterByTravelStyle([$allAnswersAsArray['q_travel_style']]);
        }
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

        foreach(array_merge($this->arrayAttributes, $this->nonArrayAttributes) as $alias) {
            if (isset($allAnswersAsArray[$alias])) {
                $currentUser->$alias = $allAnswersAsArray[$alias];
            }
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

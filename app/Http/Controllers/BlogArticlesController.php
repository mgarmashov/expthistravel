<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle;
use Illuminate\Http\Request;

class BlogArticlesController extends Controller
{
    public function showList()
    {
        $articles = BlogArticle::query()->get();

        $articles = $articles->sort(function ($a, $b)  {
            return $a->date() < $b->date();
        });

        return view('frontend.pages.blog', compact(
            'articles'
        ));
    }

    public function showArticle(Request $request)
    {
        $slug = $request->slug;
        $article = BlogArticle::where('slug', $slug)->first();

        if (empty($article)) abort(404);

        return view('frontend.pages.article-details', compact('article'));

    }
}

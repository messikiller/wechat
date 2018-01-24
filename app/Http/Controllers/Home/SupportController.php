<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Models\Article;

class SupportController extends HomeController
{
    public function news()
    {
        $detail   = 'Support News';
        $articles = Article::published()
            ->where('album', '=', config('define.article.album.news.value'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home.article.common_list', compact('detail', 'articles'));
    }

    public function ultrasound()
    {

    }

    public function endoscope()
    {

    }
}

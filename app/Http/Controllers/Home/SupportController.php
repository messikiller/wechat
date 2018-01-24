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
        $detail   = 'Ultralsound Support';
        $articles = Article::published()
            ->where('album', '=', config('define.article.album.ultrasound_center.value'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home.article.common_list', compact('detail', 'articles'));
    }

    public function endoscope()
    {
        $detail   = 'Endoscope Support';
        $articles = Article::published()
            ->where('album', '=', config('define.article.album.endoscopy_center.value'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home.article.common_list', compact('detail', 'articles'));
    }
}

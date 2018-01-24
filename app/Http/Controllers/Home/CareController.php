<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Models\Article;

class CareController extends HomeController
{
    public function endoDoctor()
    {
        $detail   = 'Endoscope Care';
        $articles = Article::published()
            ->where('album', '=', config('define.article.album.doctor_center_es.value'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home.article.common_list', compact('detail', 'articles'));
    }

    public function ultraDoctor()
    {
        $detail   = 'Ultrasound Care';
        $articles = Article::published()
            ->where('album', '=', config('define.article.album.doctor_center_us.value'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home.article.common_list', compact('detail', 'articles'));
    }

    public function providerCenter()
    {
        $detail   = 'Distributor Center';
        $articles = Article::published()
            ->where('album', '=', config('define.article.album.distributor_center.value'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home.article.common_list', compact('detail', 'articles'));
    }
}

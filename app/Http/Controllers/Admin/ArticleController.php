<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\Article;
use Debugbar;

class ArticleController extends AdminController
{
    public function list(Request $request)
    {
        $pagesize = 20;
        $filter   = $where = [];

        if (($filter_type = $request->input('filter_type', false)) !== false) {
            $filter['filter_type'] = $filter_type;
            $where['type']         = $filter_type;
        }

        if (($filter_album = $request->input('filter_album', false)) !== false) {
            $filter['filter_album'] = $filter_album;
            $where['album']         = $filter_album;
        }

        if (($filter_status = $request->input('filter_status', false)) !== false) {
            $filter['filter_status'] = $filter_status;
            $where['status']         = $filter_status;
        }

        if (($filter_title = $request->input('filter_title', false)) !== false) {
            $filter['filter_title'] = $filter_title;
            $where['title']         = $filter_title;
        }

        $list = Article::orderBy('created_at', 'desc')
            ->where($where)
            ->paginate($pagesize)
            ->appends($filter);

        return view('admin.article.list', compact('list', 'filter'));
    }

    public function preview($id)
    {

    }

    public function add()
    {
        return view('admin.article.add');
    }

    public function handleAdd(Request $request)
    {
        $article = new Article;

        $article->title      = $request->title;
        $article->type       = $request->type;
        $article->album      = $request->album;
        $article->status     = $request->status;
        $article->cover      = $request->cover;
        $article->abstract   = $request->abstract;
        $article->content    = $request->type == config('define.article.type.link.value') ? $request->plainContent : $request->content;
        $article->created_at = time();

        $res = $article->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '文章发布失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '文章发布成功！']
        ]);
    }

    public function edit($id)
    {
        $article = Article::find($id);

        return view('admin.article.edit', compact('article'));
    }

    public function handleEdit(Request $request, $id)
    {
        $article = Article::find($id);

        $article->title    = $request->title;
        $article->type     = $request->type;
        $article->album    = $request->album;
        $article->status   = $request->status;
        $article->cover    = $request->cover;
        $article->abstract = $request->abstract;
        $article->content  = $request->type == config('define.article.type.link.value') ? $request->plainContent : $request->content;

        $res = $article->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '文章更新失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '文章更新成功！']
        ]);
    }

    public function uploadCover(Request $request)
    {
        $path      = $request->file('coverFile')->store('public/cover');
        $filename  = basename($path);
        $cover_src = "/storage/cover/{$filename}";

        return response()->json([
            'status'    => 200,
            'cover_src' => $cover_src
        ]);
    }
}

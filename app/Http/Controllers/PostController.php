<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    /**
     * ポストリポジトリのインスタンス
     */
    protected $posts;

    /**
     * 新しいコントローラインスタンスの作成
     */
    public function __construct(PostRepository $posts)
    {
        $this->middleware('auth');

        $this->posts = $posts;
    }

    /**
     * ユーザの全ポストを表示
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $posts = $request->user()->posts()->get();

        //return view('posts.index');
        return view('posts.index', [
            'posts' => $this->posts->forUser($request->user()),
        ]);
    }

    /**
     * 新ポストの登録
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);


        $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect('/posts');
    }

    /**
     * 指定タスクの削除
     *
     * @param  Request  $request
     * @param  Post $post
     * @return Response
     */
    public function destroy(Request $request, Post $post)
    {
        // policy から削除可能か判定
        $this->authorize('destroy', $post);

        // 削除処理
        $post->delete();

        return redirect('/posts');

    }
}

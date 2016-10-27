<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * ポストリポジトリーインスタンス
     *
     * @var PostRepository
     */
    protected $posts;

    /**
     * 新しいコントローラインスタンスの作成
     *
     * @param PostRepository $posts
     * @return void
     */
    public function __construct(PostRepository $posts)
    {
        $this->middleware('auth');
        $this->posts = $posts;
    }

    /**
     * ユーザの全ポストをリスト表示
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('posts.index', [
            'posts' => $this->posts->forUser($request->user()),
        ]);
    }

    /**
     * 新ポスト追加
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
        Session::put('posts', $request->all());
        return redirect('/confirm');
    }

    /**
     * 確認画面表示
     */
    public function confirm()
    {
        $input = Session::get('posts');
        return view('posts.confirm', [
            'input' => $input,
        ]);
    }

    /**
     * ポスト登録処理
     *
     * @param Request $request
     * @return void
     */
    public function complete(Request $request)
    {
        // editの場合
        if ($request->id) {
            // edit
            // ポスト情報を取得
            $post = Post::find($request->id);
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();
        } else {
            // ポスト作成処理
            $request->user()->posts()->create([
                'title' => $request->title,
                'body' => $request->body,
            ]);
        }
        return redirect('/posts');
    }

    /**
     * ポスト編集画面表示処理
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        // ポスト情報を取得
        $post = Post::find($id);
        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * ポストを編集し更新する処理
     *
     * @param Request $request
     * @param $id (post.id)
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        Session::put('posts', $request->all());
        return redirect('/confirm');
    }

    /**
     * 指定ポストの削除
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function destroy(Request $request, Post $post)
    {
        $this->authorize('destroy', $post);
        $post->delete();
        return redirect('/posts');
    }
}
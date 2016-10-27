<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrapの定形コード… -->

    <div class="panel-body">
        <!-- バリデーションエラーの表示 -->
    @include('common.errors')

    <!-- 新タスクフォーム -->
        <form action="{{ url('post') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- タスク名 -->
            <div class="form-group">
                <label for="post-title" class="col-sm-3 control-label">Title</label>

                <div class="col-sm-6">
                    <input type="text" name="title" id="post-title" class="form-control">
                </div>
            </div>

            <!-- textarea -->
            <div class="form-group">
                <label for="post-body" class="col-sm-3 control-label">Body</label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="5" name="body" id="post-body"></textarea>
                </div>
            </div>

            <!-- タスク追加ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Post
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- 現在のタスク -->
    @if (count($posts) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                現在のポスト
            </div>

            <div class="panel-body">
                <table class="table table-striped post-table">

                    <!-- テーブルヘッダ -->
                    <thead>
                    <th>Title</th>
                    <th>Body</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- テーブル本体 -->
                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <!-- Post Title -->
                            <td class="table-text">
                                <div>{{ $post->title }}</div>
                            </td>
                            <!-- Post Body -->
                            <td class="table-text">
                                <div>{{ $post->body }}</div>
                            </td>

                            <!-- 編集ボタン -->>
                            <td>
                                <a href="{{ url('edit/'.$post->id) }}" class="btn btn-primary btn-sm">編集</a>
                            </td>

                            <!-- 削除ボタン -->
                            <td>
                                <form action="{{ url('post/'.$post->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-post-{{ $post->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>削除
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection
<!-- resources/views/posts/edit.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrapの定形コード… -->

    <div class="panel-body">
        <!-- バリデーションエラーの表示 -->
    @include('common.errors')

    <!-- 編集ポストのフォーム -->
        <form action="{{ url('update/'.$post->id) }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- タスク名 -->
            <div class="form-group">
                <input type="hidden" name="id" id="post-id" value="{{ $post->id }}">
            </div>
            <div class="form-group">
                <label for="post-title" class="col-sm-3 control-label">Title</label>

                <div class="col-sm-6">
                    <input type="text" name="title" id="post-title" class="form-control" value="{{ $post->title }}">
                </div>
            </div>

            <!-- textarea -->
            <div class="form-group">
                <label for="post-body" class="col-sm-3 control-label">Body</label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="5" name="body" id="post-body">{{ $post->body }}</textarea>
                </div>
            </div>

            <!-- タスク追加ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Edit Post
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
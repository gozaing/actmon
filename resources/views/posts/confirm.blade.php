<!-- resources/views/posts/confirm.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrapの定形コード… -->
    <div class="panel-body">

        <p> Confirm </p>

        <!-- 新タスクフォーム -->
        <form action="{{ url('complete') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- ポスト -->
            @if (isset($input['id']))
                <div class="form-group">
                    <input type="hidden" name="id" id="post-id" value='{{ $input['id'] }}'>
                </div>
            @endif

            <div class="form-group">
                <label class="col-sm-3 control-label">{{ $input['title'] }}</label>
                <input type="hidden" name="title" id="post-title" value='{{ $input['title'] }}'>
            </div>

            <!-- textarea -->
            <div class="form-group">
                <label name="body" id="post-body" class="col-sm-3 control-label">{{ $input['body'] }}</label>
                <input type="hidden" name="body" id="post-body" value="{{ $input['body'] }}"
            </div>

            <!-- タスク追加ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> 登録
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
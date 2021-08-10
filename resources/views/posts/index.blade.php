@extends('layouts.login')

@section('content')
<!-- 4.1 投稿フォームの設置 -->
<div class="container">
  <div class="row">
    <form method="POST" action="{{ route('top.store') }}">
      {{ csrf_field() }}

      <div class="form-group">
        <div class="form-group-image">
          @if(auth()->user()->images == 'dawn.png')
          <!-- 初期アイコン -->
          <p><img src="{{ asset('images/' .auth()->user()->images) }}" class="rounded-circle"></p>
          @else
          <!-- アップロードしたアイコン -->
          <p><img src="{{ asset('storage/images/' .auth()->user()->images) }}" class="rounded-circle"></p>
          @endif
        </div>
        <div class="form-group-text">
          <textarea class="form-control" name="posts" style="border:none;" required rows="4" placeholder="何をつぶやこうか...?">{{ old('posts') }}</textarea>
        </div>
        <div class="form-group-icon">
          <input src="images/post.png" type="image"></input>
        </div>
      </div>
    </form>
  </div>

  <!-- 4.2 ログインユーザーのつぶやきを表示 -->
  <!-- 4.2.1 ログインユーザーのフォローのつぶやき表示を表示 -->
  @if (isset($timelines))
  @foreach ($timelines as $timeline)
  <div class="tweets-top">
    <div class="card">
      <div class="tweet-timelines">
        <div id="top-image2" class="top-image2">
          @if($timeline->user->images == 'dawn.png')
          <!-- 初期アイコン -->
          <p><img src="{{ asset('images/' .$timeline->user->images) }}" class="rounded-circle"></p>
          @else
          <!-- アップロードしたアイコン -->
          <p><img src="{{ asset('storage/images/' .$timeline->user->images) }}" class="rounded-circle"></p>
          @endif
        </div>
        <div class="timelines">
          <p class="tweets-top-username">{{ $timeline->user->username }}</p>
          <p class="tweets-top-text">{!! nl2br(e($timeline->posts)) !!}</p>
        </div>
        <div class="tweets-top-time">
          <p>{{ $timeline->created_at }}</p>
        </div>
      </div>

      <!-- 4.x.1 モーダルの設置 -->
      @if ($timeline->user->id === auth()->user()->id)

      <div class="tweet-menu">
        <!-- 編集 -->
        <!-- ライフスタイルボックス -->
        <div class="life-type">
          <!-- <a class="modalopen" data-target="modal01"> -->
          <a class="modalopen" data-target="{{ $timeline->id }}">
            <input src='images/edit.png' type="image" class="edit-menu-icon"></input>
          </a>
        </div>
        <!-- モーダルの中身 -->
        <div class="modal-main js-modal" id="{{ $timeline->id }}">
          <div class="inner">
            <div class="inner-content">

              <!-- 更新処理の実装 -->
              {!! Form::open(['url' => 'update']) !!}
              <div class="edit-modal">
                {!! Form::hidden('id', $timeline->id) !!}
                {!! Form::input('text', 'upPost', $timeline->posts, ['required', 'class' => 'form-control-edit']) !!}
              </div>
              <input src='images/edit.png' type="image" class="image-modal"></input>
              {!! Form::close() !!}

              <!-- <form method="POST" action="{{ url('posts/' .$timeline->id) }}">
                <input type="text" name="upPost" class="form-control-edit" value="{{ $timeline->posts }}">
                <input src='images/edit.png' type="image" class="image-modal"></input> -->
              <!-- </form> -->
            </div>
          </div>
        </div>

        <!-- 削除 -->
        <!-- ライフスタイルボックス -->

        <!-- <div class="life-type">
          <a href="" class="modalopen" data-target="modal02">
            <input src='images/trash_h.png' type="image" class="delete-menu-icon"></input>
          </a>
        </div> -->

        <!-- モーダルの中身 -->

        <!-- <div class="modal-main js-modal" id="modal02">
          <div class="inner">
            <div class="inner-content">
              <img src="" class="image-modal" href="">
            </div>
          </div>
        </div> -->







      </div>

      @endif

    </div>
  </div>
  @endforeach
  @endif





</div>
@endsection

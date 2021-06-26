@extends('layouts.login')

@section('content')
<!-- 4.1 投稿フォームの設置 -->
<div class="container">
  <div class="row">
    <form method="POST" action="{{ route('top.store') }}">
      {{ csrf_field() }}

      <div class="form-group">
        <div class="form-group-image">
          <!-- 初期アイコン -->
          <p><img src="images/dawn.png" class="rounded-circle"></p>
        </div>
        <div class="form-group-text">
          <textarea class="form-control" name="posts" style="border:none;" required rows="4" placeholder="何をつぶやこうか...?"></textarea>
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

          <p><img src="images/dawn.png" class="rounded-circle"></p>
        </div>
        <div class="timelines">
          <p class="tweets-top-username">{{ $timeline->user->username }}</p>
          <p class="tweets-top-text">{!! nl2br(e($timeline->text)) !!}</p>
        </div>
        <div class="tweets-top-time">
          <p>{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
        </div>
      </div>


      @if ($timeline->user->id === Auth::user()->id)


      <div class="tweet-menu">





      </div>

      @endif

    </div>
  </div>
  @endforeach
  @endif





</div>
@endsection

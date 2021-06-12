@extends('layouts.logout')

@section('content')

<!-- 2.x.2 登録完了画面のレイアウト -->
<header>
  <div class="top-logo-added">
    <h1><img src="images/main_logo.png"></h1>
  </div>
</header>

<div class="container">
  <div class="formWrapper-added">

    <div class="formLabel-name">
      <p>{{ $user_name }}さん</p>
    </div>

    <div class="formLabel-title-added">
      <p>ようこそ！DAWNSNSへ！</p>
    </div>

    <div class="formLabel-text1">
      <p class="formLabel-text-left1">ユーザー登録が完了しました。</p>
    </div>

    <div class="formLabel-text2">
      <p class="formLabel-text-left2">さっそく、ログインをしてみましょう</p>
    </div>

    <p class="added-button"><a href="/login">ログイン画面へ</a></p>

  </div>
</div>

@endsection

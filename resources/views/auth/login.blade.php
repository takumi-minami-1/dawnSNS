@extends('layouts.logout')

@section('content')

<!-- 2.x.3 ログイン画面のレイアウト -->
<header>
  <div class="top-logo-login">
    <h1><img src="images/main_logo.png"></h1>
  </div>
  <div class="sub-title">
    <p>Social Network Service</p>
  </div>
</header>

<div class="container">
  <div class="formWrapper-login">
    {!! Form::open() !!}

    <div class="formLabel-title-login">
      <h2>DAWNSNSへようこそ</h2>
    </div>

    <div class="form-item-box">
      <div class="form-item">
        {{ Form::label('MailAddress',null,['class' => 'Label']) }}
        {{ Form::text('mail',null,['class' => 'formText']) }}
      </div>

      <div class="form-item">
        {{ Form::label('Password',null,['class' => 'Label']) }}
        {{ Form::text('password',null,['class' => 'formText']) }}
      </div>
    </div>

    {{ Form::submit('LOGIN',['class' => 'login-button']) }}

    <div class="move-button-login">
      <p><a href="/register">新規ユーザーの方はこちら</a></p>
    </div>

    {!! Form::close() !!}

  </div>
</div>

@endsection

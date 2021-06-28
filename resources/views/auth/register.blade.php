@extends('layouts.logout')

@section('content')

<!-- 2.x.1 新規登録画面のレイアウト -->
<header>
  <div class="top-logo-register">
    <h1><img src="images/main_logo.png"></h1>
  </div>
</header>

<div class="container">
  <div class="formWrapper-register">
    {!! Form::open() !!}

    <div class="formLabel-title-register">
      <h2>新規ユーザー登録</h2>
    </div>

    <div class="form-item-box">
      <div class="form-item">
        {{ Form::label('UserName',null,['class' => 'Label']) }}
        {{ Form::text('username',null,['class' => 'formText']) }}
      </div>

      <div class="form-item">
        {{ Form::label('MailAddress',null,['class' => 'Label']) }}
        {{ Form::text('mail',null,['class' => 'formText']) }}
      </div>

      <div class="form-item">
        {{ Form::label('Password',null,['class' => 'Label']) }}
        {{ Form::password('password',['class' => 'formText']) }}
      </div>

      <div class="form-item">
        {{ Form::label('Password confirm',null,['class' => 'Label']) }}
        {{ Form::password('password-confirm',['class' => 'formText']) }}
      </div>
    </div>

    {{ Form::submit('REGISTER',['class' => 'register-button']) }}

    <div class="move-button-register">
      <p><a href="/login">ログイン画面へ戻る</a></p>
    </div>

    {!! Form::close() !!}
  </div>
</div>

@endsection

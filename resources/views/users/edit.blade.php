@extends('layouts.login')

@section('content')
<!-- 8 プロフィール -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="profile-card">

                <div class="card-header">
                    <div id="box3" class="profile-image">
                        @if(auth()->user()->images == 'dawn.png')
                        <!-- 初期アイコン -->
                        <p><img src="{{ asset('images/' .auth()->user()->images) }}" class="rounded-circle profile-image"></p>
                        @else
                        <!-- アップロードしたアイコン -->
                        <p><img src="{{ asset('storage/images/' .auth()->user()->images) }}" class="rounded-circle profile-image"></p>
                        @endif
                    </div>
                </div>

                <div class="profile-card-body">
                    {!! Form::open(['url' => 'user-update']) !!}
                    {!! Form::hidden('id', $user->id) !!}

                    <div class="profile-form-group row">
                        <label for="username" class="col-md-4 col-form-label profile-text-md-right">{{ __('UserName') }}</label>
                        <div class="col-md-6">
                            {!! Form::input('text', 'upUser1', $user->username, ['required', 'class' => 'profile-form-control']) !!}
                        </div>
                    </div>


                    <div class="profile-form-group row">
                        <label for="mail" class="col-md-4 col-form-label profile-text-md-right">{{ __('MailAddress') }}</label>
                        <div class="col-md-6">
                            {!! Form::input('text', 'upUser2', $user->mail, ['required', 'class' => 'profile-form-control']) !!}
                        </div>
                    </div>


                    <div class="profile-form-group row">
                        <label for="password" class="col-md-4 col-form-label profile-text-md-right">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="profile-form-control-password" value="{{ $user->password_confirm }}" readonly>
                        </div>
                    </div>


                    <div class="profile-form-group row">
                        <label for="new_password" class="col-md-4 col-form-label profile-text-md-right">{{ __('new Password') }}</label>
                        <div class="col-md-6">
                            {!! Form::input('password', 'upUser3', null, ['class' => 'profile-form-control-password-raw']) !!}
                        </div>
                    </div>


                    <div class="profile-form-group row">
                        <label for="bio" class="col-md-4 col-form-label profile-text-md-right">{{ __('Bio') }}</label>
                        <div class="col-md-6">
                            {!! Form::input('text', 'upUser4', $user->bio, ['class' => 'profile-form-control-bio']) !!}
                        </div>
                    </div>



                    <!-- ファイルのフォーム -->
                    <div class="profile-form-group row align-items-center">
                        <label for="images" class="col-md-4 col-form-label profile-text-md-right">{{ __('Icon Image') }}</label>
                        <div class="col-md-6">
                            {!! Form::input('file', 'upUser5', $user->images, ['class' => 'profile-form-control-images']) !!}
                        </div>
                    </div>
                    <!-- ファイルのフォーム -->

                    <div class="profile-form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="profile-btn profile-btn-primary">更 新</button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

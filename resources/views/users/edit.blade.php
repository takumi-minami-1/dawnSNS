@extends('layouts.login')

@section('content')

<div class="container">
    <div class="row justify-content-center">
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
                    <form method="POST" action="{{ url('users/' .$user->id) }}" enctype="multipart/form-data" novalidate class="profile-form">
                        @csrf
                        @method('PUT')

                        <div class="profile-form-group row">
                            <label for="username" class="col-md-4 col-form-label profile-text-md-right">{{ __('UserName') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="profile-form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="profile-form-group row">
                            <label for="mail" class="col-md-4 col-form-label profile-text-md-right">{{ __('MailAddress') }}</label>

                            <div class="col-md-6">
                                <input id="mail" type="mail" class="profile-form-control @error('mail') is-invalid @enderror" name="mail" value="{{ $user->mail }}" required autocomplete="mail">

                                @error('mail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="profile-form-group row">
                            <label for="password" class="col-md-4 col-form-label profile-text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="profile-form-control-password @error('password') is-invalid @enderror" name="password" value="{{ $user->password_raw }}" required autocomplete="password" autofocus readonly>
                            </div>
                        </div>

                        <div class="profile-form-group row">
                            <label for="new_password" class="col-md-4 col-form-label profile-text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password_raw" type="password" class="profile-form-control-password-raw @error('password_raw') is-invalid @enderror" name="password_raw" value="{{ $user->password_raw }}" required autocomplete="password_raw" autofocus>

                                @error('password_raw')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="profile-form-group row">
                            <label for="bio" class="col-md-4 col-form-label profile-text-md-right">{{ __('Bio') }}</label>

                            <div class="col-md-6">
                                <textarea id="bio" type="text" class="profile-form-control-bio @error('bio') is-invalid @enderror" name="bio" required autocomplete="bio" autofocus>{{ $user->bio }}</textarea>

                                @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="profile-form-group row align-items-center">
                            <label for="images" class="col-md-4 col-form-label profile-text-md-right">{{ __('Icon Image') }}</label>

                            <div class="col-md-6 d-flex align-items-center">
                                <label for=”id_img” class="profile-form-control-images @error('images') is-invalid @enderror">
                                    <span>ファイルを選択</span>
                                    <input id=”id_img” type="file" name="images" autocomplete="images">
                                </label>

                                @error('images')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="profile-form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="profile-btn profile-btn-primary">更 新</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

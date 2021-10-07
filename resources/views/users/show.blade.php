<!-- 6.3 ユーザーのアイコンから相手のプロフィールページへの遷移 -->
@extends('layouts.login')

@section('content')
<div class="container">
  <div class="row justify-content-center">


    <div class="card-body">

      <div class="users-form-group">
        <div class="">
          <div id="users-image" class="users-image">
            @if($user->images == 'dawn.png')
            <!-- 初期アイコン -->
            <p><img src="{{ asset('images/' .$user->images) }}" class="rounded-circle"></p>
            @else
            <!-- アップロードしたアイコン -->
            <p><img src="{{ asset('images/' .$user->images) }}" class="rounded-circle"></p>
            @endif
          </div>
        </div>

        <div class="form-group-text">
          <div class="users-names">
            <label for="username" class="users-name-title">{{ __('Name') }}</label>
            <h4 class="users-name">{{ $user->username }}</h4>
          </div>
          <div class="users-bios">
            <label for="bio" class="users-bio-title">{{ __('Bio') }}</label>
            <h4 class="users-bio">{{ $user->bio }}</h4>
          </div>
        </div>

        <div class="">
          <div class="users-follow-btn">
            @if ($is_following)
            <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}

              <button type="submit" class="users-btn-follow1 users-btn-primary-follow1">フォローをはずす</button>
            </form>
            @else
            <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
              {{ csrf_field() }}

              <button type="submit" class="users-btn-follow2 users-btn-primary-follow2">フォローする</button>
            </form>
            @endif
          </div>
        </div>
      </div>
    </div>


    @if (isset($timelines))
    @foreach ($timelines as $timeline)
    <div class="tweets-top">
      <div class="card">
        <div class="tweet-timelines">
          <div id="top-image2" class="top-image2">
            @if($user->images == 'dawn.png')
            <!-- 初期アイコン -->
            <p><img src="{{ asset('images/' .$timeline->user->images) }}" class="rounded-circle"></p>
            @else
            <!-- アップロードしたアイコン -->
            <p><img src="{{ asset('images/' .$timeline->user->images) }}" class="rounded-circle"></p>
            @endif
          </div>
          <div class="timelines">
            <p class="tweets-top-username">{{ $timeline->user->username }}</p>
            <p class="tweets-top-text">{{ $timeline->posts }}</p>
          </div>
          <div class="tweets-top-time">
            <p class="">{{ $timeline->created_at }}</p>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    @endif


  </div>
  <!-- <div class="my-4 d-flex justify-content-center">
  </div> -->

</div>
@endsection

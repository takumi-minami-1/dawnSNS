@extends('layouts.login')

@section('content')
<!-- 6.2.1 フォロワーリスト/フォロワーユーザーのアイコン一覧の設置 -->
<div class="container">
    <div class="row justify-content-center">
        <div class="followList-title">Follower list</div>
        <div class="card-body">
            <div class="followList-form-group">
                @if(!empty($data))
                @foreach($data as $item)
                <div class="followList-icon-list">
                    @if (auth()->user()->isFollowed($item->id))
                    <div id="followList-icon" class="followList-icon">
                        @if($item->images == 'dawn.png')
                        <!-- 初期アイコン -->
                        <p><a href="{{ url('users/' .$item->id) }}"><img src="{{ asset('images/' .$item->images) }}" class="rounded-circle"></a></p>
                        @else
                        <!-- アップロードしたアイコン -->
                        <p><a href="{{ url('users/' .$item->id) }}"><img src="{{ asset('storage/images/' .$item->images) }}" class="rounded-circle"></a></p>
                        @endif
                    </div>
                    @endif
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <!-- 6.2.2 フォロワーリスト/フォロワーユーザーのつぶやき一覧の設置 -->
        @if (isset($timeline))
        @foreach ($timeline as $time)
        <div class="tweets-top">
            <div class="card">
                <div class="tweet-timelines">
                    <div id="top-image2" class="top-image2">
                        @if($time->user->images == 'dawn.png')
                        <!-- 初期アイコン -->
                        <p><a href="{{ url('users/' .$time->user->id) }}"><img src="{{ asset('images/' .$time->user->images) }}" class="rounded-circle"></a></p>
                        @else
                        <!-- アップロードしたアイコン -->
                        <p><a href="{{ url('users/' .$time->user->id) }}"><img src="{{ asset('storage/images/' .$time->user->images) }}" class="rounded-circle"></a></p>
                        @endif
                    </div>
                    <div class="timelines">
                        <p class="tweets-top-username">{{ $time->user->username }}</p>
                        <p class="tweets-top-text">{{ $time->posts }}</p>
                    </div>
                    <div class="tweets-top-time">
                        <p class="">{{ $time->created_at }}</p>
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

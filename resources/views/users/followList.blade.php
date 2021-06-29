@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="followList-title">Follow list</div>
        <div class="card-body">
            <div class="followList-form-group">
                @if(!empty($data))
                @foreach($data as $item)
                <div class="followList-icon-list">
                    @if (auth()->user()->isFollowing($item->id))
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

        @if (isset($timelines))
        @foreach ($timelines as $timeline)
        <div class="tweets-top">
            <div class="card">
                <div class="tweet-timelines">
                    <div id="top-image2" class="top-image2">
                        @if($timeline->user->images == 'dawn.png')
                        <!-- 初期アイコン -->
                        <p><a href="{{ url('users/' .$timeline->user->id) }}"><img src="{{ asset('images/' .$timeline->user->images) }}" class="rounded-circle"></a></p>
                        @else
                        <!-- アップロードしたアイコン -->
                        <p><a href="{{ url('users/' .$timeline->user->id) }}"><img src="{{ asset('storage/images/' .$timeline->user->images) }}" class="rounded-circle"></a></p>
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
    <div class="my-4 d-flex justify-content-center">
        {{ $timelines->links() }}
    </div>
</div>


@endsection

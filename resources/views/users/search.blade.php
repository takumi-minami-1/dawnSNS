@extends('layouts.login')

@section('content')
<!-- 5.1 入力フォームの設置 -->
<div class="container-search">
  <div class="row">

    <div class="search-form-group">
      {!! Form::open(['route' => 'search', 'method' => 'get']) !!}
      <div class="search-forms">
        {!! Form::text('username' ,'', ['class' => 'search-form', 'placeholder' => ' ユーザー名'] ) !!}
        <button class="my-search fa fa-search fa-rotate-90"></button>
        {!! Form::close() !!}

        @if(!empty($search1))

        <label for="form" class="search-name">{{ __('検索ワード：') }}</label>
        <h4 class="search-name-search">{{ $search1 }}</h4>

        @endif
      </div>
    </div>

    <!-- 5.2.1 ユーザー検索の結果一覧を表示 -->
    @if(!empty($data))
    @foreach($data as $item)
    <!-- <div class="card"> -->
    <div class="search-list">
      <div class="search-list-image">

        @if($item->images == 'dawn.png')
        <!-- 初期アイコン -->
        <p><img src="{{ asset('images/' .$item->images) }}" class="rounded-circle"></p>
        @else
        <!-- アップロードしたアイコン -->
        <p><img src="{{ asset('images/' .$item->images) }}" class="rounded-circle"></p>
        @endif
      </div>
      <div class="search-list-name">
        <p class="search-list-name-1">{{ $item->username }}</p>
      </div>
      <!-- 5.2.2 フォローする,フォロをーはずすボタンの設置 -->
      <div class="search-list-follow">
        @if (auth()->user()->isFollowing($item->id))
        <form action="{{ route('unfollow', ['id' => $item->id]) }}" method="POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}

          <button type="submit" class="search-btn-follow1 search-btn-primary-follow1">フォローをはずす</button>
        </form>
        @else
        <form action="{{ route('follow', ['id' => $item->id]) }}" method="POST">
          {{ csrf_field() }}

          <button type="submit" class="search-btn-follow2 search-btn-primary-follow2">フォローする</button>
        </form>
        @endif
      </div>

    </div>
    @endforeach
    @endif


  </div>
  @endsection
</div>

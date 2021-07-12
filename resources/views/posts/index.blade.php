@extends('layouts.login')

@section('content')
<!-- 4.1 投稿フォームの設置 -->
<div class="container">
  <div class="row">
    <form method="POST" action="{{ route('top.store') }}">
      {{ csrf_field() }}

      <div class="form-group">
        <div class="form-group-image">
          @if(auth()->user()->images == 'dawn.png')
          <!-- 初期アイコン -->
          <p><img src="{{ asset('images/' .auth()->user()->images) }}" class="rounded-circle"></p>
          @else
          <!-- アップロードしたアイコン -->
          <p><img src="{{ asset('storage/images/' .auth()->user()->images) }}" class="rounded-circle"></p>
          @endif
        </div>
        <div class="form-group-text">
          <textarea class="form-control" name="posts" style="border:none;" required rows="4" placeholder="何をつぶやこうか...?">{{ old('posts') }}</textarea>

          @error('posts')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

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
          @if($timeline->user->images == 'dawn.png')
          <!-- 初期アイコン -->
          <p><img src="{{ asset('images/' .$timeline->user->images) }}" class="rounded-circle"></p>
          @else
          <!-- アップロードしたアイコン -->
          <p><img src="{{ asset('storage/images/' .$timeline->user->images) }}" class="rounded-circle"></p>
          @endif
        </div>
        <div class="timelines">
          <p class="tweets-top-username">{{ $timeline->user->username }}</p>
          <p class="tweets-top-text">{!! nl2br(e($timeline->posts)) !!}</p>
        </div>
        <div class="tweets-top-time">
          <p>{{ $timeline->created_at }}</p>
        </div>
      </div>


      @if ($timeline->id === Auth::user()->id)


      <div class="tweet-menu">

        {{-- ここから --}}
        <!-- 1.モーダル表示のためのボタン -->
        <input src='images/edit.png' type="image" class="edit-menu-icon" data-toggle="modal" onclick="editModal({{$timeline->id}})"></input>

        <!-- 2.モーダルの配置 -->
        <div class="edit-modal editModal-{{ $timeline->id }}" tabindex="-1" id="modal-content">
          <form method="POST" action="{{ url('posts/' .$timeline->id) }}">
            <div class="edit-modal-dialog">
              <!-- 3.モーダルのコンテンツ -->
              <div class="edit-modal-content">

                <!-- 5.モーダルのボディ -->
                <div class="edit-modal-body">
                  <textarea class="form-control-edit @error('posts') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('posts') ? : $timeline->posts }}</textarea>

                  @error('posts')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <!-- 6.モーダルのフッタ -->
                <div class="edit-modal-footer">
                  <p><a id="modal-close" class="button-link" onclick="editModal({{$timeline->id}})"></a></p>
                  <form method="post" action="{{ action('PostsController@update', $user->id) }}" name="text">
                    @csrf
                    @method('PUT')
                    <input src='images/edit.png' type="image" class="icon" onclick="editModal({{$timeline->id}})"></input>
                  </form>
                </div>
              </div>
            </div>
          </form>
        </div>
        {{-- ここまで --}}

        {{-- ここから --}}
        <!-- 1.モーダル表示のためのボタン -->
        <input src='images/trash_h.png' type="image" class="delete-menu-icon" data-toggle="modal" onclick="deleteModal({{$timeline->id}})"></input>

        <!-- 2.モーダルの配置 -->
        <div class="delete-modal deleteModal-{{ $timeline->id }}" tabindex="-1">
          <form method="POST" action="{{ url('posts/' .$timeline->id) }}" class="mb-0">
            <div class="delete-modal-dialog">
              <!-- 3.モーダルのコンテンツ -->
              <div class="delete-modal-content">

                <!-- 5.モーダルのボディ -->
                <div class="delete-modal-body">
                  <p>このつぶやきを削除します。よろしいでしょうか？</p>
                </div>

                <!-- 6.モーダルのフッタ -->
                <div class="delete-modal-footer">
                  <form method="post" action="{{ action('PostsController@destroy', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="delete-btn delete-btn-primary" onclick="deleteModal({{$timeline->id}})">OK</button>
                  </form>
                  <button type="button" class="delete-btn delete-btn-default" data-dismiss="modal" onclick="deleteModal({{$timeline->id}})">キャンセル</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        {{-- ここまで --}}



      </div>

      @endif

    </div>
  </div>
  @endforeach
  @endif





</div>
@endsection

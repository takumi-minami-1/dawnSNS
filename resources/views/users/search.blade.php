@extends('layouts.login')

@section('content')
<!-- 5.1 入力フォームの設置 -->
<div class="container">
  <div class="row">

    <div class="search-form-group">
      {!! Form::open(['route' => 'search', 'method' => 'get']) !!}
      <div class="search-forms">
        {!! Form::text('username' ,'', ['class' => 'search-form', 'placeholder' => ' ユーザー名'] ) !!}
        <button class="my-search fa fa-search fa-rotate-90"></button>
        {!! Form::close() !!}

        @if(!empty($search1))
        <div class="search-name-group">
          <label for="form" class="search-name">{{ __('検索ワード：') }}</label>
          <h4 class="search-name-search">{{ $search1 }}</h4>
        </div>
      </div>
      @endif
    </div>
  </div>





</div>
</div>



@endsection

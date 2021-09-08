<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <!-- jQueryの読み込み -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- 5.1 入力フォームの設置 -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<body>
    <header>
        <div id="boxContainer">
            <div id="box1">
                <h1><a href="/top"><img src="{{ asset('images/main_logo.png') }}" class="top-logo"></a></h1>
            </div>
            <div id="box2" class="accordion-container">
                <p class="accordion-title js-accordion-title">{{ Auth::user()->username }} さん</p>
                <div class="accordion-content">
                    <ul>
                        <div class="accordion-content-home">
                            <li><a href="/top" class="a-home">HOME</a></li>
                        </div>
                        <div class="accordion-content-profile">
                            <li><a href="{{ url('users/' .$user->id .'/edit') }}" class="a-profile">プロフィール編集</a></li>
                        </div>
                        <div class="accordion-content-logout">
                            <li><a href="/logout" class="a-logout">ログアウト</a></li>
                        </div>
                    </ul>
                </div>
                <!--/accordion-content-->
            </div>
            <!-- アイコン -->
            <div id="box3" class="top-image">
                @if(auth()->user()->images == 'dawn.png')
                <p><img src="{{ asset('images/' .auth()->user()->images) }}" class="mr-2"></p>
                @else
                <p><img src="{{ asset('public/images/' .auth()->user()->images) }}" class="mr-2"></p>
                @endif
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="side-bar-confirm">
                <div id="side-bar-confirm-follows">
                    <div id="side-bar-confirm-follow">
                        <p class="side-name">{{ Auth::user()->username }} さんの</p>
                        <p class="side-follow">フォロー数</p>
                    </div>
                    <div id="side-bar-confirm-follow-count">
                        <p>　{{ $follow_count }} 名</p>
                    </div>
                </div>
                <div id="side-bar-confirm-follow-list">
                    <p class="btn"><a href="/followList" class="side-btn side-btn-url">フォローリスト</a></p>
                </div>
                <div id="side-bar-confirm-followers">
                    <div id="side-bar-confirm-follower">
                        <p>フォロワー数</p>
                    </div>
                    <div id="side-bar-confirm-follower-count">
                        <p>{{ $follower_count }} 名</p>
                    </div>
                </div>
                <div id="side-bar-confirm-follower-list">
                    <p class="btn"><a href="/followerList" class="side-btn side-btn-url">フォロワーリスト</a></p>
                </div>
            </div>
            <div id="side-bar-confirm-search">
                <p class="btn"><a href="/search" class="side-btn side-btn-url">ユーザー検索</a></p>
            </div>
        </div>
    </div>
    <footer>
    </footer>
    <script src="{{ asset('js/style.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>

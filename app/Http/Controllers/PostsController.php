<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;

class PostsController extends Controller
{
    // 3.3 サイドバー/フォロー,フォロワー数の表示
    public function index(User $user, Follow $follow)
    {
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        return view('posts.index', [
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }
}

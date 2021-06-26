<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Post;
use App\Follow;
// use Illuminate\Support\Facades\Log;

class PostsController extends Controller
{
    // 3.3 サイドバー/フォロー,フォロワー数の表示
    // 4.2.1 ログインユーザーのフォローのつぶやき表示を表示
    public function index(User $user, Follow $follow, Post $post)
    {
        // Log::debug(auth()->user());
        $user = auth()->user();
        // dd($user);
        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('follower')->toArray();

        $timelines = $post->getTimelines($user->id, $following_ids);

        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        return view('posts.index', [
            'user'      => $user,
            'timelines' => $timelines,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
        ]);
    }

    // 4.1 ログインユーザーのつぶやきを登録
    public function store(Request $request, Post $post)
    {
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'posts' => ['required', 'string', 'max:150']
        ]);

        $validator->validate();
        $post->postStore($user->id, $data);

        return redirect('top');
    }
}

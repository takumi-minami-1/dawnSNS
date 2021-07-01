<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;
// use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    // 5.1 入力フォームの設置
    public function search(User $user, Follow $follow, Request $request)
    {
        // 5.2.1 ユーザー検索の結果一覧を表示
        $user = auth()->user();
        // $users = $user->get();
        $search1 = $request->input('username');
        // $all_users = $user->getAllUsers(auth()->user()->id);

        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        if ($request->has('username') && $search1 != '') {
            $users = User::where('username', 'like', "%{$search1}%")->where('id', '<>', $user->id)->get();
            $data = $users;
        } else {
            $users = $user->getAllUsers(auth()->user()->id);
            $data = $users;
        }

        return view('users.search', [
            'user'           => $user,
            'users'           => $users,
            // 'all_users'  => $all_users,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'data' => $data,
            'search1' => $search1,
        ]);
    }

    // 5.2.3 followsテーブルへの登録と削除
    // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // // フォローしているか
        // $is_following = $follower->select('user.id', 'follow.id')->isFollowing($user->id);
        $is_following = $follower->isFollowing($user->id);
        if (!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        // $is_following = $follower->select('user.id', 'follow.id')->isFollowing($user->id);
        $is_following = $follower->isFollowing($user->id);
        if ($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }

    // 6.1.1 フォローリスト/フォローユーザーのアイコン一覧の設置
    // 6.1.2 フォローリスト/フォローユーザーのつぶやき一覧の設置
    public function followList(User $user, Follow $follow, Post $post)
    {
        // Log::debug(auth()->user());
        $user = auth()->user();
        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('follower')->toArray();

        // $timelines = $post->getTimelines($user->id, $following_ids);
        $timelines = $post->getTimeLinesFollow($user->id, $following_ids);

        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        $users = $user->getAllUsers(auth()->user()->id);
        $data = $users;

        return view('users.followList', [
            'user'      => $user,
            'timelines' => $timelines,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'data' => $data,
        ]);
    }

    // 6.2.1 フォロワーリスト/フォロワーユーザーのアイコン一覧の設置
    // 6.2.2 フォロワーリスト/フォロワーユーザーのつぶやき一覧の設置
    public function followerList(User $user, Follow $follow, Post $post)
    {
        $user = auth()->user();
        $follower_ids = $follow->followedIds($user->id);
        $followed_ids = $follower_ids->pluck('follow')->toArray();

        $timeline = $post->getTimelineFollower($user->id, $followed_ids);

        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        $users = $user->getAllUsers(auth()->user()->id);
        $data = $users;

        return view('users.followerList', [
            'user'      => $user,
            'timeline' => $timeline,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'data' => $data
        ]);
    }









    public function profile()
    {
        return view('users.profile');
    }
}

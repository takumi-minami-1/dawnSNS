<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;

class UsersController extends Controller
{
    // 5.1 入力フォームの設置
    public function search(User $user, Follow $follow, Request $request)
    {
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        // 5.2.1 ユーザー検索の結果一覧を表示
        $user = auth()->user();
        $all_users = $user->getAllUsers(auth()->user()->id);

        if ($request->has('username') && $search1 != '') {
            $users = User::where('username', 'like', "%{$search1}%")->get();
        } else ($user->getAllUsers(auth()->user()->id));

        $data = $users->paginate(10);

        return view('users.search', [
            'user'           => $user,
            'users'           => $users,
            'all_users'  => $all_users,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'data' => $data,
            'search1' => $search1,
        ]);
    }

    public function profile()
    {
        return view('users.profile');
    }
}

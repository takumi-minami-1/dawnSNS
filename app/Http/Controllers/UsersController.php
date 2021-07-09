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

    // 6.3 ユーザーのアイコンから相手のプロフィールページへの遷移
    public function show(User $user, Post $post, Follow $follow)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $timelines = $post->getUserTimeLine($user->id);
        $post_count = $post->getPostCount($user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);

        return view('users.show', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'timelines'      => $timelines,
            'post_count'    => $post_count,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    // 8.1 ログインユーザーの情報を取得
    public function edit(User $user, Follow $follow)
    {
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        return view('users.edit', [
            'user' => $user,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    public function update(Request $request, User $user)
    {
        if ('PUT' == $request->input('_method')) {
            $data = $request->all();

            $validator = Validator::make($data, [
                'username'   => ['required', 'min:4', 'max:12', Rule::unique('users')->ignore($user->id)],
                'mail'         => ['required', 'min:4', 'max:12', Rule::unique('users')->ignore($user->id)],
                'password_raw'   => ['required', 'min:4', 'max:12', 'alpha_num', Rule::unique('users')->ignore($user->id)],
                'bio'   => ['nullable', 'max:200'],
                'images' => ['nullable', 'file', 'image', 'mimes:png,jpg,bmp,gif,svg'],
            ]);

            if ($validator->fails()) {
                return redirect('users/' . $user->id . '/edit')
                    ->withErrors($validator)
                    ->withInput();
            } else {

                if (isset($data["images"])) {
                    $file_name = $data["images"]->store('public/images/');

                    \DB::table('users')
                        ->where('id', $user->id)
                        ->update([
                            'username' => $data["username"],
                            'mail' => $data["mail"],
                            'password_raw' => $data['password_raw'],
                            'password' => bcrypt($data['password_raw']),
                            'bio' => $data["bio"],
                            'images' => basename($file_name),
                        ]);

                    return redirect('users/' . $user->id);
                } else {

                    \DB::table('users')
                        ->where('id', $user->id)
                        ->update([
                            'username' => $data["username"],
                            'mail' => $data["mail"],
                            'password_raw' => $data['password_raw'],
                            'password' => bcrypt($data['password_raw']),
                            'bio' => $data["bio"],
                        ]);

                    return redirect('users/' . $user->id);
                }
            }
        }
    }





    // public function profile()
    // {
    //     return view('users.profile');
    // }
}

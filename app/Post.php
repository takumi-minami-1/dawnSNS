<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 4.2 ログインユーザーのつぶやきを表示
    // 4.2.1 ログインユーザーのフォローのつぶやき表示を表示
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 4.1 ログインユーザーのつぶやきを登録
    public function postStore(Int $user_id, array $data)
    {
        $this->user_id = $user_id;
        $this->posts = $data['posts'];
        $this->save();

        return;
    }

    // 4.2.1 ログインユーザーのフォローのつぶやき表示を表示
    public function getTimeLines(Int $user_id, array $follow_ids)
    {
        $follow_ids[] = $user_id;
        return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    }

    // 6.1.2 フォローリスト/フォローユーザーのつぶやき一覧の設置
    public function getTimeLinesFollow(Int $follow_id, array $follow_ids)
    {
        // $follow_ids[] = $follow_id;
        $id = Auth::id();
        $follow_ids[] = Follow::where('follow', $id);
        return $this->where('user_id', $follow_ids)->orderBy('created_at', 'DESC')->get();
    }

    // 6.2.2 フォロワーリスト/フォロワーユーザーのつぶやき一覧の設置
    public function getTimelineFollower(Int $follower_id, array $follower_ids)
    {
        // $id = Auth::id();
        // $follower_ids[] = Follow::where('follower', $id);
        $follower_ids[] = $follower_id;
        return $this->where('user_id', $follower_ids)->orderBy('created_at', 'DESC')->get();
    }

    // 6.3 ユーザーのアイコンから相手のプロフィールページへの遷移
    public function getUserTimeLine(Int $user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
    }

    public function getPostCount(Int $user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }
}

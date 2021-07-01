<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
  // 3.3 サイドバー/フォロー,フォロワー数の表示
  public function getFollowCount($user_id)
  {
    return $this->where('follow', $user_id)->count();
  }

  public function getFollowerCount($user_id)
  {
    return $this->where('follower', $user_id)->count();
  }

  // 4.2.1 ログインユーザーのフォローのつぶやき表示を表示
  // フォローしているユーザのIDを取得
  public function followingIds(Int $user_id)
  {
    return $this->where('follow', $user_id)->select('follower')->get();
  }

  // 6.2.2 フォロワーリスト/フォロワーユーザーのつぶやき一覧の設置
  // フォローされているユーザのIDを取得
  public function followedIds(Int $user_id)
  {
    return $this->where('follower', $user_id)->select('follow')->get();
  }
}

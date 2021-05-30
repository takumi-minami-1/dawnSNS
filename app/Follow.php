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
}

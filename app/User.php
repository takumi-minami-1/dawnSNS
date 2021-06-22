<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 5.2.1 ユーザー検索の結果一覧を表示
    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }

    // 5.2.2 フォローする,フォロをーはずすボタンの設置
    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'follower', 'follow');
    }

    // 5.2.2 フォローする,フォロをーはずすボタンの設置
    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'follow', 'follower');
    }

    // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (bool) $this->follows()->where('follower', $user_id)->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (bool) $this->followers()->where('follow', $user_id)->first(['id']);
    }
}

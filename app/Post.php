<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 4.1 ログインユーザーのつぶやきを登録
    public function postStore(Int $user_id, array $data)
    {
        $this->user_id = $user_id;
        $this->posts = $data['posts'];
        $this->save();

        return;
    }

    // 4.2.1 ログインユーザーのフォローのつぶやき表示を表示
    // public function getTimeLines(Int $user_id, array $follow_ids)
    // {
    //     $follow_ids[] = $user_id;
    //     return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    // }
}

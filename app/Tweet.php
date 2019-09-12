<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    /**
     * リレーションシップ - usersテーブル
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }

    /** JSONに含めない属性 */
    protected $hidden = [
      'user_id',
      self::CREATED_AT, self::UPDATED_AT,
    ];

    /** JSONに含める属性 */
    protected $visible = [
      'id', 'owner', 'text',
    ];
}

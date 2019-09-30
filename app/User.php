<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * リレーションシップ - tweetsテーブル
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tweets()
    {
        return $this->hasMany('App\Tweet');
    }

    public function followUsers()
    {
        return $this->belongsToMany(self::class, 'follow_users', 'user_id', 'followed_user_id')
            ->using(FollowUser::class);
    }

    public function followCount()
    {
        $current = Auth::user()->id;
        // $follow_count = FollowUser::where('user_id', $current)->count()->get();
        // return $follow_count;
        return $this->FollowUser::where('user_id', $current)->count()->get();
    }

    public function followedCount()
    {
        $current = Auth::user()->id;
        $followed_count = FollowUser::where('followed_user_id', $current)->count()->get();
        return $followed_count;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tweets', 'followCount', 'followedCount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'email_verified_at', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $visible = [
        'id', 'name', 'email', 'tweets', 'followCount', 'followedCount'
    ];

}

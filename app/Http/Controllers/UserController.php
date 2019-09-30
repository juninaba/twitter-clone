<?php

namespace App\Http\Controllers;

use App\FollowUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth')->except(['show']);
    }

    /**
     * user詳細
     * @param string $id
     * @return User
     */
    public function show(string $id)
    {
        $user = User::where('id', $id)->with(['tweets'],['followCount'],['followedCount'])->first();

        return $user ?? abort(404);
    }

    /**
     * user編集
     * @param string $id
     * @return User
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();

        return $user ?? abort(404);
    }

    /**
     * user保存
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
        return response($user, 201);
    }
    
    /**
     * follow
     * @param string $id
     * @return User
     */
    public function follow(string $id)
    {
        $user = Auth::user();
        $follow_users = FollowUser::where('user_id', $user->id)->get();
        foreach ($follow_users as $user) {
            $users[] = User::where('id', $user->followed_user_id)->get();
        }

        return $users;
    }

    /**
     * followed
     * @param string $id
     * @return User
     */
    public function followed(string $id)
    {
        $user = Auth::user();
        $followed_users = FollowUser::where('followed_user_id', $user->id)->get();
        foreach ($followed_users as $user) {
            $users[] = User::where('id', $user->user_id)->get();
        }

        return $users;
    }
}

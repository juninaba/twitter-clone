<?php

namespace App\Http\Controllers;

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
        $user = User::where('id', $id)->with(['tweets'])->first();
        // $user = User::where('id', $id)->first();
        // $tweets = $user->tweets()->get();

        return $user ?? abort(404);
        // return $tweets ?? abort(404);
        // return [$user, $tweets];
    }
}

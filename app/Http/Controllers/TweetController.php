<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTweet;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TweetController extends Controller
{
    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth');
    }
    /**
     * tweet投稿
     * @param StoreTweet $request
     * @return \Illuminate\Http\Response
     */
    public function create(StoreTweet $request)
    {

        $tweet = new Tweet();
        $tweet->user_id = Auth::user()->id;
        $tweet->text = $request->get('text');


        Auth::user()->tweets()->save($tweet);

        // リソースの新規作成なので
        // レスポンスコードは201(CREATED)を返却する
        return response($tweet, 201);
    }
}
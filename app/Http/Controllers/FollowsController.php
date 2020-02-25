<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FollowsController extends Controller
{
    /**
     *  フォロー登録
     */
    public function ajaxfollow(Request $request)
    {
        Log::debug('<<<<<<<< ajaxフォロー発動！>>>>>>>>>>>>>');
        Log::debug('<<<<<<<< $request 内容 >>>>>>>>>>>>>');
        Log::debug($request);

        $user_id = $request->follow;

        $follow = Follow::where('followed_user_id',$user_id)->where('follow_user_id',Auth::user()->id)->count();
        if($follow > 0){
            Log::debug('<<<<<<<< フォロー削除処理　>>>>>>>>>>>>>');
            $follow = Follow::where('followed_user_id',$user_id)->where('follow_user_id', Auth::user()->id)->delete();
            return response()->json($follow);
        }else{
            Log::debug('<<<<<<<< フォロー追加処理　>>>>>>>>>>>>>');
            $follow = new Follow;
            $follow->follow_user_id = Auth::user()->id;
            $follow->followed_user_id = $user_id;
            $follow->save();
            return response()->json($follow);
        }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;




class LikesController extends Controller
{
    /**
     * お気に入り登録
     */
    public function ajaxlike(Request $request)
    {
        Log::debug('<<<<<<<< ajax発動！>>>>>>>>>>>>>');
        Log::debug('<<<<<<<< $request 内容 >>>>>>>>>>>>>');
        Log::debug($request);

        $product_id = $request->like;

        $liked = Like::where('product_id',$product_id)->where('user_id',Auth::user()->id)->count();
        if($liked > 0){
            Log::debug('<<<<<<<< お気に入り削除処理　>>>>>>>>>>>>>');
            $like = Like::where('product_id',$product_id)->where('user_id', Auth::user()->id)->delete();
            return response()->json($like);
        }else{
            Log::debug('<<<<<<<< お気に入り追加処理　>>>>>>>>>>>>>');
            $like = new Like;
            $like->product_id = $product_id;
            $like->user_id = Auth::user()->id;
            $like->save();
            return response()->json($like);
        }

    }
}

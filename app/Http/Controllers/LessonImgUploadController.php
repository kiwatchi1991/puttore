<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LessonImgUploadController extends Controller
{
     /**
     * お気に入り登録
     */
    public function imgupload(Request $request)
    {
        Log::debug('<<<<<<<< imgupload ajax発動！>>>>>>>>>>>>>');
        Log::debug('<<<<<<<< $request 内容 >>>>>>>>>>>>>');
        Log::debug($request);

        return response()->json('OK');
    }

}

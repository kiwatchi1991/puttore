<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LessonImgUploadController extends Controller
{
     /**
     * 画像アップロード
     */
    public function imgupload(Request $request)
    {
        Log::debug('<<<<<<<< imgupload ajax発動！>>>>>>>>>>>>>');
        Log::debug('<<<<<<<< $request 内容 >>>>>>>>>>>>>');
        Log::debug($request);

        return response()->json('OK');
    }

}

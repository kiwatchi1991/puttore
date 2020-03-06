<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lessonimg;
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
        Log::debug($request->file);

        $Lessonimg = new Lessonimg;
        $Lessonimg->path = $request->file;
        $path = $request->file->store('public/lesson_images');
        $Lessonimg->path = str_replace('public/', '', $path);

        Log::debug('<<<<<<<< $Lessonimg 内容 >>>>>>>>>>>>>');
        Log::debug($Lessonimg);
        $Lessonimg->save();

        return response()->json($Lessonimg->path);
    }

}

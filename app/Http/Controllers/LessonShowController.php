<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonShowController extends Controller
{
    /**
     * レッスン表示
     */
    public function index($p_id, $l_id)
    {
        if (!ctype_digit($p_id)) {
            return redirect('/products')->with('flash_message', __('Invalid operation was performed.'));
        }
        if (!ctype_digit($l_id)) {
            return redirect('/products')->with('flash_message', __('Invalid operation was performed.'));
        }

        return view('products.lesson', [
            'p_id' => $p_id,
            'l_id' => $l_id,
        ]);
    }
}

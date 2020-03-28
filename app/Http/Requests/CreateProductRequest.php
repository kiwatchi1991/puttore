<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        Log::debug('<<<<  product バリデーションちぇっく！ >>>>>>>');
        Log::debug($request);

        if ($request->postType !== 'draft') {

            return [
                'name' => 'required|string|max:255',
                'lang' => 'required',
                'difficult' => 'required',
                'detail' => 'required|string|max:255',
                'skills' => 'required|string|max:255',
                'default_price' => 'required|integer|min:100',

                'lessons.*.title' => 'required|max:255',
                'lessons.*.lesson' => 'required|',

                'pic1' => 'nullable|image',
                'pic2' => 'nullable|image',
                'pic3' => 'nullable|image',
                'pic4' => 'nullable|image',
                'pic5' => 'nullable|image',
                'pic6' => 'nullable|image',
            ];
        } else {
            Log::debug('<<<<<<   下書きだからバリデーションしない  >>>>>');
            return [];
        }
    }
}

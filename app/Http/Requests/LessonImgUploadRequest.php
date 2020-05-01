<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LessonImgUploadRequest extends FormRequest
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
        Log::debug('<<<<  LessonImgUpload バリデーションチェック >>>>>>>');
        Log::debug($request);

        return [
            'file' => 'nullable|image|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'file.image' => 'アップロードできるのは画像のみです',
            'file.min' => '画像は2MB以下のサイズにしてください。',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response['data']    = [];
        $response['status']  = 'NG';
        $response['summary'] = 'Failed validation.';
        $response['errors']  = $validator->errors()->toArray();

        throw new HttpResponseException(
            response()->json($response, 422)
        );
    }
}

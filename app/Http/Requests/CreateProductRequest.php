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
        Log::debug('<<<<  product バリデーションチェック >>>>>>>');
        Log::debug($request);

        //割引価格以外のバリデーション対象
        $validTargets = [
            'name' => 'required|string|max:255',
            'lang' => 'required',
            'difficult' => 'required',
            'detail' => 'required|string|max:255',
            'skills' => 'required|string|max:255',
            'default_price' => 'required|integer|min:500|max:99999',

            'lessons.*.title' => 'required|max:255',
            'lessons.*.lesson' => 'required|',

            'pic1' => 'nullable|image',
            'pic2' => 'nullable|image',
            'pic3' => 'nullable|image',
            'pic4' => 'nullable|image',
            'pic5' => 'nullable|image',
            'pic6' => 'nullable|image',
        ];

        //割引価格の情報が何かしら入力された時はバリデーションを行う
        if ($request->discount_price || $request->start_date || $request->end_date) {
            $discount = [
                'discount_price' => 'required|integer|min:500|max:99999',
                'start_date' => 'required|date|after:today',
                'end_date' => 'required|date|after:start_date',
            ];
            $validTargets = array_merge($validTargets, $discount);
        }

        return $validTargets;
    }

    public function messages()
    {
        return [
            'default_price.min' => ':attributeは 500円 以上 99,999円 以下に設定してください。',
            'default_price.max' => ':attributeは 500円 以上 99,999円 以下に設定してください。',
            'discount_price.required' => '割引価格の設定には金額が必須です。',
            'discount_price.min' => ':attributeは 500円 以上 99,999円 以下に設定してください。',
            'discount_price.max' => ':attributeは 500円 以上 99,999円 以下に設定してください。',
            'start_date.required' => '割引価格の設定には:attributeが必須です。',
            'start_date.after' => '開始日は明日以降の日付にしてください。',
            'end_date.required' => '割引価格の設定には:attributeが必須です。',
        ];
    }
}

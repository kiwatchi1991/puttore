<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpdateBankInfoRequest extends FormRequest
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
    public function rules()
    {
        return [
            'bank_account_holder_name' => 'required|regex:/^[ァ-ヴー]+$/',
            'bank_code' => 'required|regex:/^[0-9]{4}$/',
            'bank_branch_code' => 'required|regex:/^[0-9]{3}$/',
            'bank_account_type' => 'required|boolean',
            'bank_account_number' => 'required|regex:/^[0-9]+$/',

        ];
    }

    public function messages()
    {
        return [
            'bank_account_holder_name.required' => '入力必須です。',
            'bank_account_holder_name.regex' => '口座名義人は、カタカナで入力してください。',
            'bank_code.required' => '入力必須です。',
            'bank_code.regex' => '正しい形式で入力してください。',
            'bank_branch_code.required' => '入力必須です。',
            'bank_branch_code.regex' => '正しい形式で入力してください。',
            'bank_account_type.required' => '入力必須です。',
            'bank_account_type.boolean' => 'もう一度入力をやり直してください。',
            'bank_account_number.required' => '入力必須です',
            'bank_account_number.regex' => '正しい形式で入力してください。',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        'category_id' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'gender' => 'required',
        'email' => 'required|email',
        'tel1' => '',
        'tel2' => '',
        'tel3' => '',
        'address' => 'required',
        'building' => '',
        'detail' => 'required|max:120',
        ];
    }

    public function messages()
    {
        return [
            'category_id' => 'お問い合わせの種類を選択してください',
            'first_name.required' => '名を入力してください',
            'last_name.required' => '性を入力してください',
            'gender.required' => '性別を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel.required' => '電話番号を入力してください',
            'address.required' => '住所を入力してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問合わせ内容は120文字以内で入力してください',
        ];
    }

    /** tel1, tel2, tel3 をまとめてチェック **/
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (empty($this->tel1) || empty($this->tel2) || empty($this->tel3)) {
                // tel1,2,3 のどれかが未入力なら tel にエラーを追加
                $validator->errors()->add('tel', '電話番号を入力してください');
            }
        });
    }

    /** validated()を拡張してtelを結合 **/
    public function validated($key = null, $default = null)
    {
        $data = parent::validated();

        $data['tel'] = $this->tel1.$this->tel2.$this->tel3;

        unset($data['tel1'], $data['tel2'], $data['tel3']);

        return $data;
    }
}

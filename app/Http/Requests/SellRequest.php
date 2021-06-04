<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
            'item-image'  => ['required', 'file', 'image'],
            'name'        => ['required', 'string', 'max:255'],
            // 'item-image'  => ['required', 'file', 'image'],
            'description' => ['required', 'string', 'max:2000'],
            'category'    => ['required', 'integer'],
            'condition'   => ['required', 'integer'],
            'price'       => ['required', 'integer', 'min:100', 'max:9999999'],
       ];
   }

    public function attributes()
    {
        return [
            // attributesメソッドで項目名を日本語化できます。
            'name'        => '商品名',
            'description' => '商品の説明',
            'category'    => 'カテゴリ',
            'condition'   => '商品の状態',
            'price'       => '販売価格',
        ];
    }

    }


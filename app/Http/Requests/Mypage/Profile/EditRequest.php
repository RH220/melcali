<?php

namespace App\Http\Requests\Mypage\Profile;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//     authorizeメソッドには、リソースを操作する権限を持っているかを調べる処理を書きます。
// 例えば、ブログシステムなどで、記事の編集権限を別のアカウントに付与できる仕組みがある時に、
// 編集しようとしている記事に対してログインしているユーザが編集権限を持っているかをこのメソッド内でチェックしたりします。
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
            'avatar' => ['file', 'image'],
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}

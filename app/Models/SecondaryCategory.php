<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecondaryCategory extends Model
{
    public function primaryCategory()
    {
        // belongsToメソッドを使って、小カテゴリと大カテゴリの間の1対多のリレーションを定義しています。
        return $this->belongsTo(PrimaryCategory::class);
    }
}

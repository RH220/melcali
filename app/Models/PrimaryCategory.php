<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrimaryCategory extends Model
{
    public function secondaryCategories()
    {
        // hasManyメソッドを使って1対多のリレーションを定義しています。
        return $this->hasMany(SecondaryCategory::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // 商品の出品状態を表す定数
   // 出品中
   const STATE_SELLING = 'selling';
   // 購入済み
   const STATE_BOUGHT = 'bought';
    // Eloquent Modelのcastsフィールドを使うことで、
    // カラムの値を取り出す際に、データ型を変換させることができます。
   protected $casts = [
    // datetime(Carbonクラス)に変換する
    'bought_at' => 'datetime',
];
   public function secondaryCategory()
   {
    // belongsToメソッドを使って、商品とカテゴリの間の1対多のリレーションを定義しています。
       return $this->belongsTo(SecondaryCategory::class);
   }
   public function seller()
   {
       return $this->belongsTo(User::class, 'seller_id');
   }

   public function condition()
   {
       return $this->belongsTo(ItemCondition::class, 'item_condition_id');
   }
   public function getIsStateSellingAttribute()
     {
         return $this->state === self::STATE_SELLING;
     }
     public function getIsStateBoughtAttribute()
     {
         return $this->state === self::STATE_BOUGHT;
     }
}

<?php

namespace App\Http\Controllers;
use App\Http\Requests\SellRequest;
use App\Models\Item;
use App\Models\ItemCondition;
use App\Models\PrimaryCategory;
use Illuminate\Http\File;
use Illuminate\Http\Request;
  use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Storage;
  use Intervention\Image\Facades\Image;
class SellController extends Controller
{
    public function showSellForm()
    {
        // getメソッドでクエリを発行できます。
        $categories = PrimaryCategory::query()
        // withメソッドでEager Loadingを行います。
        ->with([
            'secondaryCategories' => function ($query) {
                $query->orderBy('sort_no');
            }
        ])
        ->orderBy('sort_no')
        ->get();
        $conditions = ItemCondition::orderBy('sort_no')->get();
        return view('sell')
        ->with('categories', $categories)
            ->with('conditions', $conditions);
    }

    public function sellItem(SellRequest $request)
    {
        $user = Auth::user();
        $imageName = $this->saveImage($request->file('item-image'));
        // Itemクラス(Eloquent Model)のインスタンスを作成します。
        $item                        = new Item();
        $item->seller_id             = $user->id;
        $item->image_file_name       = $imageName;
        $item->name                  = $request->input('name');
        $item->description           = $request->input('description');
        $item->secondary_category_id = $request->input('category');
        $item->item_condition_id     = $request->input('condition');
        $item->price                 = $request->input('price');
        // Item::STATE_SELLINGは商品の出品状態を表す定数で、ここでは「出品中」を設定しています。
        $item->state                 = Item::STATE_SELLING;
        $item->save();

        return redirect()->back()
            ->with('status', '商品を出品しました。');
    }
    /**
      * 商品画像をリサイズして保存します
      *
      * @param UploadedFile $file アップロードされた商品画像
      * @return string ファイル名
      */
      private function saveImage(UploadedFile $file): string
     {
        $ff=$file->getClientOriginalName();

         $tempPath=$ff;
        //  exifが横向きだと編集して縦向きにしていても戻ることを防ぐ
        //  $image->orientate();
         Image::make($file)->resize(300,300)->orientate()->save("storage/temp-images/{$tempPath}");
        //  Image::make($file)->resize(300,300)->rotate(0)->save("storage/temp-images/{$tempPath}");
        //  Image::make($file)->fit(300, 300)->rotate(0)->save("storage/temp-images/{$tempPath}");
 
         $filePath = Storage::disk('public')
             ->putFile('item-images', new File("storage/temp-images/{$tempPath}"));
 
         return basename($filePath);
     }
 


}

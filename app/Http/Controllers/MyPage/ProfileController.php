<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
  use App\Http\Requests\Mypage\Profile\EditRequest;
  use Illuminate\Http\File;
  use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Storage;
  use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
     public function showProfileEditForm()
     {

         return view('mypage.profile_edit_form')

             ->with('user', Auth::user());
     }

     public function editProfile(EditRequest $request)
     {

        $user = Auth::user();

        $user->name = $request->input('name');
        if ($request->has('avatar')) {
            $fileName = $this->saveAvatar($request->file('avatar'));
            $user->avatar_file_name = $fileName;
        }

        $user->save();

            return redirect()->back()
            ->with('status', 'プロフィールを変更しました。');
    }     /**
      * アバター画像をリサイズして保存します
      *
      * @param UploadedFile $file アップロードされたアバター画像
      * @return string ファイル名
      */
    private function saveAvatar(UploadedFile $file): string
    {
        //   $tempPath = $this->makeTempPath();
        $ff=$file->getClientOriginalName();
        // dd($ff);
        $tempPath = $ff;
        //   dd($file);
        Image::make($file)->resize(200,200)->orientate()->save("storage/temp-images/{$tempPath}");
        //   Image::make($file)->fit(200, 200)->save($tempPath);
        $filePath = Storage::disk('public')
            ->putFile('avatars', new File("storage/temp-images/{$tempPath}"));

    return basename($filePath);
    }


}
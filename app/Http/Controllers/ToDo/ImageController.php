<?php

namespace App\Http\Controllers\ToDo;

use App\Http\Controllers\Controller;
use App\Models\Lists;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function destroy(Lists $list):RedirectResponse
    {
        Storage::delete($list->image);

        Storage::delete($list->preview_image);

        $list->image = null;
        $list->preview_image = null;
        $list->save();
        return back();
    }

    public function changePhoto(Request $request,Lists $list)
    {
        if ($request->user()->id == $list->user_id) {
        Storage::delete($list->image);
        Storage::delete($list->preview_image);
            $path = 'public/lists/' . $request->user()->id;


            $file = $request->file('image')->store($path);

            $thumbnail = Image::make(storage_path('app/' . $file))
                ->fit(150, 150)
                ->save(storage_path('app/' . $path . '/' . Str::random(10) . '_thumbnail.jpg'));

            $list->image = basename($file);

            $list->preview_image = $thumbnail->basename;

            $list->save();

            return back();
        }
    }
}

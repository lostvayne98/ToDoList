<?php

namespace App\Http\Controllers\ToDo;

use  App\Http\Controllers\Controller;
use App\Models\Lists;
use Illuminate\Http\RedirectResponse;

class FinishListController extends Controller
{
    public function index(Lists $list):RedirectResponse
    {
        if ($list->status == true) {
        $list->status = false;
        } else {
            $list->status = true;
        }
        $list->save();

        return back();
    }
}

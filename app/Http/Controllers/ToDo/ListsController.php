<?php

namespace App\Http\Controllers\ToDo;

use App\Filter\ListFilter\ListFilter;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ToDo\Actions\StoreInterface;
use App\Http\Requests\Lists\IndexRequest;
use App\Http\Requests\Lists\StoreRequest;
use App\Http\Requests\Lists\UpdateRequest;
use App\Models\Lists;
use App\Models\Tags;
use App\Services\CRUD\CrudInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ListsController extends Controller
{

    private $crud;

    public function __construct(CrudInterface $crud)
    {
        $this->crud = $crud;
    }

    public function index(Request $request):View
    {
        $data = $request->all();

        $filter = app()->make(ListFilter::class, ['queryParams' => array_filter($data)]);

        $lists = Lists::filter($filter)
            ->whereUserId(auth()->id())
            ->get();
        $tags = Tags::all();

        return view('welcome',compact('lists','tags'));
    }


    public function create():View
    {
        return view('lists.create');
    }


    public function store(StoreRequest $request, Lists $lists, StoreInterface $action):JsonResponse
    {
        $data = $request->validated();

        $list = $this->crud->create($lists, $data);

        $action->handle($list, $data);

        return response()->json(['ok'],200);
    }


    public function show(Lists $list):View
    {

       $list =  $this->crud->read($list,$list->id);

       return view('lists.update',compact('list'));
    }

    public function update(UpdateRequest $request, Lists $list):JsonResponse
    {
        $this->crud->update($list,$request->validated());

        return response()->json(['ok'],200);
    }


    public function destroy(Lists $list):RedirectResponse
    {
        Storage::delete($list->image);
        Storage::delete($list->preview_image);

        $this->crud->delete($list);

        return back();
    }


}

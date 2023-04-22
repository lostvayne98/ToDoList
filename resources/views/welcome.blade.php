@extends('layouts.app')
@section('content')
    <div>
        <form action="{{route('lists.index')}}" method="GET">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ request('name') }}"
                       placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="tags">Tags:</label>
                @foreach($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->name }}"
                               id="{{ $tag->name }}" {{ (collect(request('tags'))->contains($tag->name)) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $tag->name }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success mt-5">Search</button>
        </form>
    </div>
    <a href="{{route('lists.create')}}" class="btn-default">
        <button class="btn btn-success">Создать</button>
    </a>
    <div class="container">

        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-9 col-xl-7">
                        <div class="card rounded-3">
                            <div class="card-body p-4">

                                <h4 class="text-center my-3 pb-3">To Do App</h4>


                                <table class="table mb-4">
                                    <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">image</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($lists as $list)

                                        <div  id="list-modal-{{$list->id}}" class="modal"  tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Photo</h5>
                                                        <div onclick="takePhoto('{{$list->id}}')" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if(!empty($list->image))
                                                            <img
                                                                src="{{asset('/storage/lists/' . auth()->id() . '/' . $list->image)}}"
                                                                alt="">
                                                        @else
                                                            <img src="images/images.png"
                                                                 style="width: 150px;height: 150px" alt="">
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form enctype="multipart/form-data" action="{{route('edit.photo',$list->id)}}" method="POST">
                                                            @csrf
                                                            <input onchange="checkInput({{$list->id}})" id="editImage{{$list->id}}" type="file" name="image" class="btn btn-secondary"
                                                                   data-dismiss="modal">
                                                            <button style="display:none" id="send{{$list->id}}" class="btn btn-success" type="submit">Edit</button>
                                                        </form>

                                                        <form action="{{route('delete.photo',$list->id)}}" method="POST">
                                                            @csrf
                                                        <button type="submit" class="btn btn-secondary"
                                                                data-dismiss="modal">Delete
                                                        </button>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <tr>
                                            <th scope="row"><a
                                                    href="{{route('lists.show',$list->id)}}">{{$list->id}}</a></th>
                                            <td>{{$list->name}}</td>
                                            <td>@if($list->status)
                                                    Active
                                                @else
                                                    deactive
                                                @endif

                                            </td>
                                            @if(!empty($list->image))
                                                <td>
                                                    <button onclick="takePhoto('{{$list->id}}')">
                                                        <img
                                                            src="{{asset('/storage/lists/' . auth()->id() . '/' . $list->preview_image)}}"
                                                            alt="">
                                                    </button>
                                                </td>
                                            @else
                                                <td><a href="{{asset('/images/images.png')}}">
                                                        <img src="images/images.png" style="width: 150px;height: 150px"
                                                             alt="">
                                                    </a>
                                                </td>
                                            @endif
                                            <td>
                                                <form action="{{route('lists.destroy',$list->id)}}" method="POST">
                                                    @csrf

                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>

                                                <form action="{{route('list.finish',$list->id)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success ms-1 mt-5">Finished
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                    </tbody>
                                    @empty
                                        <p>Пока нет списка</p>
                                    @endforelse
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <style>
            .btn-default {
                display: flex;
                justify-content: flex-end;
            }
            .modal.active {
                display: block;
            }
        </style>
{{--route('edit.photo',$list->id)--}}
        <script>
            function takePhoto(listId) {
                document.querySelector(`#list-modal-${listId}`).classList.toggle('active')
            }
            function checkInput(x){
                document.querySelector(`#send${x}`).style.display = 'flex'
            }
        </script>
@endsection

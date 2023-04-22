@extends('layouts.app')
@section('content')

    <form id="my-form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="text" value="{{$list->name}}" >
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Image</label>
            <a href="{{'/storage/lists/' . auth()->id() . '/'. $list->image}}">
                <img src="{{asset('/storage/lists/' . auth()->id() . '/'. $list->image)}}" style="height: 500px;width: 500px" alt="">
            </a>
            <input type="file" name="image" id="file" >
        </div>

        <span  id="submit-btn" class="btn btn-success" onclick="update('{{route('lists.update',['list' => $list->id])}}')">Сохранить</span>
    </form>
    <script>
        function update(route) {

            console.log(route)
            let formData = new FormData();
            let name = document.querySelector('#name').value;
            let image = document.querySelector('#file').files[0];
            let tags = document.querySelectorAll('#tag input[type="text"]');

            if (name) {
                formData.append('name', name);
            }
            if (image) {
                formData.append('image', image);
            }
            if (tags.length > 0) {
                tags.forEach(tag => {
                    formData.append('tags[]', tag.value);
                });
            }
            console.log(formData.get('image'))
            let headers = {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

            };


            fetch(route, {
                method: 'POST',
                body: formData,
                headers: headers
            })
        }





    </script>
@endsection

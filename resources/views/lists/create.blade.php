@extends('layouts.app')
@section('content')

    <form id="my-form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="text">
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Image</label>
            <input type="file" name="image" id="file">
        </div>

        <div class="form-group" id="tag" >
            <div class="form-group">
            <label for="exampleFormControlTextarea1">Tags</label>
            <input type="text" name="tags[]" id="value">
            </div>
        </div>
        <i class="fa fa-plus" id="duplicate-btn" aria-hidden="true" onclick="addInps()">Добавить тег</i>
        <span  id="submit-btn" class="btn btn-success" onclick="create('{{route('lists.store')}}')">Сохранить</span>
    </form>
    <script>

        function addInps() {
            let cont = document.querySelector('#tag'),

                par = document.createElement('div'),
                label = document.createElement('label'),
                input = document.createElement('input');
                par.classList.add('form-group');

            label.setAttribute('for', 'exampleFormControlTextarea1');

            label.innerText = 'Tags';

            input.setAttribute('name', 'tags[]');

            input.setAttribute('type', 'text');

            par.appendChild(label);
            par.appendChild(input);
            cont.appendChild(par);
        }

        function create(route) {
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


            let headers = {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };
            fetch(route, {
                method: 'POST',
                body: formData,
                headers: headers
            }).then(response => {
                alert('Успешно')
            }).catch(error => {
                alert('Не успешно(')
            });
        }



    </script>
@endsection

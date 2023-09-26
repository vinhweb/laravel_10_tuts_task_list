@extends('layout.app')

@section('title', isset($task) ? 'Sửa ' . $task->title : 'Tạo Task')

@section('content')
    <form action="{{isset($task) ? route('tasks.update', ['task' => $task]) : route('tasks.store')}}" method="post">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="mb-4">
            <label for="title">Tiêu đề</label>
            <input
                    @class(['border-red-500' => $errors->has('title')])
                    type="text" name="title" id="title" value="{{$task->title ?? old('title')}}">
            @error('title')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description">Mô tả</label>
            <textarea
                    @class(['border-red-500' => $errors->has('description')])
                    name="description" id="description" rows="5">{{$task->description ?? old('description')}}</textarea>
            @error('description')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="long_description">Mô tả dài</label>
            <textarea
                    @class(['border-red-500' => $errors->has('long_description')])
                    name="long_description" id="long_description" rows="10">{{$task->long_description ?? old('long_description')}}</textarea>
            @error('long_description')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn">
                @isset($task)
                    Sửa
                @else
                    Tạo
                @endisset
            </button>
        </div>
    </form>
@endsection
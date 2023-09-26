@extends('layout.app')

@section('title', $task->title)
@section('content')
    <div class="mb-4">
        <a href="{{route('tasks')}}"><< Quay lại danh sách!</a>
    </div>

    <p class="mb-2 text-slate-700">{{$task->description}}</p>
    @isset($task->long_description)
        <p class="mb-2 text-slate-700">{{$task->long_description}}</p>
    @endisset

    <p class="mb-2 text-slate-700">
        @if($task->completed)
            <span class="font-medium text-green-500">Hoàn thành</span>
        @else
            <span class="font-medium text-red-500">Chưa hoàn thành</span>
        @endif
    </p>
    <p class="mb-2 text-slate-700">{{$task->created_at}}</p>
    <p class="mb-2 text-slate-700">{{$task->updated_at}}</p>

    <div class="mt-4 flex gap-2 items-center">
        <div>
            <a class="btn" href="{{route('tasks.edit', ['task' => $task])}}">Sửa</a>
        </div>

        <form method="post" action="{{route('tasks.toggle-complete', ['task' => $task])}}">
            @csrf
            @method('PUT')
            <button class="btn" type="submit">Đánh dấu {{$task->completed ? 'Chưa hoàn thành' : 'Hoàn thành'}}</button>
        </form>

        <form method="post" action="{{route('tasks.destroy', ['task' => $task])}}">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">Xóa</button>
        </form>
    </div>
@endsection

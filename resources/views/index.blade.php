@extends('layout.app')

@section('title', 'Task List')

@section('content')
    <div class="mb-4">
        <a class="link" href="{{route('tasks.create')}}">Thêm task</a>
    </div>

    @if(isset($tasks) && count($tasks) > 0)
        @foreach($tasks as $task)
            <p>
                <a href="{{route('tasks.single', ['task' => $task->id])}}"
                    @class(['line-through' => $task->completed])
                >
                    {{$task->title}}
                </a>
            </p>
        @endforeach
    @else
        <p>Không có task nào!</p>
    @endif

    @if($tasks->count())
        <nav class="mt-4">{{ $tasks->links() }}</nav>
    @endif
@endsection
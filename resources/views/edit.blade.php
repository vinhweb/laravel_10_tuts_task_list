@extends('layout.app')

@section('content')
    @include('form', ['task' => $task])
@endsection
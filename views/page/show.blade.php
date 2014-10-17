@extends('layouts.main')

@section('content')
    <h1>{{{ $page->title }}}</h1>
    <div>
        {{ $page->text }}
    </div>
@stop
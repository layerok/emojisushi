@extends('site.app')
@section('title', $page->name)

@section('content')
    <div class="flex justify-center">
        <div class="mw7 ph3 w-100">
            @php htmlspecialchars_decode($page->content) @endphp
        </div>
    </div>
@stop

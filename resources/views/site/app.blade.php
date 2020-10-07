<!DOCTYPE HTML>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"  >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    @include('site.partials.styles')
</head>
<body class="bg-black white roboto  ">

<div id="app" >
    @include('site.partials.header')
    <products-list></products-list>

</div>
@yield('content')
@include('site.partials.footer')
@include('site.partials.scripts')


</body>
</html>

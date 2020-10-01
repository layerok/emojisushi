@extends('site.app')
@section('title', 'Homepage')

@section('content')

    <section  class="flex flex-column items-center pt3 ph2 ph0-l">
        <div class="w-100 mw7 flex flex-wrap">

            @forelse($products as $product)
                @include('site.product.thumb')
            @empty
                Товары не найдены
            @endforelse




        </div>
    </section>


@stop

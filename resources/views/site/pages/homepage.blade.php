@extends('site.app')
@section('title', 'Homepage')

@section('content')

    <section id="products"  class="flex flex-column items-center pt2 ph2 ph0-l">
        <div class="w-100 mw7 ">
            @include('site.partials.sortForm')
            <div class="flex flex-wrap">
                @forelse($products as $product)
                    @include('site.product.thumb')
                @empty
                    Товары не найдены
                @endforelse
            </div>





        </div>
    </section>


@stop

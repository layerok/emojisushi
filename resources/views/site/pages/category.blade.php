@extends('site.app')
@section('title', $category->name)
@section('content')
    <section class="flex flex-column items-center pt3">
        <div class="w-100 mw7 flex flex-wrap">
            @forelse($category->products as $product)
                <div class="pa3 w-100 w-50-ns w-33-l ">
                    <div class="br3 ba b--red pa3 ">
                        <div class="flex flex-column mt1 mb2 ">
                            <div class="nested-img">
                                @if ($product->images->count() > 0)
                                    <img src="{{ asset('storage/'.$product->images->first()->full) }}" alt="">
                                @else
                                    <img src="https://via.placeholder.com/300x200" alt="">
                                @endif
                            </div>
                            <h3 class="f3 fw5 mt3 mb0">{{ $product->name }}</h3>
                            <p class="f6 fw5 mv2">Креветка Тигровая в темпуре, японский майонез, Икра масага, огурец</p>
                            <p class="self-end f4 mt2 mb1">210 г</p>
                            <div class="flex justify-between">
                                <button class="dn w4 bg-dark-red tc white pa3 bn br-pill bg-animate hover-bg-red pointer">В корзину</button>
                                <div>
                                    <div class="flex bg-dark-red w4 white mb1 br-pill overflow-hidden ">
                                        <button class="w-third bn  pv3 ph2 bg-inherit white bg-animate hover-bg-red pointer">-</button>
                                        <div class="w-third tc pv3">233</div>
                                        <button class="w-third bn  pv3 ph2 bg-inherit white bg-animate hover-bg-red pointer">+</button>
                                    </div>
                                </div>
                                <div class=" fw5"><span class="f2">{{ $product->price }}</span> <span class="f4">{{ config('settings.currency_symbol') }}</span></div>
                            </div>



                        </div>
                    </div>
                </div>
            @empty
                <p class="ph3">Товары не найдеры в категории {{ $category->name }}.</p>
            @endforelse
        </div>
    </section>
@stop


<div id="nav" class="w-100 flex-column z-4 ">

    <nav class="w-auto bt bb b--orange bg-black mb2 flex ">
        <ul class="w-100 ma0 pv3 list flex justify-between items-center ph2 overflow-y-auto">
            @foreach($categories as $category)
                <li  class="mv1 flex-shrink-0"><!---->
                    <a href="/category/{{ $category->slug }}"  class="@isset($slug)@if($slug == $category->slug) bg-orange black @else white @endif @else white @endisset ph3-ns ph1 pv1 br-pill link mr2-ns mr1 hover-bg-orange hover-black  ">
                        <span class="ph1">{{ $category->name }}</span>
                    </a>
                </li>

            @endforeach
                <li  class="mv1 flex-shrink-0"><!---->
                    <a href="{{ route('pages.delivery') }}"  class="@if (\Route::current()->getName() == 'pages.delivery')  bg-orange black @else white @endif  ph3-ns ph1 pv1 br-pill link mr2-ns mr1 hover-bg-orange hover-black  ">
                        <span class="ph1">Доставка и оплата</span>
                    </a>
                </li>
        </ul>
        @php $is_second_popup = true; @endphp
        <div class="cart-in-menu dn ">
            @include('site.partials.cart')
        </div>

    </nav>
</div>
{{--<div v-else class="flex w-100 justify-center items-center">
    <div class="lds-facebook"><div></div><div></div><div></div></div>
</div>--}}






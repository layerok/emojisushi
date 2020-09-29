
<div id="nav" class="w-100 flex-column z-4 ">
    <nav class="w-auto bt bb b--dark-red bg-black mb2 flex ">
        <ul class="w-100 ma0 pv3 list flex justify-between items-center ph2 overflow-y-auto">
            @foreach($categories as $category)
                <li  class="mv1 flex-shrink-0"><!---->
                    <a href="/category/{{ $category->slug }}"  class="@isset($slug)@if($slug == $category->slug) bg-dark-red @endif @endisset ph3-ns ph1 pv1 br-pill link mr2-ns mr1 hover-bg-dark-red hover-white white ">
                        <span class="ph1">{{ $category->name }}</span>
                    </a>
                </li>

            @endforeach


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






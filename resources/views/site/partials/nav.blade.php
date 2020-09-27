
<div class="w-100 flex-column">
{{--    <div class="bt b--dark-red flex justify-center ph3">--}}
{{--        <p class="mr2">Текущий ресторан: {{ $store.state.currentSpot.name }}</p>--}}
{{--        <router-link class="pv3" :to="{name: 'home'}">Изменить</router-link>--}}
{{--    </div>--}}
    <nav class="w-100 bt bb b--dark-red mb2 flex ">
        <ul class="w-100 ma0 pv3 list flex justify-between items-center ph2 overflow-y-auto">
            @foreach($categories as $category)
                <li  class="mv1 flex-shrink-0"><!---->
                    <a href="/category/{{ $category->slug }}"  class="@isset($slug)@if($slug == $category->slug) bg-dark-red @endif @endisset ph3-ns ph1 pv1 br-pill link mr2-ns mr1 hover-bg-dark-red hover-white white ">
                        <span class="ph1">{{ $category->name }}</span>
                    </a>
                </li>

            @endforeach


        </ul>
{{--        @include('site.partials.cart')--}}
    </nav>
</div>
{{--<div v-else class="flex w-100 justify-center items-center">
    <div class="lds-facebook"><div></div><div></div><div></div></div>
</div>--}}






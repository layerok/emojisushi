<header class=" flex flex-column items-center pt3">
    <div class="w-100 mw7 ph3 relative">
        <section class="w-100 flex flex-wrap flex-nowrap-l justify-between">
            <!-- Телефоны -->
            <div class="order-0 w-50 flex flex-column">
                <div class="flex items-center mb2">
                    <div class="nested-img mr2"><img src="{{ asset('img/phone.png') }}" alt=""></div>
                    <div>3 8(067) 373 26 70</div>
                </div>
                <div class="flex items-center mb2">
                    <div class="nested-img mr2"><img src="{{ asset('img/phone.png') }}" alt=""></div>
                    <div>3 8(067) 373 26 70</div>
                </div>
                <div class="flex items-center mb2">
                    <div class="nested-img mr2"><img src="{{ asset('img/phone.png') }}" alt=""></div>
                    <div>3 8(067) 373 26 70</div>
                </div>

            </div>
            <!-- Лого -->
            <a class="w-100 order-1 order-0-l flex justify-center" href="{{ url('/') }}" class="nested-img">
                <img src="{{ asset('img/logosumoist.png') }}" alt="">
            </a>
            <sumoist-cart></sumoist-cart>
            <sumoist-cart-pop-up></sumoist-cart-pop-up>

        </section>
        {{--@include('site.partials.nav')--}}
    </div>

</header>



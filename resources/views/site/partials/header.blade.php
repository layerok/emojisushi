<header class=" flex flex-column items-center  ">
    <div class="w-100 mw7 ph3  relative pt3">
        <section class="w-100 flex flex-wrap flex-nowrap-l justify-between mb2">
            <!-- Телефоны -->
            <div  class="order-0 w-50 flex flex-column justify-center">
                <div class="flex items-center mb2">
                    <div class="nested-img mr2 "><img src="/img/phone.png" alt=""></div>
                    <a href="tel:+380673732670" target="_blank" class="link white hover-dark-red f6 f5-ns">+380 67‒373‒26‒70</a>

                </div>
                <div class="flex items-center mb2">
                    <div class="nested-img mr2 "><img src="/img/phone.png" alt=""></div>
                    <a href="tel:+380991776303" target="_blank" class="link white hover-dark-red f6 f5-ns">+380 99‒177‒63‒03</a>
                </div>
                <div class="flex items-center mb2">
                    <div class="nested-img mr2 "><img src="/img/instagram.png" alt=""></div>
                    <a href="https://www.instagram.com/sumoist_od/" target="_blank" class="f6 f5-ns white hover-dark-red link">@sumoist_od</a>
                </div>
            </div>

            <!-- Лого -->
            <div class="w-100 order-1 order-0-l flex justify-center">
                <div class="flex flex-column items-center">
                    <a href="/">
                        <img src="/img/logosumoist.png" alt="">
                    </a>
                    <p><span class="dark-red">Время работы:</span> 11:00-22:00</p>
                </div>

            </div>
            @include('site.partials.cart')

        </section>
        <div ></div>
        <div  class="left-0 right-0 top-0 flex justify-center z-4">
            <div class="mw7 w-100 ">
                <div class="bg-black flex ">
                    @include('site.partials.nav')
                </div>

            </div>

        </div>
        @include('site.partials.slider')
    </div>

</header>



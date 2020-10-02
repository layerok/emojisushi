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
            <div class="w-100 order-1 order-0-l flex justify-center relative">
                <div class="flex flex-column items-center">
                    <a href="/">
                        <img src="/img/logosumoist.png" alt="">
                    </a>
                    <p><span class="dark-red">Время работы:</span> 11:00-22:00</p>
                    <form class="relative mb2" method="get" action="/" autocomplete="off">
                        @csrf
                        <input name="word" type="text" class="outline-0 br-pill ba b--dark-red b--top b--left b--right b--bottom bg-transparent white pa3 placeholder-white" placeholder="Поиск">
                        <button class="absolute bg-transparent bn pointer " style="top:15px; right:11px" type="submit">
                            <svg width="20" height="20" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.97073 0C10.8144 0 13.9415 3.12707 13.9415 6.97073C13.9415 8.65403 13.3417 10.1998 12.3447 11.4058L17 16.0611L16.0611 17L11.4058 12.3447C10.1998 13.3417 8.65403 13.9415 6.97073 13.9415C3.12707 13.9415 0 10.8144 0 6.97073C0 3.12707 3.12704 0 6.97073 0ZM6.97073 12.6137C10.0823 12.6137 12.6137 10.0823 12.6137 6.97073C12.6137 3.8592 10.0823 1.32776 6.97073 1.32776C3.8592 1.32776 1.32776 3.8592 1.32776 6.97073C1.32776 10.0823 3.8592 12.6137 6.97073 12.6137Z" fill="white"></path>
                            </svg>
                        </button>
                    </form>
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
        @if(Request::is('/'))
            @include('site.partials.slider')
        @endif



    </div>

</header>


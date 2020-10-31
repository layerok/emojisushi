<header class=" flex flex-column items-center  ">
    <div class="w-100 mw7 ph3  relative pt3">
        <section class="w-100 flex flex-wrap flex-nowrap-l justify-between mb2">
            <!-- Телефоны -->
            <div  class="order-0 w-50 flex flex-column justify-center">
                @empty(!config('settings.phone'))
                    @foreach(explode(';', config('settings.phone')) as $phone)
                        <div class="flex items-center mb2">
                            <div class="nested-img mr2"><img src="{{ Asset::load('img/phone.svg') }}" alt=""></div>
                            <a href="tel:{{ preg_replace('/\D/','', $phone) }}" target="_blank" class="link white hover-dark-red f6 f5-ns">{{ $phone }}</a>
                        </div>
                    @endforeach
                @endempty
                @empty(!config('settings.social_instagram'))
                    <div class="flex items-center mb2">
                        <div class="nested-img mr2 "><img src="{{ Asset::load('img/instagram.svg') }}" alt=""></div>
                        <a href="https://www.instagram.com/{{config('settings.social_instagram')}}/" target="_blank" class="f6 f5-ns white hover-dark-red link">{{ config('settings.social_instagram') }}</a>
                    </div>
                @endempty
            </div>

            <!-- Лого -->
            <div class="w-100 order-1 order-0-l flex justify-center relative">
                <div class="flex flex-column items-center">
                    <a  href="/">
                        <img class="w6" src="{{ Asset::load('img/logosumoist.jpg') }}" alt="">
                    </a>
                    <p><span class="dark-red">Время работы:</span> {{ config('settings.start_working') }}-{{ config('settings.finish_working') }}</p>
                    <form class="relative mb2" method="get" action="/#products" autocomplete="off">
                        @csrf
                        <input name="word" type="text" class="outline-0 br-pill ba b--dark-red b--top b--left b--right b--bottom bg-transparent white pa3 placeholder-white" placeholder="Поиск" @isset($_GET['word']) value="{{ $_GET['word'] }}" @endisset>
                        <button class="absolute bg-transparent bn pointer " style="top:15px; right:11px" type="submit">
                            <svg width="20" height="20" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.97073 0C10.8144 0 13.9415 3.12707 13.9415 6.97073C13.9415 8.65403 13.3417 10.1998 12.3447 11.4058L17 16.0611L16.0611 17L11.4058 12.3447C10.1998 13.3417 8.65403 13.9415 6.97073 13.9415C3.12707 13.9415 0 10.8144 0 6.97073C0 3.12707 3.12704 0 6.97073 0ZM6.97073 12.6137C10.0823 12.6137 12.6137 10.0823 12.6137 6.97073C12.6137 3.8592 10.0823 1.32776 6.97073 1.32776C3.8592 1.32776 1.32776 3.8592 1.32776 6.97073C1.32776 10.0823 3.8592 12.6137 6.97073 12.6137Z" fill="white"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @include('theme::site.partials.cart')

        </section>
        <div ></div>
        <div  class="left-0 right-0 top-0 flex justify-center z-4">
            <div class="mw7 w-100 ">
                <div class="bg-black flex ">
                    @include('theme::site.partials.nav')
                </div>
            </div>

        </div>
        @if(Request::is('/'))
            @include('theme::site.partials.slider')
        @endif



    </div>

</header>


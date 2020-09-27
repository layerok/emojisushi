<!-- Корзина -->
<div class="w-50  mh3 pv2 order-0 flex items-center justify-end relative "  ><!-- w-50-->
    <div class="flex">
        <div class="nested-img pointer" >
            <img src="/img/cart.png" alt="Корзина">
        </div>
        <div class="flex flex-column justify-between ml3-ns pl2">
            <div class="f4">999 грн.</div>
            <div>3 товаров</div>
        </div>
{{--        <div class="absolute" style="right:-1px;top:-1px">--}}
{{--            <div class="f7 red bg-white br-100 flex justify-center items-center" style="width:24px;height:24px; ">--}}
{{--                2--}}
{{--            </div>--}}

{{--        </div>--}}
    </div>
    <div class="absolute right-0 top-3 z-4">
        @include('site.partials.cartPopUp')
    </div>


</div>

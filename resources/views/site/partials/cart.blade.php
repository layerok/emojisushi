<!-- Корзина -->
<div  class="  mh3 pv2 order-0 flex items-center justify-end relative @isset($is_second_popup)  @else w-50 @endisset "  ><!---->
    <div class="flex flex-shrink-0"  @isset($is_second_popup) data-layerok="#show-sign-modal_2" @else data-layerok="#show-sign-modal" @endisset>
        <div class="nested-img pointer " >
            <img src="/img/cart.png" alt="Корзина">
        </div>
        <div class="flex flex-column justify-between ml3-ns pl2">
            <div data-cart-total class="f4">{{ Cart::getTotal() }} грн.</div>
            <div data-cart-total-quantity>{{ Cart::getTotalQuantity() }} тов.</div>
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

<!-- Попап -->
<div @isset($is_second_popup)id="show-sign-modal_2" @else id="show-sign-modal" @endisset data-layerok-modal class="dn overflow-hidden " >
    <div class="w6 " >
        <div class="flex justify-between bg-dark-red ba br--top br2 b--dark-red ">
            <p class="f4 white mv2 pv1 mh3">Корзина</p>
            <p data-layerok-dismiss  class="mv0 white mv2 pv1 mh3 pointer">&times;</p>
        </div>
        <!-- products container -->
        <div >
            <div data-cart-popup-items  class="@if(Cart::isEmpty()) dn @endif overflow-y-scroll bg-white" style="max-height: 230px">
                <!-- Product -->

            </div>

            <div data-cart-popup-action class="@if(Cart::isEmpty()) dn @endif bg-white ba br--bottom br2 b--white ">
                <div class="">
                    <div class="mh3 mv2 pv1" >
                        <a href="/checkout"  class="link db w4 bg-dark-red tc white pa3 bn br-pill bg-animate hover-bg-red pointer">Оформить</a>
                    </div>
                </div>
            </div>
        </div>

        <div data-cart-popup-empty class="@if(!Cart::isEmpty()) dn @endif bg-white ba br--bottom br2 b--white ">
            <div class="ph3 pb2 pt2 mv2">
                <p class="dark-red mv0">Корзина пуста</p>
            </div>

        </div>
    </div>
</div>

<div   class="pa3-l pa2 w-50 w-50-ns w-33-l ">
    <div class="br3 ba b--red pa3-l pa2 h-100">
        <div class="flex flex-column pb1 pb2 h-100">
            <div class="nested-img flex flex-shrink-0 justify-center "  >
                <img class="self-center align-center-start" style=" width:auto; max-height:220px" src="" alt="">
                <!--<div class="h4 contain" :style="{backgroundImage: 'url(' + item.poster_image + ')'}"  ></div>-->
            </div>
            <form action="{{ route('cart.manipulate') }}" method="post" data-buy class="flex flex-column justify-between h-100">
                @csrf
                <div>
                    <h3  class="f3-l f5 fw5 mv3 mb0">{{ $product->name }}</h3>
                    <p  class="f6-l f7 fw5 mb2">

                        @foreach($product->attributes as $productAttribute)
                            @foreach($productAttribute->attributeValues as $attributeValue)
                                @if($attributeValue->attribute_id == 3)
                                    {{ $attributeValue->value }}
                                @endif

                                @if($attributeValue->attribute->frontend_type == 'radio')
                                    <input value="{{ $attributeValue->poster_id }}" checked name="modificator_id" type="radio"> {{ $attributeValue->value }}
                                @endif
                            @endforeach
                        @endforeach
                    </p>
                </div>

                <div class="flex flex-column">
                    <p  class="self-end f4-l f7 mt2 mb1">{{ number_format($product->weight, '0', ',', ' ') . ' ' . $product->unit }}</p>
                    <div data-product-controls="{{ $product->id }}" class="flex flex-column flex-row-l justify-between items-center-l">
                        <input type="hidden" name="id" value="{{ $product->id }}">

                        <button data-control-add type="submit" name="action" value="add" class="@if(Cart::get($product->id)) dn @endif order-2 order-1-l w4 bg-dark-red tc white pa3 bn br-pill bg-animate hover-bg-red pointer">
                            В корзину
                        </button>

                        <div data-control-update class="order-2 order-1-l @if(!Cart::get($product->id)) dn @endif" >
                            <div class="flex bg-dark-red w4 white br-pill overflow-hidden ">
                                <button name="action" value="decrease" type="submit" class="w-third bn  pv3 ph2 bg-inherit white bg-animate hover-bg-red pointer">-</button>
                                <div data-control-quantity class="w-third tc pv3">
                                    @if(Cart::get($product->id))
                                        {{ Cart::get($product->id)['quantity'] }}
                                    @endif
                                </div>
                                <button name="action" value="increase" type="submit" class="w-third bn  pv3 ph2 bg-inherit white bg-animate hover-bg-red pointer">+</button>
                            </div>
                        </div>

                        <div class="order-1 order-2-l fw5 tc tl-ns"><span class="f2">{{ number_format($product->price, '0', ',', ' ') }}</span> <span class="f4"> грн.</span></div>
                    </div>
                </div>
            </form>




        </div>
    </div>
</div>

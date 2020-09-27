<div   class="pa3-l pa2 w-50 w-50-ns w-33-l ">
    <div class="br3 ba b--red pa3-l pa2 h-100">
        <div class="flex flex-column pb1 pb2 h-100">
            <div class="nested-img flex flex-shrink-0 justify-center "  >
                <img class="self-center align-center-start" style=" width:auto; max-height:220px" src="" alt="">
                <!--<div class="h4 contain" :style="{backgroundImage: 'url(' + item.poster_image + ')'}"  ></div>-->
            </div>
            <form class="flex flex-column justify-between h-100">
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
                    <div class="flex flex-column flex-row-l justify-between items-center-l">
                        <input type="hidden" name="poster_id" value="{{ $product->poster_id }}">
                        <button type="submit" class="order-2 order-1-l w4 bg-dark-red tc white pa3 bn br-pill bg-animate hover-bg-red pointer">
                            В корзину
                        </button>

                        {{--<div class="order-2 order-1-l" >
                            <div class="flex bg-dark-red w4 white br-pill overflow-hidden ">
                                <button  class="w-third bn  pv3 ph2 bg-inherit white bg-animate hover-bg-red pointer">-</button>
                                <div class="w-third tc pv3">2</div>
                                <button  class="w-third bn  pv3 ph2 bg-inherit white bg-animate hover-bg-red pointer">+</button>
                            </div>
                        </div>--}}
                        <div class="order-1 order-2-l fw5 tc tl-ns"><span class="f2">{{ number_format($product->price, '0', ',', ' ') }}</span> <span class="f4"> грн.</span></div>
                    </div>
                </div>
            </form>




        </div>
    </div>
</div>

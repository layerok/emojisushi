<div   class="pa3-l pa2 w-50 w-50-ns w-33-l ">
    <div class="br3 ba b--orange pa3-l pa2 h-100">
        <div class="flex flex-column pb1 pb2 h-100 relative">
            <div class="nested-img flex flex-shrink-0 justify-center "  >
                @if( count($product->images) > 0)
                    @php  $path = '/storage/'. $product->images()->first()->value('full'); @endphp
                @else
                    @php
                        if(isset($product->image)){
                            $path = $product->image;
                        }else{
                            $path ='/storage/' . 'img/default.jpg';
                        }

                    @endphp
                @endif
                    <img class="self-center align-center-start" style=" width:auto; max-height:220px" src="{{ $path }}" alt="">
                <!--<div class="h4 contain" :style="{backgroundImage: 'url(' + item.poster_image + ')'}"  ></div>-->
            </div>
            <form action="{{ route('cart.manipulate') }}" method="post" data-buy class="flex flex-column justify-between h-100">
                @csrf
                <div>
                    <h3  class="f3-l f5 fw5 mv3 mb0">{{ $product->name }}</h3>
                    <div class="f6-l f7 fw5 mb2">
                        <p class="flex flex-column flex-row-l mb3 bg-white-10 br2 modificator bg-black">
                            @php
                                $modificators = [];
                                $ingredients = [];
                                $sharpness = [];
                                $i = -1;
                            @endphp
                            @foreach($product->attributes as $productAttribute)

                                @foreach($productAttribute->attributeValues as $key => $attributeValue)

                                    @if($attributeValue->attribute_id == 3)

                                        @php $ingredients[] = $attributeValue->value @endphp
                                    @endif
                                    @if($attributeValue->attribute_id == 6)

                                        @php $sharpness[] = $attributeValue @endphp
                                    @endif

                                    @if($attributeValue->attribute->frontend_type == 'radio')
                                        @php
                                            $i++;
                                            $modificators[] = [
                                                        'id' => $attributeValue->poster_id,
                                                        'price'          => $productAttribute->price,
                                                        'value'          => $attributeValue->value
                                                    ]
                                        @endphp


                                            <input data-modificator id="modificator_{{ $attributeValue->poster_id }}" class="checked-bg-orange checked-white dn" type="radio" name="active_modificator" value="{{ $i }}"  checked >
                                            <label class=" ma2 w-100-l bg-white orange pa2 tc br-pill shadow-1 pointer flex items-center justify-center" for="modificator_{{ $attributeValue->poster_id }}">{{ $attributeValue->value }}</label>

                                    @endif
                                @endforeach

                            @endforeach
                            {{ implode(', ', $ingredients) }}
                            <input type="hidden" name="ingredients" value="{{ implode(', ', $ingredients) }}">
                        </p>
                    </div>
                </div>

                @foreach($sharpness as $sharp)
                    @if($sharp->id == 1172)
                        <div class="bg-black pa1 w2 nested-img absolute top-1 right-1 br-100">
                            <img src="{{ '/storage/img/chili.svg' }}" alt="">
                        </div>

                    @endif

                    @if($sharp->id == 1173)
                        <div class="bg-black pa1 w2 nested-img absolute top-1 right-1 br-100">
                            <img src="{{ '/storage/img/herb.svg' }}" alt="">
                        </div>

                    @endif
                @endforeach

                <div class="flex flex-column">
                    <p  class="self-end f4-l f7 mt2 mb1">{{ number_format($product->weight, '0', ',', ' ') . ' ' . $product->unit }}</p>
                    @if(count($modificators) > 0 )
                        @foreach($modificators as $key => $modificator)
                            <div data-product-controls="{{ $modificator['id'] }}" class=" @if(count($modificators) != $key + 1 ) dn  @else flex @endif flex-column flex-row-ns justify-between items-center">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="uid[]" value="{{ $modificator['id'] }}">
                                <input type="hidden" name="modificator_value[]" value="{{ $modificator['value'] }}">
                                <input type="hidden" name="modificator_price[]" value="{{ $modificator['price'] }}">

                                <button data-control-add type="submit" name="action" value="add" class="@if(Cart::get($modificator['id'] )) dn @endif order-2 order-1-ns w4 bg-orange tc white pa3 bn br-pill bg-animate hover-bg-gold pointer">
                                    В корзину
                                </button>

                                <div data-control-update class="order-2 order-1-l @if(!Cart::get($modificator['id'])) dn @endif" >
                                    <div class="flex bg-orange w4 white br-pill overflow-hidden ">
                                        <button name="action" value="decrease" type="submit" class="w-third bn  pv3 ph2 bg-inherit white bg-animate hover-bg-gold pointer">-</button>
                                        <div data-control-quantity class="w-third tc pv3">
                                            @if(Cart::get($modificator['id']))
                                                {{ Cart::get($modificator['id'])['quantity'] }}
                                            @endif
                                        </div>
                                        <button name="action" value="increase" type="submit" class="w-third bn  pv3 ph2 bg-inherit white bg-animate hover-bg-gold pointer">+</button>
                                    </div>
                                </div>

                                <div class="order-1 order-2-ns fw5 tc tl-ns"><span class="f2">{{ number_format($modificator['price'], '0', ',', ' ') }}</span> <span class="f4"> грн.</span></div>
                            </div>
                        @endforeach
                    @else
                        <div data-product-controls="{{ $product->id }}" class="flex flex-column flex-row-ns justify-between items-center">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="uid" value="{{ $product->id }}">

                            <button data-control-add type="submit" name="action" value="add" class="@if(Cart::get($product->id)) dn @endif order-2 order-1-ns w4 bg-orange tc white pa3 bn br-pill bg-animate hover-bg-gold pointer">
                                В корзину
                            </button>

                            <div data-control-update class="order-2 order-1-l @if(!Cart::get($product->id)) dn @endif" >
                                <div class="flex bg-orange w4 white br-pill overflow-hidden ">
                                    <button name="action" value="decrease" type="submit" class="w-third bn  pv3 ph2 bg-inherit white bg-animate hover-bg-gold pointer">-</button>
                                    <div data-control-quantity class="w-third tc pv3">
                                        @if(Cart::get($product->id))
                                            {{ Cart::get($product->id)['quantity'] }}
                                        @endif
                                    </div>
                                    <button name="action" value="increase" type="submit" class="w-third bn  pv3 ph2 bg-inherit white bg-animate hover-bg-gold pointer">+</button>
                                </div>
                            </div>

                            <div class="order-1 order-2-ns fw5 tc tl-ns"><span class="f2">{{ number_format($product->price, '0', ',', ' ') }}</span> <span class="f4"> грн.</span></div>
                        </div>
                    @endif

                </div>
            </form>




        </div>
    </div>
</div>

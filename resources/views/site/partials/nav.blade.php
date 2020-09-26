<nav class="w-100 bt bb b--red mv2">
    <ul class="ma0 pv3 list flex justify-between items-center ph2 overflow-y-auto">
        @foreach($categories as $cat)
            @foreach($cat->items as $value)
                @if ($value->items->count() > 0)
                    <!-- вложенные пункты -->
                @else
                    <li class="mv1 flex-shrink-0">
                        <a class="ph3 pv1 br-pill link @isset($category) @if($value->slug == $category->slug) bg-red @endif @endisset hover-bg-red hover-white white " href="{{ route('category.show', $value->slug) }}">
                            <span class="ph1">{{ $value->name }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        @endforeach
    </ul>
</nav>
<!-- Slider main container -->
<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide"><img src="/img/slide1.jpg" alt="Собери свой WOK"></div>
        <div class="swiper-slide"><img src="/img/slide2.jpg" alt="Бесплатная доставка"></div>
        <div class="swiper-slide"><img src="/img/slide3.jpg" alt="Sumoist Sushi & WOK"></div>
        <div class="swiper-slide"><img src="/img/slide4.jpg" alt="Бесплатная дегустация на торговой 15(7 небо) с 14:00 - 16:30"></div>
        <div class="swiper-slide"><img src="/img/slide5.jpg" alt="-20% на все кроме наборов с 13:00 - 16:00(пн-чт)"></div>

    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

</div>


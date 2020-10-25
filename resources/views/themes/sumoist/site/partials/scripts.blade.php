<script>
    const APP_THEME = "{{ \App\Models\Setting::where('key', '=', 'theme')->value('value') }}"
</script>

<script src="{{ Asset::load('frontend/js/jquery.min.js') }}" type="text/javascript"></script>

<script src="{{ Asset::load('frontend/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ Asset::load('frontend/js/jquery.form.min.js') }}" type="text/javascript"></script>
<script src="{{ Asset::load('frontend/js/jquery.tmpl.min.js') }}" type="text/javascript"></script>
<script src="{{ Asset::load('frontend/js/jquery.mask.min.js') }}" type="text/javascript"></script>

<script src="{{ Asset::load('frontend/js/notify.js') }}" type="text/javascript"></script>
<script src="{{ Asset::load('frontend/js/layerok.js') }}" type="text/javascript"></script>
<script src="{{ Asset::load('frontend/js/gsap/gsap.min.js') }}" type="text/javascript"></script>
<script src="{{ Asset::load('frontend/js/gsap/ScrollTrigger.min.js') }}" type="text/javascript"></script>
<script src="{{ Asset::load('frontend/js/animations.js') }}" type="text/javascript"></script>

{{--<script src="{{ asset('frontend/plugins/fancybox/fancybox.min.js') }}" type="text/javascript"></script>--}}
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ Asset::load('frontend/js/cart.js') }}" type="text/javascript"></script>
<script src="{{ Asset::load('frontend/js/script.js') }}" type="text/javascript"></script>





@stack('scripts')

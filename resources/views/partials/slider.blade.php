<section class="home-slider">
    <div id="hero-slider" class="hero-slider slider js-hero-slider">
    @foreach ($sliders as $key => $slider)
        <div class="slider-item" style="background-image: url('/storage/sliders/{{ $slider->picture}}'); ">
            <div class="container">
                <div class="slider-item-inner">
                    <h1 class="hero-slider__title">{{ $slider->title}}</h1>
                    <div class="hero-slider__text">{{ $slider->subtitle}}</div>
                    <div class="hero-slider__btn">
                        <a href="{{ $slider->link }}" class=" btn btn-primary btn-lg">shop now</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</section>

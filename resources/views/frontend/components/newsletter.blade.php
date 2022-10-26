<section class="section-subscribe">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title section-title-w-text text-center">
                    <h2 class="h3 section-title__heading">Newsletter subscription</h2>
                    <div class="section-title__text">Newest products, promotions and sales</div>
                </div>

                <form class="subscribe-form form-inline justify-content-center" action="{{ url('newsletter/subscribe') }}" method="post">
                {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="newsletter_email" class="form-control form-control-lg subscribe-form__input" placeholder="E-mail adress">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg subscribe-form__btn">subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>
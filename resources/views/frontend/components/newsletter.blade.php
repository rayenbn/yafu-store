<section class="section-subscribe">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title section-title-w-text text-center">
                    <h2 class="h3 section-title__heading">Newsletter subscription</h2>
                    <div class="section-title__text">Newest products, promotions and sales</div>
                </div>

                @if(count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $error)
                    <li style="color: #ff4a56;">-> {{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                @if($message = Session::get('success'))
                <p style="font-size: 14px;color: #067720;">{{ $message }}</p>
                @endif

                <form class="subscribe-form form-inline justify-content-center" action="{{ url('newsletter/subscribe') }}" method="post">
                {{ csrf_field() }}
                    <div class="form-group">
                        <input type="email" name="newsletter_email" class="form-control form-control-lg subscribe-form__input" placeholder="E-mail adress" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg subscribe-form__btn">subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>
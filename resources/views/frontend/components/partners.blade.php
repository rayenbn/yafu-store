<?php

use App\Http\Controllers\Controller;
$partners = Controller::partners();
?>
<div class="section section-logos section-pad-md bdr-top bg-light">
    <div class="container">
        <div class="content row">

            <div class="owl-carousel loop logo-carousel">
            @foreach ($partners as $partner)
                <div class="logo-item"><img alt="" width="190" height="82" src="/storage/images/partners/{{ $partner->partner_logo }}"></div>
            @endforeach
            </div>

        </div>
    </div>
</div>
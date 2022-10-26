@extends('layouts.theme')
@push('head.styles')
 
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('theme/assets/css/intlTelInput.css')}}">
@endpush
@section('content')
<div class="page-content">	
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="page-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My profile</li>
            </ol>
        </div>
    </nav>				
    <div class="product-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-view">
                        <div class="product-detail">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="product-view">
                                           
                                            <ul class="nav nav-tabs nav-justified nav-tabs-responsive style-2 mb-30" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Orders</a>
                                                </li>
                                            <!-- <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                                            </li> -->
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <div class="bd-example">
                                                        <form action="{{ route('my-profile.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" id="name" name="name" value="{{ old('name', isset($user) ? $user->name : '') }}" placeholder="Your Name">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="company_name">Company Name</label>
                                                                    <input type="text" class="form-control {{ $errors->has('company_name') ? 'has-error' : '' }}" id="company_name" name="company_name" value="{{ old('company_name', isset($user) ? $user->company_name : '') }}" placeholder="Your Company Name">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="position">Position in company</label>
                                                                    <input type="text" class="form-control {{ $errors->has('position') ? 'has-error' : '' }}" id="position" name="position" value="{{ old('position', isset($user) ? $user->position : '') }}" placeholder="Your position in company">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="country">Country</label>
                                                                    <input type="text" class="form-control {{ $errors->has('country') ? 'has-error' : '' }}" id="country" name="country" value="{{ old('country', isset($user) ? $user->country : '') }}" placeholder="Country">
                                                                    <input type="hidden" name="countryCode" id="countryCode" value="">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="phone">Phone</label>
                                                                    <div class="row">
                                                                        <div class="col-md-3" style="padding-right: 0;">
                                                                            <input type="text" name="phoneCode" id="phoneCode" required class="form-control" style="width: 100%;" value="" disabled>
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control {{ $errors->has('phone') ? 'has-error' : '' }}" id="phone" name="phone" value="{{ old('phone', isset($user) ? $user->phone : '') }}" placeholder="Your Phone Number">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="address">Address</label>
                                                                    <input type="text" class="form-control {{ $errors->has('phone') ? 'has-error' : '' }}" id="address" name="address" value="{{ old('address', isset($user) ? $user->address : '') }}" aria-describedby="countryHelp" placeholder="Full address">
                                                                    <small id="countryHelp" class="form-text text-muted">This will be also your shipping address.</small>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="address">Email address</label>
                                                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="addressHelp" value="{{ old('email', isset($user) ? $user->email : '') }}" placeholder="Enter email">
                                                                    <!-- <small id="addressHelp" class="form-text text-muted">This will be also your shipping address.</small> -->
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="password">Change Password</label>
                                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                                                </div>
                                                            </div>
                                                    
                                                            <button type="submit" class="btn btn-primary active mr-3 mb-3">Save</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="min-height: 300px;">
                                                    @if( $orders->count() > 0)
                                                    @foreach($orders as $order)
                                                    <div class="box-collateral row">
                                                        <div class="col-md-8">
                                                            <p>Invoice Nb: {{ $order->invoice_number}}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="#" class="btn btn-default ">View</a>
                                                            <a href="#" class="btn btn-info">Invoice</a>
                                                        </div>
                                                        </span>
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    <p>No submitted orders ...</p>
                                                    @endif
                                                </div>
                                                <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">.3333..</div>
                                                </div> -->

                                            </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
@parent
<!--for phone country code-->
<script>
$(document).ready(function() {

        function flagButtonValue(){
            var countryData = $("#country").intlTelInput("getSelectedCountryData"); //     get country code
            telNumber = "+" + countryData.dialCode;		//Whole phone number (with Country code and value of input)
            console.log(countryData.iso2);
            $("#phoneCode").val(telNumber);
            $("#country").val(countryData.name);
            $("#countryCode").val(countryData.iso2);
        }
        
        var defaultcountry = '{{$user->countryCode ?? "us"}}';
       
        $("#country").intlTelInput({
            initialCountry: defaultcountry,				//Function to put as default country the country where the IP is located
            // geoIpLookup: function(callback) {
            //     $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
            //         var countryCode = (resp && resp.country) ? resp.country : defaultcountry;
            //         callback(countryCode);
            //     });
            // },
        });
        setTimeout(
            function () {
                flagButtonValue();
            },
            5000
        );
});

</script>
@endsection

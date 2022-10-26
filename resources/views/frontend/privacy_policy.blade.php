@extends('layouts.theme')
@section('content')

<div class="page-content">	
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="page-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
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
                                                <h3 class="section-title text-center">{{ $privacy->title ?? ''}}</h3>
                                                <br>
                                                <br>
                                                {!! $privacy->content ?? '' !!}
                                        
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
@extends('layouts.theme')
@section('content')
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="page-breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog</li>
        </ol>
    </div>
</nav>


<!-- Page content -->
<div class="page-content">
    <div class="container">
        <div class="row justify-content-between">
            <main id="main" class="main-content col-lg-8">
                <div class="post-list">
                @foreach($blogs as $key => $blog)
                    <article class="post-item">
                        @if ($blog->image)
                        <a href="{{ $blog->path() }}" class="post-thumb">
                            <img src="../storage/blogs/thumbnail/{{ $blog->image }}" alt="$blog->image">
                        </a>
                        @endif
                        <div class="post-item__content">
                            <h3 class="post-title">
                                <a href="{{ $blog->path() }}">{{ $blog->title ?? ''}}</a>
                            </h3>
                            <div class="post-date">{{ $blog->created_at->diffForHumans() }}</div>
                            <div class="post-excerpt">
                            {!! Str::limit($blog->text, 200) ?? '' !!}
                            </div>
                            <a href="{{ $blog->path() }}" class="read-more btn btn-outline-primary btn-lg">Read more</a>
                        </div>
                    </article>
                @endforeach 
                   
                </div>

                {{ $blogs->links('vendor.pagination.theme_paginator') }}
                
            </main>

            <aside class="sidebar col-lg-3">
                
               
                <div class="sidebar-widget">
                    <h4 class="widget-title">Newsletter</h4>
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
                    <form action="{{ url('newsletter/subscribe') }}" method="post">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <input type="email" name="newsletter_email" placeholder="E-mail adress" required>
                            <button type="submit" class="btn btn-primary btn-sm">subscribe</button>
                        </div>
                    </form>

                </div>
                @if($categories->count() > 0)
                <div class="sidebar-widget">
                    <h4 class="widget-title">Categories</h4>
                    <ul>
                        @foreach($categories as $category)
                        <li><a href="{{ $category->path() }}">{{ $category->category_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if($popular_blogs->count() > 0)
                <div class="sidebar-widget">
                    <h4 class="widget-title">Archives</h4>
                    <ul>
                        @foreach ($popular_blogs as $pblog)	
                        <li><a href="{{ $pblog->path() }}">{{ $pblog->title ?? ''}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </aside> <!-- /.sidebar -->
        </div>
    </div>
</div> <!-- /.page-wrap -->

@endsection
@extends('layouts.theme')
@section('content')

<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="page-breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="blog.html">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
        </ol>
    </div>
</nav>

 <!-- Page content -->
 <div class="page-content">
    <div class="container">
        <div class="row justify-content-between">
            <main id="main" class="main-content col-lg-8">
                <article class="post-content">
                    <div class="post-thumb">
                        <img src="../storage/blogs/thumbnail/{{ $blog->image ?? ''}}" alt="{{ $blog->image ?? ''}}">
                    </div>

                    <h1 class="h3 post-title">{{ $blog->title ?? '' }}</h1>

                    <div class="post-date">{{ $blog->created_at->diffForHumans() }}</div>

                    <div class="post-text">
                        {!! $blog->text !!}
                    </div>
                </article> <!-- /.post-content -->

                <!-- <div class="post-tags-share">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">Tags:</div>
                            <div class="tagcloud">
                                <a href="shop.html">Furniture</a>
                                <a href="shop.html">Kitchen</a>
                                <a href="shop.html">Home</a>
                                <a href="shop.html">Jewelry</a>
                                <a href="shop.html">Gift</a>
                            </div>
                        </div>

                        <div class="col-md-4 text-lg-right">
                            <div class="post-share d-md-inline-block text-left">
                                <div class="mb-2">Share:</div>
                                <div class="share">
                                    <ul class="social-links">
                                        <li><a href="#"><i class="mdi mdi-pinterest"></i></a></li>
                                        <li><a href="#"><i class="mdi mdi-facebook"></i></a></li>
                                        <li><a href="#"><i class="mdi mdi-instagram"></i></a></li>
                                        <li><a href="#"><i class="mdi mdi-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="post-navigation">
                    <div class="row">
                        <div class="nav-previous col-6">
                            <a href="single-post.html">
                                <i class="flaticon-left-arrow-sign"></i>
                                <span>Previous</span>
                            </a>
                        </div>
                        <div class="nav-next col-6">
                            <a href="single-post.html">
                                <span>Next</span>
                                <i class="flaticon-right-direction"></i>
                            </a>
                        </div>
                    </div>
                </div> -->

                <!-- <section class="latest-posts">
                    <h3 class="mb-40">Latest posts</h3>

                    <div class="post-grid row">
                        <div class="col-lg-4 col-md-6">
                            <article class="post-item">
                                <a href="single-post.html" class="post-thumb">
                                    <img src="images/370x260.png" alt="">
                                </a>
                                <div class="post-item__content">
                                    <div class="post-date">06 Jan 2016</div>
                                    <h3 class="post-title"><a href="single-post.html">Designer Spotlight: Peter Barber</a></h3>
                                </div>
                            </article>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <article class="post-item">
                                <a href="single-post.html" class="post-thumb">
                                    <img src="images/370x260.png" alt="">
                                </a>
                                <div class="post-item__content">
                                    <div class="post-date">16 Oct 2016</div>
                                    <h3 class="post-title"><a href="single-post.html">How do I know if I‘m getting any of this law of attraction stuff</a></h3>
                                </div>
                            </article>
                        </div>

                        <div class="col-lg-4">
                            <article class="post-item">
                                <a href="single-post.html" class="post-thumb">
                                    <img src="images/370x260.png" alt="">
                                </a>
                                <div class="post-item__content">
                                    <div class="post-date">19 Oct 2016</div>
                                    <h3 class="post-title"><a href="single-post.html">How to choose and use a backpack ?</a></h3>
                                </div>
                            </article>
                        </div>
                    </div>
                </section> -->

            </main>

            <aside class="sidebar col-lg-3">
                <div class="sidebar-widget">
                    <h4 class="widget-title">Newsletter</h4>
                    <form>
                        <div class="form-group">
                            <input type="text" placeholder="E-mail address">
                            <input type="submit" class="btn btn-primary btn-sm" value="Subscribe">
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
        </div> <!-- /.row-->
    </div> <!-- /.container-->
</div> <!-- /.page-content-->
@endsection
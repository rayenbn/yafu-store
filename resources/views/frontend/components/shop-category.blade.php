


<div class="categories">
    <div  class="filters button-group container">
    	
    <div class="post-tags-share">
        <div class="row">
            <div class="col-md-8">
            @foreach( $categories as $parentCategory)
                <div class="mb-3"><a href="{{ $parentCategory->path() }}" class="btn btn-primary btn-sm mr-1">{{ $parentCategory->category_name ?? '' }}</a>:</div>
                <div class="tagcloud">                
                    @if ($parentCategory->children)
                        @foreach($parentCategory->children as $key => $child_cat)   
                            <a href="{{ $child_cat->path() }}">{{ $child_cat->category_name }}</a>
                            @if ($child_cat->child->count() > 0)
                                @foreach($child_cat->child as $key => $child)
                                    <a href="{{ $child->path() }}">{{ $child->category_name ?? ''}}</a>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                    
                    <!-- <a href="shop.html">Furniture</a>
                    <a href="shop.html">Kitchen</a>
                    <a href="shop.html">Home</a>
                    <a href="shop.html">Jewelry</a>
                    <a href="shop.html">Gift</a> -->
                </div>
            @endforeach
            </div>
        </div>
    </div>

      
  {{--  <nav class="navbar" style="margin-bottom: 7px;">
        <div class="navbar-container">
        <!-- Navbar category -->
            <div class="navbar-category">
                <a href="javascript:;" class="category-button">
                <div class="category-btn">
                    Shop <i class="fa fa-chevron-down"></i>
                </div>
                </a>
                <ul class="category-menu">
                    @foreach( $categories as $parentCategory)
                        <li @if($parentCategory->children()->count() > 0) class="category-dropdown" @endif>
                            <a href="{{ $parentCategory->path() }}" >{{ $parentCategory->category_name ?? '' }}</a>
                            @if ($parentCategory->children)
                            <ul class="category-submenu">
                                    @foreach($parentCategory->children as $key => $child_cat)
                                        <li >
                                            <a href="{{ $child_cat->path() }}">{{ $child_cat->category_name }}</a>
                                            @if ($child_cat->child->count() > 0)
                                            <ul >
                                                @foreach($child_cat->child as $key => $child)
                                                    <li><a href="{{ $child->path() }}">{{ $child->category_name ?? ''}}</a></li>
                                                @endforeach
                                            </ul>
                                            @endif
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                
                

                </ul>
                
            </div>
        </div>
        
    </nav>
    @foreach ($categories as $index => $parentCategory)	
        @if($index < 5)
        <nav class="navbar" style="margin-bottom: 7px;">
            <div class="navbar-container">
            <!-- Navbar category -->
                <div class="navbar-category">
                    <a href="javascript:;" class="category-button">
                    <div class="category-btn">
                    {{ $parentCategory->category_name }}  @if($parentCategory->children()->count() > 0)<i class="fa fa-chevron-down"></i> @endif
                    </div>
                    </a>
                    @if ($parentCategory->children)
                    <ul class="category-menu">
                        @foreach($parentCategory->children as $key => $child_cat)
                            <li @if($child_cat->children()->count() > 0) class="category-dropdown" @endif>
                                <a href="{{ $child_cat->path() }}" >{{ $child_cat->category_name ?? '' }}</a>
                                @if ($child_cat->child->count() > 0)
                                <ul class="category-submenu">
                                        @foreach($child_cat->child as $key => $child)
                                            <li >
                                                <a href="{{ $child->path() }}">{{ $child->category_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach

                    </ul>
                    @endif
                </div>
            </div>
        </nav>
        @endif
    @endforeach		--}}

       
  
        						
    </div>
</div>
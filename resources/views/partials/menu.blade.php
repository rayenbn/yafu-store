<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">AFStore</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.home") }}" class="nav-link">
                        <p>
                            <i class="fas fa-tachometer-alt">

                            </i>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles/*') ? 'menu-open' : '' }} {{ request()->is('admin/users/*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle">
                            <i class="fas fa-users">

                            </i>
                            <p>
                                <span>{{ trans('global.userManagement.title') }}</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.permission.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.role.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fas fa-user">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.user.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('product_access')
                <li class="nav-item has-treeview {{ request()->is('admin/products/*') ? 'menu-open' : '' }} {{ request()->is('admin/category/*') ? 'menu-open' : '' }} {{ request()->is('admin/color/*') ? 'menu-open' : '' }} {{ request()->is('admin/products/create/*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle">
                            <i class="fas fa-warehouse">

                            </i>
                            <p>
                                <span>{{ trans('global.products') }}</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('product_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.products.index") }}" class="nav-link {{ request()->is('admin/products') }}">
                                        <i class="fas fa-star">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.product_list') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.products.create") }}" class="nav-link {{ request()->is('admin/products/') || request()->is('admin/products/*') ? 'active' : '' }}">
                                        <i class="fas fa-star">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.add') }} {{ trans('global.product.title_singular') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.category.index") }}" class="nav-link {{ request()->is('admin/category') || request()->is('admin/category/*') ? 'active' : '' }}">
                                        <i class="fas fa-star">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.Categories_list') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.color.index") }}" class="nav-link {{ request()->is('admin/color') || request()->is('admin/color/*') ? 'active' : '' }}">
                                        <i class="fas fa-star">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.colors_list') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.variant.index") }}" class="nav-link {{ request()->is('admin/variant') || request()->is('admin/variant/*') ? 'active' : '' }}">
                                        <i class="fas fa-star">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.variant_list') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                
                @can('gallery_access')
                <li class="nav-item">
                    <a href="{{ route("admin.gallery.index") }}" class="nav-link">
                        <p>
                            <i class="far fa-image">

                            </i>
                            <span>{{ trans('global.gallery') }}</span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('blog_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.blogs.index") }}" class="nav-link {{ request()->is('admin/blogs') || request()->is('admin/blogs/*') ? 'active' : '' }}">
                            <i class="fas fa-cogs">

                            </i>
                            <p>
                                <span>{{ trans('global.blog.title') }}</span>
                            </p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item has-treeview {{ request()->is('admin/products/*') ? 'menu-open' : '' }} {{ request()->is('admin/category/*') ? 'menu-open' : '' }} {{ request()->is('admin/color/*') ? 'menu-open' : '' }} {{ request()->is('admin/products/create/*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle">
                            <i class="fas fa-book"></i></i>
                            <p>
                                <span>Pages</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        @can('product_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.product-page.index") }}" class="nav-link">
                                <p>
                                <i class="fas fa-book"></i></i>
                                    <span>{{ trans('global.product_page') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('settings_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.home-page.index") }}" class="nav-link">
                                <p>
                                    <i class="fas fa-book">

                                    </i>
                                    <span>Home Page</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                    
                        @can('settings_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.aboutus.index") }}" class="nav-link">
                                <p>
                                    <i class="fas fa-book">

                                    </i>
                                    <span>{{ trans('global.about_us_page') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('settings_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.contactus.index") }}" class="nav-link">
                                <p>
                                    <i class="fas fa-book">

                                    </i>
                                    <span>{{ trans('global.contact_us_page') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('settings_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.warranty-page.index") }}" class="nav-link">
                                <p>
                                    <i class="fas fa-book">
                                    </i>
                                    <span>Warranty Page</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('settings_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.privacy-page.index") }}" class="nav-link">
                                <p>
                                    <i class="fas fa-book">
                                    </i>
                                    <span>Privacy Page</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>


                
                @can('settings_access')
                <li class="nav-item has-treeview {{ request()->is('admin/global-settings') ? 'menu-open' : '' }} {{ request()->is('admin/slider') ? 'menu-open' : '' }} {{ request()->is('admin/slider/*') ? 'menu-open' : '' }} {{ request()->is('admin/partners') ? 'menu-open' : '' }} {{ request()->is('admin/partners/*') ? 'menu-open' : '' }}  {{ request()->is('admin/footer') ? 'menu-open' : '' }} {{ request()->is('admin/footer/*') ? 'menu-open' : '' }}">
                  
                    <a class="nav-link nav-dropdown-toggle">
                            <i class="fas fa-cog">

                            </i>
                            <p>
                                <span>{{ trans('global.settings') }}</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                                <a href="{{ route("admin.global-settings.index") }}" class="nav-link {{ request()->is('admin/global-settings') || request()->is('admin/global-settings/*') ? 'active' : '' }}">
                                    <i class="fas fa-star">

                                    </i>
                                    <p>
                                        <span>General Settings</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("admin.slider.index") }}" class="nav-link {{ request()->is('admin/slider') || request()->is('admin/slider/*') ? 'active' : '' }}">
                                    <i class="fas fa-star">

                                    </i>
                                    <p>
                                        <span>Sliders</span>
                                    </p>
                                </a>
                            </li>
                         
                            <li class="nav-item">
                                <a href="{{ route("admin.footer.index") }}" class="nav-link {{ request()->is('admin/footer') || request()->is('admin/footer/*') ? 'active' : '' }}">
                                    <i class="fas fa-star">

                                    </i>
                                    <p>
                                        <span>Footer</span>
                                    </p>
                                </a>
                            </li>
                    </ul>
                </li>
                @endcan
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-sign-out-alt">

                            </i>
                            <span>{{ trans('global.logout') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
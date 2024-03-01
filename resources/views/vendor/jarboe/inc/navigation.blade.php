<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">

    @include('jarboe::inc.user_info')

    <nav>
        <!--
        NOTE: Notice the gaps after each icon usage <i></i>..
        Please note that these links work a bit different than
        traditional href="" links. See documentation for details.
        -->

        <ul>

            <li>
                <a href="{{ admin_url('dashboard') }}">
                    <i class="fa fa-lg fa-fw fa-anchor"></i>
                    <span class="menu-item-parent">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ admin_url('users') }}">
                    <i class="fa fa-lg fa-fw fa-user"></i>
                    <span class="menu-item-parent">Users</span>
                </a>
            </li>

            <li>
                <a href="{{ admin_url('countries') }}">
                    <i class="fa fa-lg fa-fw fa-globe"></i>
                    <span class="menu-item-parent">Countries</span>
                </a>
            </li>

            <li>
                <a href="{{ admin_url('brands') }}">
                    <i class="fa fa-lg fa-fw fa-user"></i>
                    <span class="menu-item-parent">Brands</span>
                </a>
            </li>

            <li>
                <a href="#" title="Admin Panel"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Animals</span></a>
                <ul>
                    <li>
                        <a href="{{ admin_url('offer-by-animals') }}">
                            <span class="menu-item-parent">Offers by Animal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ admin_url('animals') }}">
                            <span class="menu-item-parent">Animals</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ admin_url('categories') }}">
                    <i class="fa fa-lg fa-fw fa-user"></i>
                    <span class="menu-item-parent">Categories</span>
                </a>
            </li>

            <li>
                <a href="{{ admin_url('subcategories') }}">
                    <i class="fa fa-lg fa-fw fa-user"></i>
                    <span class="menu-item-parent">Subcategories</span>
                </a>
            </li>

            <li>
                <a href="{{ admin_url('products') }}">
                    <i class="fa fa-lg fa-fw fa-user"></i>
                    <span class="menu-item-parent">Products</span>
                </a>
            </li>

            <li>
                <a href="#" title="Admin Panel"><i class="fa fa-lg fa-fw fa-newspaper-o"></i> <span class="menu-item-parent">News</span></a>
                <ul>
                    <li>
                        <a href="{{ admin_url('category-news') }}">
                            <span class="menu-item-parent">Category News</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ admin_url('news') }}">
                            <span class="menu-item-parent">News</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ admin_url('general-settings') }}">
                    <i class="fa fa-lg fa-fw fa-cog"></i>
                    <span class="menu-item-parent">General Settings</span>
                </a>
            </li>
        </ul>
    </nav>


    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>

</aside>
<!-- END NAVIGATION -->

@push('scripts')
    <script>
        $('#left-panel nav a').each(function() {
            let href = window.location.href;
            let index = href.indexOf("/~/");
            if (~index) {
                href = window.location.href.substring(0, index);
            }
            if (this.href.replace(/\/$/, '') === href.replace(/\/$/, '')) {
                $(this).closest('li').addClass('active');
            }
        });
    </script>
@endpush

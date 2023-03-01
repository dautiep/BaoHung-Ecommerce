<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ addVersionTo('admin/images/logo.png') }}" alt="AdminPTTT Logo" class=""
            style="opacity: 1; width:100px;">
        <span class="brand-text font-weight-light"><em></em></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar pb-5">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">
                    Quản trị viên
                </li>
                <li class="nav-item">
                    <<a href="{{ route('dashboard') }}"
                        class="nav-link nav-main {{ @$activePage === 'dashboard' ? ' active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Trang Chủ </p>
                        </a>
                </li>

                @php
                    $sidebar = collect(config('left_sidebar'))->where('active', true);
                @endphp
                @foreach ($sidebar as $parent)
                    @if ($loop->index == 1)
                        <li class="nav-header">ECOMMERCE SYSTEM</li>
                    @endif
                    <li class="nav-item has-treeview menu-open">
                        @php
                            $hasActivePage = in_array(@$activePage, $parent['hasActivePage']);
                            $router = !empty($parent['router']) ? route($parent['router']) : '#';
                            $is_can = @is_can($parent['authorize']);
                        @endphp
                        @if ($is_can)
                            <a href="{{ @$router }}"
                                class="nav-link nav-main {{ !empty($hasActivePage) ? ' active' : '' }}">
                                <i class="{{ $parent['icon'] }}"></i>
                                <p>
                                    {{ @$parent['name'] }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            @if (count(@$parent['children']) > 0)
                                <ul class="nav nav-treeview" style="display: block">
                                    @foreach (collect($parent['children'])->where('active', true) as $sub_item)
                                        @php
                                            $router = !empty($sub_item['router']) ? route($sub_item['router']) : '#';
                                            $hasActivePage = in_array(@$activePage, $sub_item['hasActivePage']);
                                            $is_can = @is_can($sub_item['authorize']);
                                        @endphp
                                        @if ($is_can)
                                            <li class="nav-item">
                                                <a href="{{ @$router }}"
                                                    class="nav-link {{ !empty($hasActivePage) ? ' active' : '' }}">
                                                    <i class="{{ @$sub_item['icon'] }}"></i>
                                                    <p>{{ @$sub_item['name'] }}</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        @endif
                    </li>

                @endforeach
            </ul>
        </nav>
    </div>
</aside>

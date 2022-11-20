<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('image/logo/logo.png') }}" alt="AdminPTTT Logo" class="" style="opacity: 1; width:90px; height:70px;">
        <span class="brand-text font-weight-light"><em></em></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar pb-5">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">
                    Quản trị viên
                </li>
                <li class="nav-item">
                    <<a href="{{ route('dashboard') }}" class="nav-link nav-main {{ $activePage === 'dashboard' ? ' active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Trang Chủ </p>
                    </a>
                </li>
                {{-- @if (Auth::user()->role == App\Enums\ERole::ADMIN) --}}
                    <li class="nav-item">
                        <a href="" class="nav-link nav-main {{ $activePage === 'list-account' ? ' active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p> Quản Lý Tài Khoản</p>
                        </a>
                    </li>
                {{-- @endif --}}
                <li class="nav-header">AZOFFICE SYSTEM</li>
                @if ($activePage == 'list-building' || $activePage == 'list-building-feature' ||
                $activePage == 'space-building' || $activePage == 'list-update-building' ||
                $activePage == 'list-request-update-building')
                    @php
                        $hasActivePage = true
                    @endphp
                @endif

                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link nav-main {{ (!empty($hasActivePage)) ? ' active' : '' }}">
                        <i class="nav-icon far fa-building"></i>
                        <p>
                            Quản Lý Văn Phòng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="display: block">
                        {{-- @if (Auth::user()->role != App\Enums\ERole::MARKETING) --}}
                            <li class="nav-item">
                                <a href="" class="nav-link {{ ($activePage === 'list-building') ? ' active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách Văn Phòng</p>
                                </a>
                            </li>
                        {{-- @endif --}}
                        {{-- @if (Auth::user()->role != App\Enums\ERole::MARKETING) --}}
                            <li class="nav-item">
                                <a href="" class="nav-link @if ($activePage == 'list-building-feature') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>DS Văn Phòng Nổi Bật</p>
                                </a>
                            </li>
                        {{-- @endif --}}
                        {{-- @if (Auth::user()->role != App\Enums\ERole::MARKETING) --}}
                            <li class="nav-item">
                                <a href="" class="nav-link @if ($activePage == 'space-building') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Trang Mặt Bằng</p>
                                </a>
                            </li>
                        {{-- @endif --}}
                        {{-- @if (Auth::user()->role != App\Enums\ERole::MARKETING) --}}
                            <li class="nav-item">
                                <a href="" class="nav-link @if ($activePage == 'list-request-update-building') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Yêu Cầu Cập Nhật VP</p>
                                </a>
                            </li>
                        {{-- @endif --}}
                        {{-- @if (Auth::user()->role != App\Enums\ERole::MARKETING) --}}
                            <li class="nav-item">
                                <a href="" class="nav-link @if ($activePage == 'list-update-building') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Log Cập Nhật VP</p>
                                </a>
                            </li>
                        {{-- @endif --}}
                    </ul>
                </li>
                @if ($activePage == 'review-customer' || $activePage == 'schedule-building' || $activePage == 'rent-building' ||
                $activePage == 'contact-customer')
                    @php
                        $hasActivePageInfo = true
                    @endphp
                @endif
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link nav-main {{ (!empty($hasActivePageInfo)) ? ' active' : '' }}">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            Quản Lý Thông Tin
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="display: block">
                        {{-- @if (Auth::user()->role != App\Enums\ERole::MARKETING) --}}
                            <li class="nav-item">
                                <a href="" class="nav-link @if ($activePage == 'review-customer') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Đánh Giá Văn Phòng</p>
                                </a>
                            </li>
                        {{-- @endif --}}
                        <li class="nav-item">
                            <a href="" class="nav-link @if ($activePage == 'schedule-building') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lịch Xem Văn Phòng</p>
                            </a>
                        </li>
                        {{-- @if (Auth::user()->role != App\Enums\ERole::MARKETING) --}}
                            <li class="nav-item">
                                <a href="" class="nav-link @if ($activePage == 'rent-building') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thông Tin Ký Gửi</p>
                                </a>
                            </li>
                        {{-- @endif --}}
                        {{-- @if (Auth::user()->role != App\Enums\ERole::MARKETING) --}}
                            <li class="nav-item">
                                <a href="" class="nav-link @if ($activePage == 'contact-customer') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thông Tin Liên Hệ</p>
                                </a>
                            </li>
                        {{-- @endif --}}
                    </ul>
                </li>
                @if ($activePage == 'list-blog-posts' || $activePage == 'list-blog-categories' ||$activePage == 'list-blog-tags')
                    @php
                        $hasActivePageBlog = true
                    @endphp
                @endif

                {{-- @if (Auth::user()->role != App\Enums\ERole::MG) --}}
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link nav-main {{ (!empty($hasActivePageBlog)) ? ' active' : '' }}">
                            <i class="nav-icon fa fa-book"></i>
                            <p>
                                Quản Lý Tin Tức
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview" style="display: block">
                            <li class="nav-item">
                                <a href="" class="nav-link {{ ($activePage === 'list-blog-posts') ? ' active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Bài Viết</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link @if ($activePage == 'list-blog-categories') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Mục</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link @if ($activePage == 'list-blog-tags') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thẻ</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                {{-- @endif --}}


                {{-- <li class="nav-item">
                    <a href="" class="nav-link" >
                        <i class="nav-icon nav-icon fas fa-table"></i>
                        <p> Tài Khoản </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
    </div>
</aside>

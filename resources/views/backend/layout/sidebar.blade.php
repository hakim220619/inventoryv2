<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            @if (request()->user()->role == 1)
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Admin</li>

                    <li>
                        <a href="/dashboard" class="waves-effect">
                            <i class="mdi mdi-view-dashboard"></i>
                            <span class="badge rounded-pill bg-primary float-end">2</span>
                            <span>Dashboard</span>
                        </a>
                    </li>



                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-buffer"></i>
                            <span>Master Data</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/admin">Admin</a></li>
                            {{-- <li><a href="/users">Gudang</a></li> --}}
                            <li><a href="/BahanBaku">Bahan Baku</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="/product" class="waves-effect">
                            <i class="mdi mdi-cash-usd-outline"></i>
                            <span>Product</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="/pesanan" class="waves-effect">
                            <i class="mdi mdi-cash-usd-outline"></i>
                            <span>Pesanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/riwayat-pesanan" class="waves-effect">
                            <i class="mdi mdi-cash-usd-outline"></i>
                            <span>Riwayat Pesanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/laporan" class="waves-effect">
                            <i class="mdi mdi-cash-usd-outline"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ion ion-md-settings"></i>
                            <span>Setting</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/aplikasi">Aplikasi</a></li>

                        </ul>
                    </li>
                </ul>
            @elseif (request()->user()->role == 2)
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Gudang</li>
                    <li>
                        <a href="/dashboard" class="waves-effect">
                            <i class="mdi mdi-view-dashboard"></i>
                            <span class="badge rounded-pill bg-primary float-end">2</span>
                            <span>Dashboard</span>
                        </a>
                    </li>



                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-buffer"></i>
                            <span>Master Data</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/BahanBaku">Bahan Baku</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="/product" class="waves-effect">
                            <i class="mdi mdi-cash-usd-outline"></i>
                            <span>Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="/laporan" class="waves-effect">
                            <i class="mdi mdi-cash-usd-outline"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                </ul>
            @elseif (request()->user()->role == 3)
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Manager</li>

                    <li>
                        <a href="dashboard" class="waves-effect">
                            <i class="mdi mdi-view-dashboard"></i>
                            <span class="badge rounded-pill bg-primary float-end">2</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/laporan" class="waves-effect">
                            <i class="mdi mdi-cash-usd-outline"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                </ul>
            @else
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Kepala Bagian</li>
                    <li>
                        <a href="dashboard" class="waves-effect">
                            <i class="mdi mdi-view-dashboard"></i>
                            <span class="badge rounded-pill bg-primary float-end">2</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/pesanan" class="waves-effect">
                            <i class="mdi mdi-cash-usd-outline"></i>
                            <span>Pesanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/wishlist" class="waves-effect">
                            <i class="mdi mdi-cart"></i>
                            <span>Wishlist</span>
                        </a>
                    </li>
                    <li>
                        <a href="/riwayat-pesanan" class="waves-effect">
                            <i class="mdi mdi-cash-usd-outline"></i>
                            <span>Riwayat Pesanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/laporan" class="waves-effect">
                            <i class="mdi mdi-cash-usd-outline"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                </ul>
            @endif
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

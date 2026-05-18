<nav class="bottom-nav fixed-bottom">

    {{-- Home --}}
    <a href="{{ url('/home') }}"
       class="nav-item {{ request()->is('/') || request()->is('home') ? 'active' : '' }}"
       style="flex:1; text-align:center; text-decoration:none; color:inherit;">
        <span class="nav-icon-wrap">
            <i class="bi bi-house-door-fill"></i>
        </span>
    </a>

    {{-- Tambah Pesanan --}}
    <a href="{{ url('/tambahpesanan') }}"
       class="nav-item {{ request()->is('tambahpesanan') || request()->is('pesanan*') ? 'active' : '' }}"
       style="flex:1; text-align:center; text-decoration:none; color:inherit;">
        <span class="nav-icon-wrap">
            <i class="bi bi-plus-lg"></i>
        </span>
    </a>

    {{-- Keuangan --}}
    <a href="{{ url('/keuangan') }}"
       class="nav-item {{ request()->is('keuangan') ? 'active' : '' }}"
       style="flex:1; text-align:center; text-decoration:none; color:inherit;">
        <span class="nav-icon-wrap">
            <i class="bi bi-bar-chart-line"></i>
        </span>
    </a>

    {{-- Pelanggan / Profile --}}
    <a href="{{ url('/pelanggan') }}"
       class="nav-item {{ request()->is('pelanggan') ? 'active' : '' }}"
       style="flex:1; text-align:center; text-decoration:none; color:inherit;">
        <span class="nav-icon-wrap">
            <i class="bi bi-person"></i>
        </span>
    </a>

</nav>

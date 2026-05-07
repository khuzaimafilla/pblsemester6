<nav style="
    position: fixed;
    top: 0;
    left: 0;
    right: 0;

    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:20px 60px;

    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);

    border-bottom: 1px solid rgba(255,255,255,0.3);
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);

    z-index: 999;
    box-sizing: border-box;
">

    <!-- LEFT -->
    <div style="display:flex; align-items:center; gap:12px;">
        <img src="{{ asset('assets/logo-simpoa.png') }}" style="height:45px;">
        <span style="color:#5BABD0; font-size:24px; font-weight:800;">
            SIMPOA
        </span>
    </div>

    <!-- RIGHT -->
    <div style="display:flex; gap:40px;">

        <a href="{{ route('beranda') }}"
            style="
            text-decoration:none;
            font-size:18px;
            transition:0.3s;
            font-weight: {{ request()->routeIs('beranda') ? '700' : '500' }};
            color: {{ request()->routeIs('beranda') ? '#3A929C' : '#5BABD0' }};
        "
        onmouseover="this.style.color='#3A929C'"
        onmouseout="this.style.color='{{ request()->routeIs('beranda') ? '#3A929C' : '#5BABD0' }}'">
            Beranda
        </a>

        <a href="{{ route('prosedur') }}"
            style="
            text-decoration:none;
            font-size:18px;
            transition:0.3s;
            font-weight: {{ request()->routeIs('prosedur') ? '700' : '500' }};
            color: {{ request()->routeIs('prosedur') ? '#3A929C' : '#5BABD0' }};
        "
        onmouseover="this.style.color='#3A929C'"
        onmouseout="this.style.color='{{ request()->routeIs('prosedur') ? '#3A929C' : '#5BABD0' }}'">
            Prosedur
        </a>

        <a href="{{ route('tentang') }}"
            style="
            text-decoration:none;
            font-size:18px;
            transition:0.3s;
            font-weight: {{ request()->routeIs('tentang') ? '700' : '500' }};
            color: {{ request()->routeIs('tentang') ? '#3A929C' : '#5BABD0' }};
        "
        onmouseover="this.style.color='#3A929C'"
        onmouseout="this.style.color='{{ request()->routeIs('tentang') ? '#3A929C' : '#5BABD0' }}'">
            Tentang
        </a>

    </div>
</nav>
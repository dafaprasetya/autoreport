<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
      <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('home') }}" class="sidebar-logo">
            SERVICES
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li class="sidebar-menu-group-title">Dashboard</li>
            <li>
                <a href="{{ route('dashboardService') }}" class="{{ Route::is('dashboardService') ? 'active-page' : '' }}" >
                    <iconify-icon icon="material-symbols:dashboard" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Report</li>
            <li>
                <a href="{{ route('mastergaservice') }}" class="{{ Route::is('mastergaservice') ? 'active-page' : '' }}" >
                    <iconify-icon icon="mage:box-3d-fill" class="menu-icon"></iconify-icon>
                    <span>Master GA</span>
                </a>
            </li>
            <li>
                <a href="{{ route('reportHarianService') }}" class="{{ Route::is('reportHarianService') | Route::is('reportHarianServiceDetail') ? 'active-page' : '' }}">
                    <iconify-icon icon="mingcute:sale-line" class="menu-icon"></iconify-icon>
                    <span>Harian</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tambahReportService') }}" class="{{ Route::is('tambahReportService') ? 'active-page' : '' }}">
                    <iconify-icon icon="solar:add-folder-broken" class="menu-icon"></iconify-icon>
                    <span>Buat Report</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Waiting List</li>
            <li>
                <a href="{{ route('waitingListService') }}" class="{{ Route::is('waitingListService') ? 'active-page' : '' }}" >
                    <iconify-icon icon="medical-icon:i-waiting-area" class="menu-icon"></iconify-icon>
                    <span>Waiting List</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Eksekutor</li>
            <li>
                <a href="{{ route('reportEksekutorService') }}" class="{{ Route::is('reportEksekutorService') ? 'active-page' : '' }}" >
                    <iconify-icon icon="lsicon:report-outline" class="menu-icon"></iconify-icon>
                    <span>Report Eksekutor</span>
                </a>
            </li>
        </ul>
    </div>
  </aside>

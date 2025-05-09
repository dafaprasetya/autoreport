<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
      <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('home') }}" class="sidebar-logo">
            Manager
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li class="sidebar-menu-group-title">Dashboard Service</li>
            <li>
                <a href="{{ route('dashboardService') }}" class="{{ Route::is('dashboardService') ? 'active-page' : '' }}" >
                    <iconify-icon icon="material-symbols:dashboard" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Dashboard IT</li>
            <li>
                <a href="{{ route('dashboardIT') }}" class="{{ Route::is('dashboardIT') ? 'active-page' : '' }}" >
                    <iconify-icon icon="material-symbols:dashboard" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Report IT</li>
            <li>
                <a href="{{ route('mastergaIT') }}" class="{{ Route::is('mastergaIT') ? 'active-page' : '' }}" >
                    <iconify-icon icon="mage:box-3d-fill" class="menu-icon"></iconify-icon>
                    <span>Master GA</span>
                </a>
            </li>
            <li>
                <a href="{{ route('reportHarianITNew') }}" class="{{ Route::is('reportHarianITNew') ? 'active-page' : '' }}">
                    <iconify-icon icon="mingcute:sale-line" class="menu-icon"></iconify-icon>
                    <span>Harian</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Report Service</li>
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
            <li class="sidebar-menu-group-title">Waiting List IT</li>
            <li>
                <a href="{{ route('waitingListIt') }}" class="{{ Route::is('waitingListIt') ? 'active-page' : '' }}" >
                    <iconify-icon icon="medical-icon:i-waiting-area" class="menu-icon"></iconify-icon>
                    <span>Waiting List</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Waiting List Service</li>
            <li>
                <a href="{{ route('waitingListService') }}" class="{{ Route::is('waitingListService') ? 'active-page' : '' }}" >
                    <iconify-icon icon="medical-icon:i-waiting-area" class="menu-icon"></iconify-icon>
                    <span>Waiting List</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Eksekutor IT</li>
            <li>
                <a href="{{ route('reportEksekutorIT') }}" class="{{ Route::is('reportEksekutorIT') ? 'active-page' : '' }}" >
                    <iconify-icon icon="lsicon:report-outline" class="menu-icon"></iconify-icon>
                    <span>Report Eksekutor</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Eksekutor Service</li>
            <li>
                <a href="{{ route('reportEksekutorService') }}" class="{{ Route::is('reportEksekutorService') ? 'active-page' : '' }}" >
                    <iconify-icon icon="lsicon:report-outline" class="menu-icon"></iconify-icon>
                    <span>Report Eksekutor</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">User</li>
            <li>
                <a href="{{ route('itUserManage') }}" class="{{ Route::is('itUserManage') ? 'active-page' : '' }}" >
                    <iconify-icon icon="mdi:users" class="menu-icon"></iconify-icon>
                    <span>Manage User</span>
                </a>
            </li>
            {{-- <li class="sidebar-menu-group-title">Addon</li>
            <li>
                <a href="{{ route('manageLokasi') }}" class="{{ Route::is('manageLokasi') ? 'active-page' : '' }}" >
                    <iconify-icon icon="mdi:users" class="menu-icon"></iconify-icon>
                    <span>Manage Lokasi</span>
                </a>
            </li> --}}
        </ul>
    </div>
  </aside>

  @push('script')
    <script>
        function dashboardService() {
            window.Livewire.dispatch('setPage', { page: 'dashboardService' });
        }
        function dashboardIT() {
            window.Livewire.dispatch('setPage', { page: 'dashboardIT' });
        }

      </script>
  @endpush

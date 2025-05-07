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
                <a onclick="dashboardService()" class="{{ $page=="dashboardService" ? 'active-page' : '' }}" >
                    <iconify-icon icon="material-symbols:dashboard" class="menu-icon"></iconify-icon>
                    <span>Dashboard Service</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Dashboard IT</li>
            <li>
                <a onclick="dashboardIT()" class="{{ $page=="dashboardIT" ? 'active-page' : '' }}" >
                    <iconify-icon icon="material-symbols:dashboard" class="menu-icon"></iconify-icon>
                    <span>Dashboard IT</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Report IT</li>
            <li>
                <a href="{{ route('mastergaIT') }}" class="{{ Route::is('mastergaIT') ? 'active-page' : '' }}" >
                    <iconify-icon icon="mage:box-3d-fill" class="menu-icon"></iconify-icon>
                    <span>Master GA IT</span>
                </a>
            </li>
            <li>
                <a href="{{ route('reportHarianITNew') }}" class="{{ Route::is('reportHarianITNew') ? 'active-page' : '' }}">
                    <iconify-icon icon="mingcute:sale-line" class="menu-icon"></iconify-icon>
                    <span>Harian IT</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Report Service</li>
            <li>
                <a href="{{ route('mastergaIT') }}" class="{{ Route::is('mastergaIT') ? 'active-page' : '' }}" >
                    <iconify-icon icon="mage:box-3d-fill" class="menu-icon"></iconify-icon>
                    <span>Master GA Service</span>
                </a>
            </li>
            <li>
                <a href="{{ route('reportHarianITNew') }}" class="{{ Route::is('reportHarianITNew') ? 'active-page' : '' }}">
                    <iconify-icon icon="mingcute:sale-line" class="menu-icon"></iconify-icon>
                    <span>Harian Service</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Waiting List IT</li>
            <li>
                <a href="{{ route('waitingListIt') }}" class="{{ Route::is('waitingListIt') ? 'active-page' : '' }}" >
                    <iconify-icon icon="medical-icon:i-waiting-area" class="menu-icon"></iconify-icon>
                    <span>Waiting List IT</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Waiting List Service</li>
            <li>
                <a href="{{ route('waitingListIt') }}" class="{{ Route::is('waitingListIt') ? 'active-page' : '' }}" >
                    <iconify-icon icon="medical-icon:i-waiting-area" class="menu-icon"></iconify-icon>
                    <span>Waiting List Service</span>
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
                <a href="{{ route('reportEksekutorIT') }}" class="{{ Route::is('reportEksekutorIT') ? 'active-page' : '' }}" >
                    <iconify-icon icon="lsicon:report-outline" class="menu-icon"></iconify-icon>
                    <span>Report Eksekutor Service</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">User</li>
            <li>
                <a href="{{ route('itUserManage') }}" class="{{ Route::is('itUserManage') ? 'active-page' : '' }}" >
                    <iconify-icon icon="mdi:users" class="menu-icon"></iconify-icon>
                    <span>Manage User</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Addon</li>
            <li>
                <a href="{{ route('manageLokasi') }}" class="{{ Route::is('manageLokasi') ? 'active-page' : '' }}" >
                    <iconify-icon icon="mdi:users" class="menu-icon"></iconify-icon>
                    <span>Manage Lokasi</span>
                </a>
            </li>
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

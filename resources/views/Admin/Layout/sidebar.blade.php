<div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="{{ url('admin/dashboard') }}" class="logo">
              <img src="{{ url('public/admin/assets/img/kaiadmin/logo.svg') }}" alt="navbar brand" class="navbar-brand" height="20">
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="scroll-wrapper sidebar-wrapper scrollbar scrollbar-inner" style="position: relative;"><div class="sidebar-wrapper scrollbar scrollbar-inner scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 355px;">
          <div class="sidebar-content">
          <ul class="nav nav-secondary">
            {{-- Dashboard --}}
          <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ url('admin/dashboard') }}">
              <i class="fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>


            {{-- Bookings --}}
            <li class="nav-item {{ request()->is('admin/bookings*') ? 'active' : '' }}">
              <a data-bs-toggle="collapse" href="#collapseBookings" class="{{ request()->is('admin/bookings*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->is('admin/bookings*') ? 'true' : 'false' }}">
                <i class="fas fa-calendar"></i>
                <p>Bookings</p>
                <span class="caret"></span>
              </a>
              <div class="collapse {{ request()->is('admin/bookings*') ? 'show' : '' }}" id="collapseBookings">
                <ul class="nav nav-collapse">
                  <li class="{{ request()->is('admin/bookings') ? 'active' : '' }}">
                    <a href="{{ url('admin/bookings') }}">
                      <span class="sub-item">All Records</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>

          </div>
        </div><div class="scroll-element scroll-x scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="width: 0px;"></div></div></div><div class="scroll-element scroll-y scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="height: 202px; top: 0px;"></div></div></div></div>
      </div>
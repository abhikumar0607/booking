<div class="main-header">
  <div class="main-header-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="index.html" class="logo">
        <img
          src="{{ url('public/admin/assets/img/kaiadmin/logo.svg') }}"
          alt="navbar brand"
          class="navbar-brand"
          height="20" />
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
  <!-- Navbar Header -->
  <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
      <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
        @php $unreads = currentUserNotifications(); @endphp
        <li class="nav-item dropdown hidden-caret">
          <a class="nav-link dropdown-toggle position-relative px-0 py-0" href="#" id="notifDropdown"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-bell {{ $unreads->count() ? 'bell-shake' : '' }}" style="font-size:1.5rem; color:#f68622;"></i>
            @if($unreads->count())
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
              {{ $unreads->count() }}
            </span>
            @endif
          </a>
          <ul class="dropdown-menu dropdown-menu-end animated fadeIn shadow-lg"
            aria-labelledby="notifDropdown" style="width:400px;max-height:600px;overflow-y:auto;">
            @forelse($unreads as $notification)
            <li class="dropdown-item">
              <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link text-start p-0 w-100">
                  🔔 {{ $notification->data['message'] ?? 'No message found' }}
                  <br>
                  <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </button>
              </form>
            </li>
            <hr class="dropdown-divider m-0">
            @empty
            <li class="dropdown-item text-center text-muted py-3">
              <i class="fa-regular fa-bell-slash"></i> No new notifications
            </li>
            @endforelse

            @if($unreads->count())
            <li class="dropdown-item text-center">
              <form action="{{ route('notifications.readAll') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary">Mark all as read</button>
              </form>
            </li>
            @endif
          </ul>
        </li>
        </li>
        <li class="nav-item topbar-user dropdown hidden-caret">
          <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
            <div class="avatar-sm">
              <img src="{{ url('public/admin/assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle" />
            </div>
            <span class="profile-username">
              <span class="op-7">Hi,</span>
              <span class="fw-bold">@if(currentUser()) {{ currentUser()->name }} @endif</span>
            </span>
          </a>
          <ul class="dropdown-menu dropdown-user animated fadeIn">
            <div class="dropdown-user-scroll scrollbar-outer">
              <li>
                <div class="user-box">
                  <div class="avatar-lg">
                    <img src="{{ url('public/admin/assets/img/profile.jpg') }}" alt="image profile" class="avatar-img rounded" />
                  </div>
                  <div class="u-text">
                    <h4>@if(currentUser()) {{ currentUser()->name }} @endif</h4>
                    <p class="text-muted">@if(currentUser()) {{ currentUser()->email }} @endif</p>
                  </div>
                </div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            </div>
          </ul>
        </li>
      </ul>
    </div>
  </nav>

  <!-- End Navbar -->
</div>
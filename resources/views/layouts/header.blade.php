<div class="header">
    <div class="d-flex align-items-center">
        <button id="toggleSidebar" class="btn btn-light border me-3">
            <i class="fa fa-bars"></i>
        </button>
        <h5 class="m-0 fw-bold text-primary">@yield('page-title', 'Dashboard')</h5>
    </div>

    <div class="d-flex align-items-center gap-3">
        <div class="search-bar">
            <input type="text" class="form-control" placeholder="Cari...">
        </div>
        <div class="dropdown">
            <button class="btn btn-light border dropdown-toggle" type="button" id="adminDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user"></i> {{ Auth::user()->name }}
            </button>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                {{-- <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li> --}}

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

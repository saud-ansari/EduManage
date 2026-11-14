<header class="topbar">

    <div>

        <h5 class="mb-1 fw-bold">
            @yield('heading', 'Dashboard')
        </h5>

        <small class="text-muted">
            Student Management System
        </small>

    </div>

    <div class="dropdown">

        <button class="btn btn-light dropdown-toggle"
                data-bs-toggle="dropdown">

            <i class="bi bi-person-circle me-2"></i>
            Administrator

        </button>

        <ul class="dropdown-menu dropdown-menu-end">

            <li>
                <a class="dropdown-item" href="#">
                    <i class="bi bi-person me-2"></i>
                    Profile
                </a>
            </li>

            <li>
                <a class="dropdown-item" href="#">
                    <i class="bi bi-gear me-2"></i>
                    Settings
                </a>
            </li>

        </ul>

    </div>

</header>
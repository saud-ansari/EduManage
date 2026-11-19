
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

        @auth

            {{-- Authenticated User --}}
            <button class="btn btn-light dropdown-toggle"
                    data-bs-toggle="dropdown">

                <i class="bi bi-person-circle me-2"></i>

                {{ Auth::user()->name }}

                <span class="badge bg-primary ms-2">
                    {{ ucfirst(Auth::user()->role) }}
                </span>

            </button>

            <ul class="dropdown-menu dropdown-menu-end">

                {{-- Admin and Staff --}}
                @if(in_array(Auth::user()->role, ['admin', 'staff']))

                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('students.index') }}">
                            Students
                        </a>
                    </li>

                @endif

                {{-- Admin Only --}}
                @if(Auth::user()->role === 'admin')

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item" href="{{ route('students.trash') }}">
                            Trash
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('admin.accounts.students') }}">
                            Student Accounts
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('admin.accounts.teachers') }}">
                            Teacher Accounts
                        </a>
                    </li>

                @endif

                {{-- Teacher Only --}}
                @if(Auth::user()->role === 'teacher')

                    <li>
                        <a class="dropdown-item" href="{{ route('teacher.dashboard') }}">
                            My Teaching Dashboard
                        </a>
                    </li>

                @endif

                {{-- Student Only --}}
                @if(Auth::user()->role === 'student')

                    <li>
                        <a class="dropdown-item" href="{{ route('student.profile') }}">
                            My Profile
                        </a>
                    </li>

                @endif

                <li><hr class="dropdown-divider"></li>

                {{-- Logout --}}
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Logout
                        </button>
                    </form>
                </li>

            </ul>

        @endauth

    </div>

</header>

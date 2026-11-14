<aside class="sidebar">

    <div class="brand">
        <i class="bi bi-mortarboard-fill me-2"></i>
        EduManage
    </div>

    <div class="sidebar-label">
        MAIN MENU
    </div>

    <a href="{{ route('home') }}"
       class="{{ request()->routeIs('home') ? 'active' : '' }}">
        <i class="bi bi-grid me-2"></i>
        Dashboard
    </a>

    <a href="{{ route('students.index') }}"
       class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
        <i class="bi bi-people me-2"></i>
        Students
    </a>

    <div class="sidebar-label mt-3">
        INFORMATION
    </div>

    <a href="{{ route('about') }}"
       class="{{ request()->routeIs('about') ? 'active' : '' }}">
        <i class="bi bi-info-circle me-2"></i>
        About
    </a>

    <a href="{{ route('contact') }}"
       class="{{ request()->routeIs('contact') ? 'active' : '' }}">
        <i class="bi bi-envelope me-2"></i>
        Contact
    </a>

    <hr class="border-secondary">

    <div class="sidebar-label">
        SYSTEM
    </div>

    <a href="#">
        <i class="bi bi-gear me-2"></i>
        Settings
    </a>

</aside>
@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="mb-4">
        <h2 class="fw-bold">
            Welcome, {{ Auth::user()->name }}!
        </h2>

        <p class="text-muted">
            Welcome to your EduManage dashboard.
        </p>
    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h5 class="fw-bold">Account Information</h5>

            <p>
                <strong>Name:</strong>
                {{ Auth::user()->name }}
            </p>

            <p>
                <strong>Email:</strong>
                {{ Auth::user()->email }}
            </p>

            <p>
                <strong>Role:</strong>
                {{ ucfirst(Auth::user()->role) }}
            </p>

        </div>

    </div>

    @if(in_array(Auth::user()->role, ['admin', 'staff']))

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">

                <h5>Student Management</h5>

                <p class="text-muted">
                    Manage student registration and records.
                </p>

                <a href="{{ route('students.index') }}"
                   class="btn btn-primary">
                    View Students
                </a>

                @if(Auth::user()->role === 'admin')

                    <a href="{{ route('admin.accounts.students') }}"
                       class="btn btn-outline-primary">
                        Create Student Accounts
                    </a>

                    <a href="{{ route('admin.accounts.teachers') }}"
                       class="btn btn-outline-primary">
                        Create Teacher Accounts
                    </a>

                @endif

            </div>
        </div>

    @elseif(Auth::user()->role === 'teacher')

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">

                <h5>Teacher Dashboard</h5>

                <p class="text-muted">
                    View your assigned courses and students.
                </p>

                <a href="{{ route('teacher.dashboard') }}"
                   class="btn btn-primary">
                    My Teaching Dashboard
                </a>

            </div>
        </div>

    @elseif(Auth::user()->role === 'student')

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">

                <h5>My Academic Profile</h5>

                <p class="text-muted">
                    View your registered student information.
                </p>

                <a href="{{ route('student.profile') }}"
                   class="btn btn-primary">
                    View My Profile
                </a>

            </div>
        </div>

    @endif

</div>

@endsection

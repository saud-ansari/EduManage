@extends('layouts.app')

@section('title', 'Dashboard')

@section('heading', 'Dashboard Overview')

@section('content')

    <!-- Welcome Section -->

    <div class="d-flex justify-content-between
                align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h4 class="fw-bold">
                Welcome Back, Administrator!
            </h4>

            <p class="text-muted mb-0">
                Here's an overview of your institute.
            </p>

        </div>

        <a href="{{ route('students.index') }}" class="btn btn-primary">

            <i class="bi bi-people me-2"></i>
            Manage Students

        </a>

    </div>


    <!-- Statistics Cards -->

    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="text-muted mb-2">
                            Total Students
                        </p>

                        <h3 class="fw-bold">120</h3>

                    </div>

                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="text-muted mb-2">
                            Active Courses
                        </p>

                        <h3 class="fw-bold">08</h3>

                    </div>

                    <div class="stat-icon">
                        <i class="bi bi-book"></i>
                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="text-muted mb-2">
                            Teachers
                        </p>

                        <h3 class="fw-bold">12</h3>

                    </div>

                    <div class="stat-icon">
                        <i class="bi bi-person-workspace"></i>
                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="text-muted mb-2">
                            Pass Percentage
                        </p>

                        <h3 class="fw-bold">85%</h3>

                    </div>

                    <div class="stat-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Application Information -->

    <div class="content-card mb-4">

        <h5 class="fw-bold mb-3">
            Welcome to EduManage
        </h5>

        <p class="text-muted">
            EduManage is a centralized student management
            application designed to manage student records,
            courses, teachers and academic performance.
        </p>

        <a href="{{ route('students.index') }}" class="btn btn-primary mt-2">

            Explore Student Records
            <i class="bi bi-arrow-right ms-2"></i>

        </a>

    </div>

    <div class="row g-3">

        <div class="col-md-6">

            <x-card title="Student Management" icon="bi bi-people">

                <p class="text-muted">
                    Manage student information and records.
                </p>

                <a href="{{ route('students.index') }}" class="btn btn-primary">

                    View Students

                </a>

            </x-card>

        </div>

        <div class="col-md-6">

            <x-card title="Course Management" icon="bi bi-book">

                <p class="text-muted">
                    Manage courses offered by the institute.
                </p>

            </x-card>

        </div>

    </div>


@endsection

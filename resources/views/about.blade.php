@extends('layouts.app')

@section('title', 'About')

@section('heading', 'About EduManage')

@section('content')

    <div class="content-card">

        <div class="mb-4">

            <span class="badge"
                  style="background:#692386">

                About Our Application

            </span>

        </div>

        <h3 class="fw-bold mb-3">
            Simplifying Student Management
        </h3>

        <p class="text-muted">
            EduManage is a student management application
            developed to simplify the administration of
            educational institutes.
        </p>

        <p class="text-muted">
            It provides a centralized platform for managing
            student information, courses, teachers and
            academic performance.
        </p>

        <hr>

        <h5 class="fw-bold">
            Our Application Features
        </h5>

        <div class="row g-3 mt-2">

            <div class="col-md-4">
                <div class="stat-card">
                    <i class="bi bi-people fs-3"></i>
                    <h6 class="mt-3">Student Management</h6>
                    <small class="text-muted">
                        Maintain student records.
                    </small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <i class="bi bi-book fs-3"></i>
                    <h6 class="mt-3">Course Management</h6>
                    <small class="text-muted">
                        Organize institute courses.
                    </small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <i class="bi bi-graph-up fs-3"></i>
                    <h6 class="mt-3">Performance</h6>
                    <small class="text-muted">
                        Monitor academic results.
                    </small>
                </div>
            </div>

        </div>

    </div>

@endsection
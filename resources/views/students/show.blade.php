@extends('layouts.app')

@section('title', 'Student Details')

@section('heading', 'Student Details')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    Student Profile
                </h4>

                <p class="text-muted mb-0">
                    View registered student information.
                </p>
            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">

                    <i class="bi bi-pencil me-2"></i>
                    Edit Student

                </a>

                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">

                    Back

                </a>

            </div>

        </div>

        <div class="content-card">

            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width:65px;height:65px;background:#F0E8F8;color:#692386;">

                    <i class="bi bi-person-fill fs-2"></i>

                </div>

                <div>

                    <h4 class="fw-bold mb-1">
                        {{ $student->name }}
                    </h4>

                    <span class="text-muted">
                        Student ID: #{{ $student->id }}
                    </span>

                </div>

            </div>

            <hr>

            <div class="row g-4">

                <div class="col-md-6">

                    <label class="text-muted small">
                        Email Address
                    </label>

                    <p class="fw-semibold">
                        {{ $student->email }}
                    </p>

                </div>

                <div class="col-md-6">

                    <label class="text-muted small">
                        Phone Number
                    </label>

                    <p class="fw-semibold">
                        {{ $student->phone }}
                    </p>

                </div>

                <div class="col-md-6">

                    <label class="text-muted small">
                        Date of Birth
                    </label>

                    <p class="fw-semibold">
                        {{ $student->date_of_birth
                            ? \Illuminate\Support\Carbon::parse($student->date_of_birth)->format('d M Y')
                            : 'Not provided' }}
                    </p>

                </div>

                <div class="col-md-6">

                    <label class="text-muted small">
                        Course
                    </label>

                    <p class="fw-semibold">
                        {{ $student->courseDetails?->name ?? 'Not assigned' }}
                    </p>

                </div>

                <div class="col-md-6">

                    <label class="text-muted small">
                        Assigned Teacher
                    </label>

                    <p class="fw-semibold">
                        {{ $student->courseDetails?->teacher?->name ?? 'Not assigned' }}
                    </p>

                </div>


                <div class="col-md-6">

                    <label class="text-muted small">
                        Marks
                    </label>

                    <p class="fw-semibold">

                        @if ($student->marks >= 40)
                            <span class="badge bg-success">
                                {{ $student->marks }} — Passed
                            </span>
                        @else
                            <span class="badge bg-danger">
                                {{ $student->marks }} — Failed
                            </span>
                        @endif

                    </p>

                </div>

                <div class="col-md-6">

                    <label class="text-muted small">
                        Registration Date
                    </label>

                    <p class="fw-semibold">
                        {{ $student->created_at->format('d M Y') }}
                    </p>

                </div>
            </div>
        </div>
    </div>

@endsection


@extends('layouts.app')

@section('title', 'My Profile')
@section('heading', 'My Profile')

@section('content')

<div class="container-fluid">

    <div class="row">

        {{-- Student Profile Card --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center">

                <div class="card-body">

                    @if($student->profile_image)
                        <img
                            src="{{ asset('storage/' . $student->profile_image) }}"
                            alt="Student Profile"
                            class="rounded-circle mb-3"
                            width="130"
                            height="130"
                            style="object-fit: cover;"
                        >
                    @else
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 130px; height: 130px;">
                            <i class="bi bi-person-circle text-secondary"
                               style="font-size: 80px;"></i>
                        </div>
                    @endif

                    <h5 class="fw-bold">{{ $student->name }}</h5>

                    <p class="text-muted mb-0">
                        Student
                    </p>

                </div>
            </div>
        </div>

        {{-- Personal Information --}}
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm">

                <div class="card-header">
                    <h5 class="mb-0">Personal Information</h5>
                </div>

                <div class="card-body">

                    <p>
                        <strong>Name:</strong>
                        {{ $student->name }}
                    </p>

                    <p>
                        <strong>Email:</strong>
                        {{ $student->email }}
                    </p>

                    <p>
                        <strong>Phone:</strong>
                        {{ $student->phone ?? 'Not Available' }}
                    </p>

                    <p>
                        <strong>Address:</strong>
                        {{ $student->address ?? 'Not Available' }}
                    </p>

                </div>
            </div>
        </div>

        {{-- Academic Information --}}
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">

                <div class="card-header">
                    <h5 class="mb-0">Academic Information</h5>
                </div>

                <div class="card-body">

                    <p>
                        <strong>Course:</strong>
                        {{ $student->courseDetails->name ?? 'Not Assigned' }}
                    </p>

                    <p>
                        <strong>Teacher:</strong>
                        {{ $student->courseDetails->teacher->name ?? 'Not Assigned' }}
                    </p>

                    <p>
                        <strong>Course Duration:</strong>
                        {{ $student->courseDetails->duration ?? 'Not Available' }}
                    </p>

                    <p>
                        <strong>Course Fees:</strong>
                        @if($student->courseDetails && $student->courseDetails->fees !== null)
                            ₹{{ number_format($student->courseDetails->fees, 2) }}
                        @else
                            Not Available
                        @endif
                    </p>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection

@extends('layouts.app')

@section('title', 'Teacher Dashboard')
@section('heading', 'Teacher Dashboard')

@section('content')

<div class="container-fluid">

    {{-- Teacher Information --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">Teacher Information</h5>
        </div>

        <div class="card-body">

            <p>
                <strong>Name:</strong>
                {{ $teacher->name }}
            </p>

            <p>
                <strong>Email:</strong>
                {{ $teacher->email }}
            </p>

        </div>
    </div>

    {{-- Assigned Courses --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">My Assigned Courses</h5>
        </div>

        <div class="card-body">

            @forelse($teacher->courses as $course)

                <div class="border rounded p-3 mb-3">

                    <h6 class="fw-bold">
                        {{ $course->name }}
                    </h6>

                    <p class="mb-0">
                        Students Enrolled:
                        {{ $course->students->count() }}
                    </p>

                </div>

            @empty

                <p class="text-muted mb-0">
                    No courses assigned yet.
                </p>

            @endforelse

        </div>
    </div>

    {{-- Students --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">My Students</h5>
        </div>

        <div class="card-body">

            @php
                $students = $teacher->courses->flatMap->students;
            @endphp

            @if($students->isNotEmpty())

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Course</th>
                                <th>Email</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($students as $student)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->courseDetails->name ?? 'N/A' }}</td>
                                    <td>{{ $student->email }}</td>
                                </tr>

                            @endforeach
                        </tbody>

                    </table>
                </div>

            @else

                <p class="text-muted mb-0">
                    No students assigned yet.
                </p>

            @endif

        </div>
    </div>

</div>

@endsection
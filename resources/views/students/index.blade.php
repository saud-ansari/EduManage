@extends('layouts.app')

@section('title', 'Students')
@section('heading', 'Student Management')
@section('content')

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Students</h4>
                <p class="text-muted mb-0">
                    Manage all registered students.
                </p>
            </div>

            <a href="{{ route('students.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>
                Add Student
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        {{-- Student Statistics --}}
        <div class="row g-3 mb-4">

            <div class="col-md-4">
                <div class="content-card">
                    <div class="text-muted small">
                        Total Students
                    </div>
                    <h3 class="fw-bold mb-0">
                        {{ $students->count() }}
                    </h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="content-card">
                    <div class="text-muted small">
                        Passed Students
                    </div>
                    <h3 class="fw-bold text-success mb-0">
                        {{ $students->where('marks', '>=', 40)->count() }}
                    </h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="content-card">
                    <div class="text-muted small">
                        Failed Students
                    </div>
                    <h3 class="fw-bold text-danger mb-0">
                        {{ $students->where('marks', '<', 40)->count() }}
                    </h3>
                </div>
            </div>

        </div>

        {{-- Student Table --}}
        <div class="content-card">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">
                    Student Records
                </h5>
                <span class="badge bg-light text-dark">
                    {{ $students->count() }} Records
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Student</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Teacher</th>
                            <th>Marks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td class="fw-semibold">
                                    {{ $student->name }}
                                </td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $student->courseDetails?->name ?? 'Not assigned' }}
                                    </span>
                                </td>
                                <td>
                                    {{ $student->courseDetails?->teacher?->name ?? 'Not assigned' }}
                                </td>
                                <td>
                                    @if ($student->marks >= 40)
                                        <span class="badge bg-success">
                                            {{ $student->marks }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            {{ $student->marks }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('students.show', $student) }}"
                                            class="btn btn-sm btn-outline-primary" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('students.edit', $student) }}"
                                            class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('students.destroy', $student) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this student?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="bi bi-people fs-1 text-muted"></i>
                                    <h6 class="fw-bold mt-3">
                                        No Students Found
                                    </h6>
                                    <p class="text-muted">
                                        Start by registering your first student.
                                    </p>
                                    <a href="{{ route('students.create') }}" class="btn btn-primary">
                                        Add Student
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

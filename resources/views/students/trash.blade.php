@extends('layouts.app')

@section('title', 'Students')
@section('heading', 'Student Management')

@section('content')
    <div class="container py-4">

        <h2 class="mb-4">Deleted Students</h2>

        <a href="{{ route('students.index') }}" class="btn btn-primary mb-3">
            Back to Students
        </a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="content-card">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">
                    Deleted Student Records
                </h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Student</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Marks</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($students as $student)
                            <tr>

                                <td>{{ $student->id }}</td>

                                <td>{{ $student->name }}</td>

                                <td>{{ $student->email }}</td>

                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $student->courseDetails?->name ?? 'Not assigned' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $student->marks ?? 'Not assigned' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $student->deleted_at->format('d M Y') }}
                                </td>

                                <td>

                                    <!-- Restore -->

                                    <form action="{{ route('students.restore', $student->id) }}" method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('PATCH')

                                        <button class="btn btn-success btn-sm">
                                            Restore
                                        </button>

                                    </form>

                                    <!-- Permanent Delete -->

                                    <form action="{{ route('students.forceDelete', $student->id) }}" method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Permanently delete this student?')">

                                            Delete Permanently

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center">
                                    No deleted students found.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="card-footer">
                {{ $students->links() }}
            </div>

        </div>

    </div>
@endsection

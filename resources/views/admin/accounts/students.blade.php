@extends('layouts.app')

@section('content')

<div class="container py-4">

    <h3 class="mb-3">Create Student Login Account</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($students->isEmpty())

        <div class="alert alert-info">
            All existing students already have login accounts.
        </div>

    @else

        <form action="{{ route('admin.accounts.students.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Select Existing Student</label>

                <select name="student_id" class="form-select" required>
                    <option value="">Choose Student</option>

                    @foreach($students as $student)
                        <option value="{{ $student->id }}"
                            {{ old('student_id') == $student->id ? 'selected' : '' }}>
                            {{ $student->name }} (ID: {{ $student->id }})
                        </option>
                    @endforeach

                </select>

                @error('student_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Login Email</label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="form-control"
                       required>

                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Temporary Password</label>

                <input type="password"
                       name="password"
                       class="form-control"
                       required>

                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>

                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       required>
            </div>

            <button type="submit" class="btn btn-primary">
                Create Student Account
            </button>

        </form>

    @endif

</div>

@endsection

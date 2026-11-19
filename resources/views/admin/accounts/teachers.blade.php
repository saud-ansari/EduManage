@extends('layouts.app')

@section('content')

<div class="container py-4">

    <h3 class="mb-3">Create Teacher Login Account</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($teachers->isEmpty())

        <div class="alert alert-info">
            All existing teachers already have login accounts.
        </div>

    @else

        <form action="{{ route('admin.accounts.teachers.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Select Existing Teacher</label>

                <select name="teacher_id" class="form-select" required>
                    <option value="">Choose Teacher</option>

                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}"
                            {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }} (ID: {{ $teacher->id }})
                        </option>
                    @endforeach

                </select>

                @error('teacher_id')
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
                Create Teacher Account
            </button>

        </form>

    @endif

</div>

@endsection

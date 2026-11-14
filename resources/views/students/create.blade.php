@extends('layouts.app')

@section('title', 'Add Student')

@section('heading', 'Add Student')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Register New Student
            </h4>

            <p class="text-muted">
                Enter the student details below.
            </p>

        </div>

        <div class="content-card">

            {{-- Validation Errors --}}
            @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>Please correct the following errors:</strong>

                    <ul class="mb-0 mt-2">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('students.store') }}" method="POST">

                @csrf

                <div class="row g-3">

                    {{-- Name --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Student Name
                        </label>

                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="Enter full name" required>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="Enter email address" required>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Phone --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Phone Number
                        </label>

                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone') }}" placeholder="10-digit phone number" maxlength="10" required>

                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Date of Birth --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Date of Birth
                        </label>

                        <input type="date" name="date_of_birth"
                            class="form-control @error('date_of_birth') is-invalid @enderror"
                            value="{{ old('date_of_birth') }}">

                        @error('date_of_birth')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Course --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Select Course
                        </label>

                        <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>

                            <option value="">
                                Choose a Course
                            </option>

                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ old('course_id') == $course->id ? 'selected' : '' }}>

                                    {{ $course->name }}
                                    — ₹{{ number_format($course->fees, 2) }}

                                </option>
                            @endforeach

                        </select>

                        @error('course_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Marks --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Marks
                        </label>

                        <input type="number" name="marks" class="form-control @error('marks') is-invalid @enderror"
                            value="{{ old('marks') }}" min="0" max="100" placeholder="Enter marks" required>

                        @error('marks')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">

                        <i class="bi bi-check-circle me-2"></i>
                        Register Student

                    </button>

                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

@endsection
